<?php 

/// position -1 = client
/// position  1 = admin

namespace Models;

use DBConnectionI;
use Helpers\Response;

class AdminModel {
    private object $email;

    public function __construct(
        private DBConnectionI $pdo
    ) {
        $this -> email = new \Email(
            host: 'smtp.gmail.com',
            username: 'sampleemail7000@gmail.com',
            password: 'Sample.123',
            name: 'Gabriel'
        );
    }

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
                VALUES (null, ?, ?, ?)"
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
}