<?php

class Database
{
    private $host = "localhost";
    private $database = "bonneterreschool";
    private $username = "root";
    private $password ="newlife11";
    public $conn;

    public function dbConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
