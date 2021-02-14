<?php

namespace Controllers;

use DBConnectionI;
use Views\MainView;

class CallController extends Controller {
    public function __construct(
        private DBConnectionI $pdo,
    ) {}

    public function tokenExists(): bool {
        $token = $_GET['token'] ?? '';

        $query = $this -> pdo -> connect() -> prepare(
           "SELECT * FROM `tb_calls`
            WHERE token = ?;"
        );

        $query -> execute([
            $token,
        ]);

        return $query -> rowCount() == 1;
    }

    public function execute(): void {
        $this -> view = new MainView('Call');
        $this -> view -> render();
    }
}