<?php

namespace Controllers;

use Views\MainView;

/**
 * @namespace Controllers
 * @Receive $view, $model, execute(): void
 * @From Controller
*/
class AdminController extends Controller {
    /**
     *### **Send page to the client With custom info**
     * 
     * @return Page-View
     * 
     * - Rendering
    */
    public function execute(): void {
        $this -> view = new MainView('Admin');
        $this -> view -> render();
    }
}