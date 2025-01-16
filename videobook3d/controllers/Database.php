<?php

class Database {
    private static $instance = null;
    private $conn;
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $name = "videobook3d";
    private $port = 3306;

    private function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->name};port={$this->port};charset=utf8mb4";
            $this->conn = new PDO($dsn, $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error al conectar a la base de datos: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}
