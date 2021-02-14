<?php 

namespace Models;

use DBConnectionI;

class AdminModel {
    public function __construct(
        private DBConnectionI $pdo
    ) {}

    public function getCalls() {
        $query = $this -> pdo -> connect() -> prepare(
           "SELECT * FROM `tb_call_answer`
            ORDER BY id DESC;"
        );

        $query -> execute();

        $data = $query -> fetchAll();

        foreach ($data as $key => $row): ?>

            <form method="POST">
            
                <textarea></textarea>
                <input type="submit" name="submit">

            </form>

        <?php endforeach;
    }
}