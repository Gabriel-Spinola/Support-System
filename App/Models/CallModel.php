<?php

/// position -1 = client
/// position  1 = admin

namespace Models;

use DBConnectionI;
use Helpers\Response;

class CallModel {
    private string $token;

    public function __construct(
        private DBConnectionI $pdo,
    ) {
        $this -> token = $_GET['token'] ?? '';
    }

    public function callResponse(): void {
        $query = $this -> pdo -> connect() -> prepare(
            "SELECT * FROM `tb_call_answer`
            WHERE call_id = ?
            ORDER BY id ASC;"
        );

        $query -> execute([
            $this -> token,
        ]);

        $data = $query -> fetchAll();

        foreach($data as $key => $row):
            if ($row['position'] == 1): ?>

                <p><strong>Admin: </strong><?php print $row['message'] ?></p>

            <?php else: ?>

                <p><strong>You: </strong><?php print $row['message'] ?></p>

            <?php endif ?>
            
            <hr>

        <?php endforeach;
    }

    public function callView(): void {
        $query = $this -> pdo -> connect() -> prepare(
           "SELECT * FROM `tb_call_answer`
            WHERE call_id = ?
            ORDER BY id DESC;"
        );

        $query -> execute([
            $this -> token,
        ]);

        if ($query -> rowCount() == 0):
            echo 'wait until someone answer you.';
        else:
            $info = $query -> fetchAll(); 
            
            if ($info[0]['position'] == -1):
                echo 'wait until someone answer you.';
            else: ?>

                <form method="post">

                    <textarea name="message"></textarea> <br>
                    <input type="submit" name="call-submit">

                </form>

            <?php endif;

        endif;

        if (isset($_POST['call-submit'])) {
            $message = $_POST['message'];

            $query2 = $this -> pdo -> connect() -> prepare(
               "INSERT INTO `tb_call_answer`
                VALUES (null, ?, ?, ?);"
            );

            Response :: detailResponse(
                response: $query2 -> execute([
                    $this -> token, $message, -1,
                ]),
                sucMsg: '<script>alert(\'Your message has been sent successfully\')</script>',
                errMsg: 'ERROR::CALLMODEL:93::Some error has Occurred'
            );

            header('Location:' . BASE . 'call?token=' . $this -> token);
            die;
        }
    }
}