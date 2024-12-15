<?php
class db {
    private static $instance = null;
    private $conn;

    private $host = '127.0.0.1';
    private $user = 'root';
    private $pass = '';
    private $name = 'psychology';

    private function __construct() {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->name}", $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function getConnexion() {
        if (!self::$instance) {
            self::$instance = new db();
        }
        return self::$instance->conn;
    }
}
?>