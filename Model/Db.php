<?php

class Db
{
    private $connection = null;


    function __construct()
    {
        try {
            $this->connect();
        } catch (PDOException $exc) {
            exit('Database connection could not be established.' . $exc);
        }
    }

    private function connect()
    {
        $connection_string = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';';
        $this->connection = new PDO($connection_string, DB_USER, DB_PASS);
    }

    public function getconnection() {
        return $this->connection;
    }
}



