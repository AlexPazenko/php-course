<?php

class Database
{

//Params to connect to database
    private $host = "localhost";
    private $db_name = "php_course";
    private $username = "alex";
    private $password = "789555";
    public $conn;



//Connection to database
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        } catch(PDOException $exception) {
            echo "Database connection failed: " . $exception->getMessage();
        }

        return $this->conn;
    }

}
?>