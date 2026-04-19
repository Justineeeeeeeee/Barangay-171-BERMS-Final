<?php

// Include path helpers first
require_once __DIR__ . '/paths.php';

// Include environment helper functions
require_once __DIR__ . '/env.php';

// Simple .env loader function
function loadEnv($path) {
    if (!file_exists($path)) {
        return false;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Skip comments
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        // Parse key=value
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);

            // Remove quotes if present
            if (preg_match('/^["\'](.*)["\']$/', $value, $matches)) {
                $value = $matches[1];
            }

            putenv("$key=$value");
            $_ENV[$key] = $value;
        }
    }
    return true;
}

// Load environment variables
$envPath = __DIR__ . '/../.env';
loadEnv($envPath);

// Database configuration from environment
$host = env('DB_HOST', 'localhost');
$user = env('DB_USER', 'root');
$password = env('DB_PASSWORD', '');
$dbname = env('DB_NAME', 'incident_system');

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Don't die immediately - let the calling script handle connection errors
// if($conn->connect_error){
//     die("Connection failed: " . $conn->connect_error);
// }

?>
