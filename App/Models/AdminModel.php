<?php 

/// position -1 = client
/// position  1 = admin

namespace Models;

use Closure;
use DBConnectionI;
use EmailSendingI;
use Helpers\Response;

class AdminModel {
    // private object $email;

    public function __construct(
        private DBConnectionI $pdo,
        private EmailSendingI $email,
    ) {}

    public function getCalls(): void {
        $query = $this -> pdo -> connect() -> prepare(
           "SELECT * FROM `tb_calls`
            ORDER BY id DESC;"
        );

        $query -> execute();

        $data = $query -> fetchAll();

        foreach ($data as $key => $row): ?>

            <?php

                $isAnswered = $this -> pdo -> connect() -> prepare(
                "SELECT * FROM `tb_call_answer`
                    WHERE call_id = ?;"
                );

                $isAnswered -> execute([
                    $row['token'],
                ]);

                if ($isAnswered -> rowCount() >= 1)
                    continue;
                
            ?>

            <hr>
            <h4><?php print $row['message'] ?></h4>

            <form method="POST">
            
                <textarea name="message" placeholder="Your Answer..."></textarea> <br>
                <input type="submit" name="new-call-submit" value="Reply!">
                <input type="hidden" name="token" value="<?php print $row['token'] ?>">
                <input type="hidden" name="email" value="<?php print $row['email'] ?>">

            </form>

        <?php endforeach;
    }

    private function sendEmail(string $email, string | int $token): bool {
        $this -> email -> AddAddress($email, 'Gabriel');
        
        $this -> email -> FormatEmail([
            'subject' => 'Support System Message',
            'body' => 'Hello, Someone answered you!' . 
            ' message <a href="' . BASE . 'call?token=' . $token . '">link</a>'
        ]);
        
        return $this -> email -> SendEmail();
    }

    public function sendAnswer(): void {
        if (isset($_POST['new-call-submit'])) {
            $token = $_POST['token'];
            $mail = $_POST['email'];
            $message = $_POST['message'];

            $query = $this -> pdo -> connect() -> prepare(
               "INSERT INTO `tb_call_answer`
                VALUES (null, ?, ?, ?, 1)"
            );

            Response :: detailResponse(
                $query -> execute([
                    $token, $message,
                    1
                ])
                and
                $this -> sendEmail($mail, $token),
                sucMsg: '<script>alert(\'Your answer has been sent successfully\')</script>',
                errMsg: 'ERROR::CALLMODEL:93::Some error has Occurred'
            );

            header('Location:' . BASE . 'admin');
            die;
        }
    }

    public function lastInteractionsResponse() {
        $query = $this -> pdo -> connect() -> prepare(
           "SELECT * FROM `tb_call_answer`
            WHERE position = -1 AND `status` = 0 -- STATUS: Check if the question has already been answered
            ORDER BY id DESC;"
        );

        $query -> execute();

        $data = $query -> fetchAll();

        foreach ($data as $key => $row): ?>

            <p>Click <a href="<?php echo BASE . 'call?token=' . $row['call_id'] ?>">Here</a> to see the call</p>
            <h4><?php print 'id: ' . $row['id'] ?> - <?php print $row['message'] ?></h4>

            <form method="POST">
            
                <textarea name="message" placeholder="Your Answer..."></textarea> <br>
                <input type="submit" name="last-call-submit" value="Reply!">
                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                <input type="hidden" name="token" value="<?php echo $row['call_id'] ?>">

            </form>

        <?php endforeach;
    }

    public function sendLastInteractionResponse() {
        if (isset($_POST['last-call-submit'])) {
            $token = $_POST['token'];
            $message = $_POST['message'];
            $id = $_POST['id'];
        
            $this -> pdo -> connect() -> exec(
               "UPDATE `tb_call_answer`
                SET `status` = 1
                WHERE id = $id;"
            );

            $query = $this -> pdo -> connect() -> prepare(
               "INSERT INTO `tb_call_answer`
                VALUES (null, ?, ?, 1, 1);"
            );

            Response :: detailResponse(
                $query -> execute([
                    $token, $message,
                ]),
                sucMsg: '<script>alert(\'Your answer has been sent successfully\')</script>',
                errMsg: 'ERROR::CALLMODEL:93::Some error has Occurred'
            );

            header('Location:' . BASE . 'admin');
        }
    }
}