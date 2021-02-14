<?php

// ---------------------------------------------------------
// Imports
use Controllers\HomeController;
use Views\MainView;

require 'Interfaces.php';

// ---------------------------------------------------------
// Constants
const HOST = 'localhost';
const DATABASE = 'db_support_system';
const USER = 'root';
const PASSWORD = '';

// ---------------------------------------------------------
// Autoload
$autoload = function(string $className): void {
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

/*
Router :: get('/home/?', function(): void {
    echo "<h2>Home</h2>";
});
*/