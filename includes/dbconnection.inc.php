<?php

class Connection
{

    private $dbhost = 'localhost';
    private $dbuser = 'root';
    private $dbpw = '';
    private $dbname = 'practice';

    protected function connect()
    {

        try {
            $dsn = 'mysql:host=' . $this->dbhost . ';dbname=' . $this->dbname;
            $pdo = new PDO($dsn, $this->dbuser, $this->dbpw);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;

        } catch (PDOException $e) {
            print "Error! " . $e->getMessage();
            die();
        }

    }

}