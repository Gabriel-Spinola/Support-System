<?php

namespace Controllers;

use DBConnectionI;
use EmailSendingI;
use Views\MainView;

class CallController extends Controller {
    private string $token;

    public function __construct(
        private DBConnectionI $pdo,
    ) {
        $this -> token = $_GET['token'] ?? '';
    }

    public function tokenExists(): bool {
        $query = $this -> pdo -> connect() -> prepare(
           "SELECT * FROM `tb_calls`
            WHERE token = ?;"
        );

        $query -> execute([
            $this -> token,
        ]);

        return $query -> rowCount() == 1;
    }

    public function getMessage(): string {
        $query = $this -> pdo -> connect() -> prepare(
           "SELECT * FROM `tb_calls`
            WHERE token = ?;"
        );
        
        $query -> execute([
            $this -> token,
        ]);

        return $query -> fetch()[1];
    }

    public function execute(): void {
        $this -> view = new MainView('Call');

        $this -> view -> render([
            'message' => $this -> getMessage()
        ]);
    }
}