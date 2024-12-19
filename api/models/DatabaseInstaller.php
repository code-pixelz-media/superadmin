<?php



class DatabaseInstaller {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function install() {
        $tables = [
            'licenses' => "CREATE TABLE IF NOT EXISTS licenses (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                order_id INT NOT NULL,
                license_key VARCHAR(255) UNIQUE NOT NULL,
                email VARCHAR(255) UNIQUE NOT NULL,
                status ENUM('active', 'inactive', 'expired' , 'revoked') DEFAULT 'active',
                expires_at DATE NOT NULL,
                max_installations INT DEFAULT 2,
                active_installations INT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )",
            'license_installations' => "CREATE TABLE IF NOT EXISTS license_installations (
                id INT AUTO_INCREMENT PRIMARY KEY,
                license_id INT NOT NULL,
                domain VARCHAR(255) NOT NULL,
                status ENUM('active', 'inactive') DEFAULT 'active',
                device_identifier VARCHAR(255) NOT NULL,
                installed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (license_id) REFERENCES licenses(id) ON DELETE CASCADE
            )"
        ];
        

        $indexes = [
            "CREATE INDEX idx_license_key ON licenses(license_key)",
            "CREATE INDEX idx_license_installations ON license_installations(license_id)"
        ];

        try {

            foreach ($tables as $tableName => $tableQuery) {
                $this->db->exec($tableQuery);
                error_log("Table $tableName created successfully.",);
            }

    
            foreach ($indexes as $indexQuery) {
                try {
                    $this->db->exec($indexQuery);
                } catch (\PDOException $e) {
                    if (strpos($e->getMessage(), 'Duplicate key name') === false) {
                        error_log("Index Creation Error: " . $e->getMessage());
                        throw $e;
                    }
                }
            }

            return true;
        } catch (\PDOException $e) {
            error_log("Database Installation Error: " . $e->getMessage());
            return false;
        }
    }

    public function isInstalled() {
        try {
            $result = $this->db->query("SELECT 1 FROM licenses LIMIT 1");
            return $result !== false;
        } catch (\PDOException $e) {
            error_log("isInstalled Error: " . $e->getMessage());
            return false;
        }
    }
}
