<?php

namespace Models;

use DBConnectionI;

class HomeModel {
    public function __construct(
        private DBConnectionI $pdo,
    ) {}

    public function sendForm(
        string $email, string $message,
        string $token
    ): bool {
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