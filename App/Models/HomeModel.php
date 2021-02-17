<?php

namespace Models;

use DBConnectionI;
use EmailSendingI;

class HomeModel {
    public function __construct(
        private DBConnectionI $pdo,
        private EmailSendingI $email,
    ) {}
    
    public function sendEmail(string $email, string | int $token): bool {
        $this -> email -> AddAddress($email, 'Gabriel');
        
        $this -> email -> FormatEmail([
            'subject' => 'Support System Message',
            'body' => 'Hello, We received your message!' . 
            ' message <a href="' . BASE . 'call?token=' . $token . '">link</a>'
        ]);
        
        return $this -> email -> SendEmail();
    }

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