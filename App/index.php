<?php

// ---------------------------------------------------------
// Imports
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
// Router
Router :: get('/?', function($par): void {
    echo 'home';
});