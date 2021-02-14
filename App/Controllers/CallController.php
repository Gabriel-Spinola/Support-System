<?php

namespace Controllers;

use Views\MainView;

class CallController extends Controller {
    public function tokenExists(): bool {
        return true;
    }

    public function execute(): void {
        echo "Token :" . $_GET['token'];
    }
}