<?php

interface DBConnectionI {
    public function connect(): PDO;
}