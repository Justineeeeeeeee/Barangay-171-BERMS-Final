<?php

// Environment Helper Functions for BERMS
// Include this file to access environment variables easily

/**
 * Get environment variable with optional default value
 */
function env($key, $default = null) {
    $value = getenv($key);
    if ($value === false) {
        return $default;
    }
    return $value;
}

/**
 * Check if application is in debug mode
 */
function isDebug() {
    return env('APP_DEBUG', 'false') === 'true';
}

/**
 * Check if application is in production
 */
function isProduction() {
    return env('APP_ENV', 'development') === 'production';
}

/**
 * Get application URL
 */
function appUrl() {
    return env('APP_URL', 'http://localhost');
}

/**
 * Get upload configuration
 */
function getUploadConfig() {
    return [
        'max_size' => (int) env('UPLOAD_MAX_SIZE', 10485760), // 10MB default
        'allowed_types' => explode(',', env('ALLOWED_FILE_TYPES', 'jpg,jpeg,png,gif,mp4,avi'))
    ];
}

/**
 * Get barangay information
 */
function getBarangayInfo() {
    return [
        'name' => env('BARANGAY_NAME', 'Barangay 171'),
        'captain' => env('BARANGAY_CAPTAIN', 'John Dela Cruz'),
        'contact' => env('BARANGAY_CONTACT', '+63 917-123-4567')
    ];
}

/**
 * Get emergency contacts
 */
function getEmergencyContacts() {
    return [
        'fire' => env('EMERGENCY_FIRE', '+63 917-123-4567'),
        'ambulance' => env('EMERGENCY_AMBULANCE', '+63 917-234-5678'),
        'police' => env('EMERGENCY_POLICE', '+63 917-345-6789')
    ];
}

/**
 * Get mail configuration
 */
function getMailConfig() {
    return [
        'mailer' => env('MAIL_MAILER', 'smtp'),
        'host' => env('MAIL_HOST', 'smtp.gmail.com'),
        'port' => (int) env('MAIL_PORT', 587),
        'username' => env('MAIL_USERNAME'),
        'password' => env('MAIL_PASSWORD'),
        'encryption' => env('MAIL_ENCRYPTION', 'tls'),
        'from_address' => env('MAIL_FROM_ADDRESS', 'noreply@berms.gov.ph'),
        'from_name' => env('MAIL_FROM_NAME', 'BERMS System')
    ];
}

?>