<?php

class License {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function generateLicense($userId, $orderId, $email, $maxInstallations, $expiresAt) {
        $licenseKey = $this->createLicenseKey();

        $stmt = $this->db->prepare(
            "INSERT INTO licenses 
            (user_id, order_id, license_key, email, expires_at, max_installations, active_installations, status) 
            VALUES (?, ?, ?, ?, ?, ?, 0, 'active')"
        );

        try {
            $stmt->execute([$userId, $orderId, $licenseKey, $email, $expiresAt, $maxInstallations]);
            return $licenseKey;
        } catch (Exception $e) {
            error_log("License Generation Error: " . $e->getMessage());
            return false;
        }
    }

    public function verifyLicense($email, $key) {
    
        $stmt = $this->db->prepare(
            "SELECT * FROM licenses 
            WHERE email = ? AND license_key = ? AND expires_at > NOW() AND status = 'active'"
        );
        $stmt->execute([$email, $key]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
    }

    public function getLicense($email, $key) {
        $stmt = $this->db->prepare(
            "SELECT * FROM licenses WHERE email = ? AND license_key = ? LIMIT 1"
        );
        $stmt->execute([$email, $key]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function countInstallations($licenseId) {
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) FROM license_installations 
            WHERE license_id = ? AND status = 'active'"
        );
        $stmt->execute([$licenseId]);
        return $stmt->fetchColumn();
    }

    public function recordInstallation($licenseId, $domain, $deviceIdentifier) {
        $stmt = $this->db->prepare(
            "INSERT INTO license_installations 
            (license_id, domain, device_identifier, status, installed_at) 
            VALUES (?, ?, ?, 'active', NOW())"
        );

        try {
            $stmt->execute([$licenseId, $domain, $deviceIdentifier]);
            $this->updateActiveInstallations($licenseId);
            return true;
        } catch (Exception $e) {
            error_log("Record Installation Error: " . $e->getMessage());
            return false;
        }
    }

    // Updated Activate License Logic
    public function activateLicense($licenseId, $domain, $deviceIdentifier) {
        $license = $this->getLicenseById($licenseId);

        if (!$license || $license['status'] !== 'active') {
            return false; // License not found or inactive
        }

        if ($license['active_installations'] >= $license['max_installations']) {
            return false; // Max installations reached
        }

        $stmt = $this->db->prepare(
            "INSERT INTO license_installations 
            (license_id, domain, device_identifier, status, installed_at) 
            VALUES (?, ?, ?, 'active', NOW())"
        );

        try {
            $stmt->execute([$licenseId, $domain, $deviceIdentifier]);

       
            $this->incrementActiveInstallations($licenseId);

            return true;
        } catch (Exception $e) {
            error_log("Activate License Error: " . $e->getMessage());
            return false;
        }
    }

    // Updated Deactivate License Logic
    public function deactivateLicense($licenseId, $domain, $deviceIdentifier) {
        $stmt = $this->db->prepare(
            "UPDATE license_installations 
            SET status = 'inactive' 
            WHERE license_id = ? AND domain = ? AND device_identifier = ?"
        );

        try {
            $stmt->execute([$licenseId, $domain, $deviceIdentifier]);

            // Decrement active installations count
            $this->decrementActiveInstallations($licenseId);

            return true;
        } catch (Exception $e) {
            error_log("Deactivate License Error: " . $e->getMessage());
            return false;
        }
    }

    private function createLicenseKey() {
        return strtoupper(bin2hex(random_bytes(16))); // Generates a 32-character unique key
    }

    private function updateActiveInstallations($licenseId) {
        $count = $this->countInstallations($licenseId);

        $stmt = $this->db->prepare(
            "UPDATE licenses SET active_installations = ? WHERE id = ?"
        );
        $stmt->execute([$count, $licenseId]);
    }

    private function incrementActiveInstallations($licenseId) {
        $stmt = $this->db->prepare(
            "UPDATE licenses 
            SET active_installations = active_installations + 1 
            WHERE id = ? AND active_installations < max_installations"
        );
        $stmt->execute([$licenseId]);
    }

    private function decrementActiveInstallations($licenseId) {
        $stmt = $this->db->prepare(
            "UPDATE licenses 
            SET active_installations = active_installations - 1 
            WHERE id = ? AND active_installations > 0"
        );
        $stmt->execute([$licenseId]);
    }

    public function getLicenseById($licenseId) {
        $stmt = $this->db->prepare(
            "SELECT * FROM licenses WHERE id = ?"
        );
        $stmt->execute([$licenseId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getLicenseByKey($key){
        $stmt = $this->db->prepare(
            "SELECT * FROM licenses WHERE license_key = ?"
        );
        $stmt->execute([$key]);
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }
    
    
    public function getLicenseByDomain($domain){
    
    }
    
    public function getAllLicenses(){
        $stmt = $this->db->prepare(
            "SELECT * FROM licenses"
        );
        $stmt->execute();
        
        $all_license =  $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if(empty($all_license)) return null;
      
        return $all_license;
    }
}