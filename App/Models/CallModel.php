<?php

namespace Models;

use DBConnectionI;

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

                    <textarea></textarea> <br>
                    <input type="submit" name="submit">

                </form>

            <?php endif;

        endif;
    }
}