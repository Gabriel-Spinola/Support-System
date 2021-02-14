<?php

namespace Models;

class HomeModel {
    public function sendForm(
        string $email, string $message,
        string $token
    ): bool {
        return true;
    }
}