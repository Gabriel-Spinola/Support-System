<?php 

namespace Models;

use DBConnectionI;

class AdminModel {
    private string | int $token;

    public function __construct(
        private DBConnectionI $pdo
    ) {
        $this -> token = $_GET['token'] ?? '';
    }

    public function getCalls() {
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
                    $this -> token,
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
}