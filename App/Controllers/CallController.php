<?php

namespace Controllers;

use DBConnectionI;
use Views\MainView;

/**
 * @namespace Controllers
 * @Receive $view, $model, execute(): void
 * @From Controller
 * 
 * @Use DataBaseConnection and MainView
 * 
 * - Get Token from url
 * - Check if the token exists
 * - Get the message of the token
 * - if everything works render
*/
class CallController extends Controller {
    private string $token;

    public function __construct(
        private DBConnectionI $pdo,
    ) {
        // Get token from the url
        $this -> token = $_GET['token'] ?? '';
    }

    /**
     * Check if the token exits
    */
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

    /**
     * Get the message of the token
     * and return it
    */
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

    /**
     * render the project and send the
     * message to the CallView. 
    */
    public function execute(): void {
        $this -> view = new MainView('Call');

        $this -> view -> render([
            'message' => $this -> getMessage()
        ]);
    }
}