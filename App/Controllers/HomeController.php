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
    /**
     *### **Send page to the client With custom info**
     * 
     * @return Page-View
     * 
     * - Rendering
    */
    public function execute(): void {
        $this -> view = new MainView('Home');
        $this -> view -> render();
    }
}