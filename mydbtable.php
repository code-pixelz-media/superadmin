<?php 
define('DB_PREFIX', 'wallet_'); // Define your table prefix


class Dzyns_Database {
    private $dzyns_host = 'localhost';
    private $dzyns_db_name = 'license_verification';
    private $dzyns_username = 'root';
    private $dzyns_password = 'root';
    public $dzyns_conn;

    // Get the database connection
    public function dzyns_getConnection() {
        $this->dzyns_conn = null;
        try {
            $this->dzyns_conn = new PDO("mysql:host=" . $this->dzyns_host . ";dbname=" . $this->dzyns_db_name, $this->dzyns_username, $this->dzyns_password);
            $this->dzyns_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $dzyns_exception) {
            echo "Connection error: " . $dzyns_exception->getMessage();
        }
        return $this->dzyns_conn;
    }
}

class Dzyns_DatabaseCreator {
    private $dzyns_conn;

    public function __construct($dzyns_db) {
        $this->dzyns_conn = $dzyns_db;
    }

    // Method to create the Users table
    public function dzyns_createUsersTable() {
        $dzyns_query = "CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "users (
           id INT(11) AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) UNIQUE,
            email VARCHAR(255) UNIQUE,
            password VARCHAR(255),
            user_role ENUM('admin', 'designer', 'client'),
            membership_type VARCHAR(100),
            registered_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            last_login TIMESTAMP DEFAULT NULL,
            last_login_ip VARCHAR(255),
            last_login_browser VARCHAR(255),
            first_name VARCHAR(255),
            last_name VARCHAR(255),
            profile_picture VARCHAR(255),
            failed_login_attempt INT(2) DEFAULT 0,
            failed_attempts_count INT(2) DEFAULT 0,
            failed_login_attempt_IP VARCHAR(255),
            failed_login_attempt_time TIMESTAMP DEFAULT NULL,
            user_status ENUM('registered', 'active', 'suspended', 'inactive', 'blocked') DEFAULT 'registered',
            user_activation_key VARCHAR(255),
            user_activation_time TIMESTAMP DEFAULT NULL
        )";

        $this->dzyns_executeQuery($dzyns_query);
    }

    // Method to create the User_meta table
    public function dzyns_createUserMetaTable() {
        $dzyns_query = "CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "user_meta (
           id INT(11) AUTO_INCREMENT PRIMARY KEY,
            user_id INT(11),
            street_address VARCHAR(255),
            city VARCHAR(255),
            postcode VARCHAR(50),
            state VARCHAR(255),
            country VARCHAR(255),
            2fa_enabled INT(1) DEFAULT 0,
            security_question VARCHAR(255),
            security_answer VARCHAR(255)
        )";

        $this->dzyns_executeQuery($dzyns_query);
    }

    // Method to create the User_payment_method table
    public function dzyns_createUserPaymentMethodTable() {
        $dzyns_query = "CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "user_payment_method (
           id INT(11) AUTO_INCREMENT PRIMARY KEY,
            user_id INT(11),
            payment_method ENUM('card', 'paypal'),
            stripe_customer_token VARCHAR(255),
            stripe_customer_secret VARCHAR(255),
            paypal_token VARCHAR(255)
        )";

        $this->dzyns_executeQuery($dzyns_query);
    }

    // Method to create the Projects table
    public function dzyns_createProjectsTable() {
        $dzyns_query = "CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "projects (id INT(11) AUTO_INCREMENT PRIMARY KEY,
            created_by INT(11),
            created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            project_name VARCHAR(255),
            status VARCHAR(255),
            category ENUM('Mobile App', 'Logo', 'Website'),
            priority ENUM('low', 'medium', 'high'),
            deadline DATE,
            `desc` TEXT,
            industry VARCHAR(255),
            client_id INT(11),
            designer_id INT(11),
            last_updated TIMESTAMP DEFAULT NULL
        )";

        $this->dzyns_executeQuery($dzyns_query);
    }

    // Method to create the Project_meta table
    public function dzyns_createProjectMetaTable() {
        $dzyns_query = "CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "project_meta (
            project_id INT(11),
            visual_style TEXT,
            inspiration TEXT,
            content_desc TEXT,
            content_notes TEXT
        )";

        $this->dzyns_executeQuery($dzyns_query);
    }

    // Method to create the Attachments table
    public function dzyns_createAttachmentsTable() {
        $dzyns_query = "CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "attachments (
           id INT(11) AUTO_INCREMENT PRIMARY KEY,
            user_id INT(11),
            project_id INT(11),
            task_id INT(11) DEFAULT NULL,
            url VARCHAR(255),
            title VARCHAR(255),
            date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        $this->dzyns_executeQuery($dzyns_query);
    }

    // Method to create the Task table
    public function dzyns_createTaskTable() {
        $dzyns_query = "CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "task (
           id INT(11) AUTO_INCREMENT PRIMARY KEY,
            created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            created_by INT(11),
            project_id INT(11),
            title VARCHAR(255),
            priority ENUM('low', 'medium', 'high'),
            status VARCHAR(50),
            deadline DATE,
            `desc` TEXT,
            review_status ENUM('0', '1', '2') DEFAULT '0'
        )";

        $this->dzyns_executeQuery($dzyns_query);
    }

    // Method to create the Messages table
    public function dzyns_createMessagesTable() {
        $dzyns_query = "CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "messages (
           id INT(11) AUTO_INCREMENT PRIMARY KEY,
            project_id INT(11),
            designer_id INT(11),
            client_id INT(11),
            message_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            message TEXT
        )";

        $this->dzyns_executeQuery($dzyns_query);
    }

    // Method to create the Notifications table
    public function dzyns_createNotificationsTable() {
        $dzyns_query = "CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "notifications (
           id INT(11) AUTO_INCREMENT PRIMARY KEY,
            created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            notify_user INT(11),
            notification_type ENUM('0', '1', '2', '3'),
            notification_message TEXT,
            notification_url VARCHAR(255),
            notification_methods ENUM('email', 'slack', 'discord', 'web'),
            notification_status ENUM('read', 'unread') DEFAULT 'unread',
            notification_read_time TIMESTAMP DEFAULT NULL
        )";

        $this->dzyns_executeQuery($dzyns_query);
    }

    // Helper function to execute queries
    private function dzyns_executeQuery($dzyns_query) {
        try {
            $this->dzyns_conn->exec($dzyns_query);
            echo "Table created successfully.<br>";
        } catch (PDOException $dzyns_exception) {
            echo "Error creating table: " . $dzyns_exception->getMessage() . "<br>";
        }
    }
}

// Usage Example
$dzyns_database = new Dzyns_Database();
$dzyns_db = $dzyns_database->dzyns_getConnection();

$dzyns_dbCreator = new Dzyns_DatabaseCreator($dzyns_db);
$dzyns_dbCreator->dzyns_createUsersTable();
$dzyns_dbCreator->dzyns_createUserMetaTable();
$dzyns_dbCreator->dzyns_createUserPaymentMethodTable();
$dzyns_dbCreator->dzyns_createProjectsTable();
$dzyns_dbCreator->dzyns_createProjectMetaTable();
$dzyns_dbCreator->dzyns_createAttachmentsTable();
$dzyns_dbCreator->dzyns_createTaskTable();
$dzyns_dbCreator->dzyns_createMessagesTable();
$dzyns_dbCreator->dzyns_createNotificationsTable();