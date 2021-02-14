<?php

/**
 * "Call" is the customer interaction
*/

// ---------------------------------------------------------
// Imports
use Controllers\HomeController;
use Controllers\CallController;
use Controllers\AdminController;
use Helpers\Router;

require 'Interfaces.php';

// ---------------------------------------------------------
// Constants
const HOST = 'localhost';
const DATABASE = 'db_support_system';
const USER = 'root';
const PASSWORD = '';

const BASE = 'http://localhost:7000/Support-System/App/';

// ---------------------------------------------------------
// Autoload
$autoload = function(string $className): void {
    if ($className == 'Email') {
        require 'Imports/phpMailer/vendor/autoload.php';
    }

    require $className . '.php';
};

spl_autoload_register($autoload);

// ---------------------------------------------------------
// Controllers
$homeController = new HomeController();
$callController = new CallController(new MySql);

// ---------------------------------------------------------
// Router
Router :: get('/', function() use($homeController): void {
    $homeController -> execute();
});

Router :: get('/call', function() use($callController) {
    if (CallingTest()) {
        $callController -> execute();
    }
});


// ---------------------------------------------------------
// Tests
function CallingTest(): bool {
    global $callController;

    if (isset($_GET['token']) && $callController -> tokenExists()) {
        return true;
    } else {
        die ('You need a correct token');
    }

    return false;
}