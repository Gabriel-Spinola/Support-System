<?php

class MySql implements DBConnectionI {
    private $pdo;

    public function connect(): PDO {
        if ($this -> pdo == null) {
            // Custom error message for connection failure 
            // (also prevent from data leak)
            try {
                // Connect to the database
                $this -> pdo = new PDO('mysql:host='. HOST . ';dbname=' . DATABASE, USER, PASSWORD, [
                    PDO :: MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                ]);

                // Set error mode
                $this -> pdo -> setAttribute(PDO :: ATTR_ERRMODE, PDO :: ERRMODE_EXCEPTION);
            } catch (Exception $e) {
                print "<h2>Error connecting to DataBase</h2>";
            }
        }

        return $this -> pdo;
    }
}