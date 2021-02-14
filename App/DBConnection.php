<?php

interface DBConnectionI {
    public function connect(): PDO;
}

class MySql implements DBConnectionI {
    private PDO $pdo;
    
    public function connect(): PDO {
        if ($this -> pdo == null) {
            try {
                $this -> pdo = new PDO('mysql:host' . HOST . ';dbname=' . DATABASE, USER, PASSWORD, [
                    PDO :: MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                ]);

                $this -> pdo -> setAttribute(PDO :: ATTR_ERRMODE, PDO :: ERRMODE_EXCEPTION);
            } catch(Exception $e) {
                echo 'PDO::ERROR::"Database Connection Failure"';
            }
        }

        return $this -> pdo;
    }
}