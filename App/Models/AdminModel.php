<?php 

/// position -1 = client
/// position  1 = admin

namespace Models;

use DBConnectionI;
use Helpers\Response;

class AdminModel {
    public function __construct(
        private DBConnectionI $pdo
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

                $token = $_GET['token'] ?? '';

                $isAnswered = $this -> pdo -> connect() -> prepare(
                   "SELECT * FROM `tb_call_answer`
                    WHERE call_id = ?;"
                );

                $isAnswered -> execute([
                    $token,
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

    // private function sendEmail(): bool {
    //     return false;
    // }

    public function sendAnswer(): void {
        if (isset($_POST['new-call-submit'])) {
            $token = $_POST['token'];
            $email = $_POST['email'];
            $message = $_POST['message'];

            $query = $this -> pdo -> connect() -> prepare(
               "INSERT INTO `tb_call_answer`
                VALUES (null, ?, ?, ?)"
            );

            Response :: detailResponse(
                $query -> execute([
                    $token, $message,
                    1
                ]),
                sucMsg: '<script>alert(\'Your answer has been sent successfully\')</script>',
                errMsg: 'ERROR::CALLMODEL:93::Some error has Occurred'
            );
        }
    }
}