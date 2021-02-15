<?php

interface DBConnectionI {
    public function connect(): PDO;
}

interface EmailSendingI {
    public function AddAddress(string $email, string $name): void;
    
    public function FormatEmail(array $info): void;

    public function SendEmail(): bool;
}