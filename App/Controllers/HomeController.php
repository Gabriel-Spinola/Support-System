<?php

namespace Controllers;

use Views\MainView;
use Models\HomeModel;

class HomeController extends Controller {
    public function execute(): void {
        $this -> view = new MainView('Home');
        $this -> view -> render();
    }
}