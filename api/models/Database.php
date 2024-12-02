<?php
// api/models/Database.php
class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        try {
     
            $connection = new PDO(
                "mysql:host=" . DB_HOST, 
                DB_USER, 
                DB_PASS
            );
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $connection->exec("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "`");

            $this->connection = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, 
                DB_USER, 
                DB_PASS
            );
            
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("Database Connection/Creation Error: " . $e->getMessage());
            throw new \Exception("Database connection or creation failed: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }

    public function beginTransaction() {
        return $this->connection->beginTransaction();
    }

    public function commit() {
        return $this->connection->commit();
    }

    public function rollBack() {
        return $this->connection->rollBack();
    }
}