<?php

namespace Controllers;

use Views\MainView;

/**
 * @namespace Controllers
 * @Receive $view, $model, execute(): void
 * @From Controller
 * 
 * @Use MainView class
*/
class HomeController extends Controller {
    public function execute(): void {
        $this -> view = new MainView('Home');
        $this -> view -> render();
    }
}