<?php

namespace Models;

use DBConnectionI;
use EmailSendingI;

/**
 * @namespace Controllers
 * @Receive $view, $model, execute(): void
 * @From Controller
 * 
 * @Use DataBaseConnection, EmailSending
*/
class HomeModel {
    public function __construct(
        private DBConnectionI $pdo,
        private EmailSendingI $email,
    ) {}
    
    /**
     * - Set email address
     * - Format the email
     * - Try to send it, if works returns true else returns false
    */
    public function sendEmail(string $email, string | int $token): bool {
        $this -> email -> AddAddress($email, 'Gabriel');
        
        $this -> email -> FormatEmail([
            'subject' => 'Support System Message',
            'body' => 'Hello, We received your message!' . 
            ' message <a href="' . BASE . 'call?token=' . $token . '">link</a>'
        ]);
        
        return $this -> email -> SendEmail();
    }

    /**
     * Send The initial call form 
    */
    public function sendForm(string $email, string $message, string | int $token): bool {
        $query = $this -> pdo -> connect() -> prepare(
           "INSERT INTO `tb_calls`
            VALUES (null, ?, ?, ?);"
        );

        return $query -> execute([
            $message, $email,
            $token,
        ]);
    }
}