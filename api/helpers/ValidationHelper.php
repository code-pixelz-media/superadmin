<?php

class ValidationHelper
{
    public static function validateUserId($userId)
    {
        return is_numeric($userId) && $userId > 0;
    }

    public static function validateProductId($productId)
    {
        return is_numeric($productId) && $productId > 0;
    }

    public static function validateLicenseKey($licenseKey)
    {
        return preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i', $licenseKey);
    }

    public static function validateParameter($fieldName, $value, $dataType, $required = true)
    {

        if ($required && empty($value)) {
            ResponseHelper::throwError(400, $fieldName . " parameter is required.");
        }
        switch ($dataType) {
            case 'BOOLEAN':
                if (!is_bool($value)) {
                    ResponseHelper::throwError(400, "Datatype is not valid for " . $fieldName . ". It should be boolean.");
                }
                break;
            case 'INTEGER':
                if (!is_numeric($value)) {
                    ResponseHelper::throwError(400, "Datatype is not valid for " . $fieldName . ". It should be numeric.");
                }
                break;
            case 'STRING':
                if (!is_string($value)) {
                    ResponseHelper::throwError(400, "Datatype is not valid for " . $fieldName . ". It should be string.");
                }
                break;
            default:
                ResponseHelper::throwError(400, "Datatype is not valid for " . $fieldName);
                break;
        }

        return $value;
    }
}