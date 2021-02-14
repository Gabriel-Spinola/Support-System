<?php

namespace Controllers;

use Views\MainView;

class AdminController extends Controller {
    public function execute(): void {
        $this -> view = new MainView('Admin');
        $this -> view -> render();
    }
}