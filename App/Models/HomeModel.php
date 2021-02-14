<?php

namespace Models;

use DBConnectionI;

class HomeModel {
    private object $email;

    public function __construct(
        private DBConnectionI $pdo,
    ) {
        $this -> email = new \Email(
            host: 'smtp.gmail.com',
            username: 'sampleemail7000@gmail.com',
            password: 'Sample.123',
            name: 'Gabriel'
        );
    }
    
    private function sendEmail(string $email, string $token): bool {
        $this -> email -> AddAddress($email, 'Gabriel');
        $this -> email -> FormatEmail([
            'subject' => 'Support System Message',
            'body' => 'Hello, We received your message!' . 
                      'your message link: <a href="' . BASE . 'call?token=' . $token . '"></a>'
        ]);

        return $this -> email -> SendEmail();
    }

    public function sendForm(string $email, string $message, string $token): bool {
        $query = $this -> pdo -> connect() -> prepare(
           "INSERT INTO `tb_calls`
            VALUES (null, ?, ?, ?);"
        );

        return $query -> execute([
            $message, $email,
            $token,
        ]) && $this -> sendEmail($email, $token);
    }
}