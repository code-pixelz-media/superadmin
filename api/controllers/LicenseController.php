<?php

//

class LicenseController extends RestController
{
    private $licenseModel;

    public function __construct()
    {
        parent::__construct();
        $this->licenseModel = new License();
    }

    public function getAll()
    {
        try {
            $licenses = $this->licenseModel->getAllLicenses();
            $this->returnResponse(200, $licenses);
        } catch (Exception $e) {
            $this->throwError(500, "Failed to fetch licenses: " . $e->getMessage());
        }
    }

    public function verify()
    {
        try {
            $email = $this->validateParameter("email", $this->param['email'], STRING, true);
            $key = $this->validateParameter("key", $this->param['key'], STRING, true);
            $isValid = $this->licenseModel->verifyLicense($email, $key);
            
            if ($isValid) {
                $this->returnResponse(200, "License verified successfully.");
            } else {
                $this->throwError(400, "License have expired or not available at the moment");
            }
        } catch (Exception $e) {
            $this->throwError(500, "License verification failed: " . $e->getMessage());
        }
    }

    public function createLicense()
    {
        try {
            $userId = $this->validateParameter("userId", $this->param['userId'], INTEGER, true);
            $orderId = $this->validateParameter("orderId", $this->param['orderId'], INTEGER, true);
            $email = $this->validateParameter("email", $this->param['email'], STRING, true);
            $maxInstallations = $this->validateParameter("maxInstallations", $this->param['maxInstallations'], INTEGER, true);
            $expiresAt = $this->validateParameter("expiresAt", $this->param['expiresAt'], STRING, true);

            $licenseKey = $this->licenseModel->generateLicense($userId, $orderId, $email, $maxInstallations, $expiresAt);
            if ($licenseKey) {
                $this->returnResponse(200, ["licenseKey" => $licenseKey]);
            } else {
                $this->throwError(500, "Failed to generate license.");
            }
        } catch (Exception $e) {
            $this->throwError(500, "License creation failed: " . $e->getMessage());
        }
    }

    public function activate()
    {
        try {
            $licenseId = $this->validateParameter("licenseId", $this->param['licenseId'], INTEGER, true);
            $domain = $this->validateParameter("domain", $this->param['domain'], STRING, true);
            $deviceIdentifier = $this->validateParameter("deviceIdentifier", $this->param['deviceIdentifier'], STRING, true);

            $isActivated = $this->licenseModel->activateLicense($licenseId, $domain, $deviceIdentifier);
            if ($isActivated) {
                $this->returnResponse(200, "License activated successfully.");
            } else {
                $this->returnResponse(400, "License activation failed. Check limits or license status.");
            }
        } catch (Exception $e) {
            $this->throwError(500, "Activation failed: " . $e->getMessage());
        }
    }

    public function deactivate()
    {
        try {
            $licenseId = $this->validateParameter("licenseId", $this->param['licenseId'], INTEGER, true);
            $domain = $this->validateParameter("domain", $this->param['domain'], STRING, true);
            $deviceIdentifier = $this->validateParameter("deviceIdentifier", $this->param['deviceIdentifier'], STRING, true);

            $isDeactivated = $this->licenseModel->deactivateLicense($licenseId, $domain, $deviceIdentifier);
            if ($isDeactivated) {
                $this->returnResponse(200, "License deactivated successfully.");
            } else {
                $this->returnResponse(400, "License deactivation failed.");
            }
        } catch (Exception $e) {
            $this->throwError(500, "Deactivation failed: " . $e->getMessage());
        }
    }

    public function token()
    {
        $email = $this->validateParameter("email", $this->param['email'], STRING, true);
        $key = $this->validateParameter("licensekey", $this->param['licensekey'], STRING, true);
        // $domain = $this->validateParameter('domain', $this->param['domain'], STRING , true);
        $this->createToken($email,$key);

    }
    
    public function refreshtoken(){
            
            $oldToken = $this->validateParameter("expiredtoken" , $this->param['expiredtoken'], STRING,true);
         
            $this->tokenRefresh($oldToken);
    }


}
