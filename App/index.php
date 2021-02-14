<?php

// ---------------------------------------------------------
// Imports
use Controllers\HomeController;

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

// ---------------------------------------------------------
// Router

Router :: get('/', function() use($homeController): void {
    $homeController -> execute();
});

Router :: get('/call', function() {
    echo 'h2';
});

/*
Router :: get('/home/?', function(): void {
    echo "<h2>Home</h2>";
});
*/