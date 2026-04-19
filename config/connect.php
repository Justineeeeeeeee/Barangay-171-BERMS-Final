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

// Check connection
if($conn->connect_error){
    // On Vercel, provide helpful error message
    if (getenv('VERCEL')) {
        die("❌ Database Connection Error on Vercel\n\n" .
            "Error: " . $conn->connect_error . "\n\n" .
            "SOLUTION:\n" .
            "1. Go to your Vercel project dashboard\n" .
            "2. Go to Settings → Environment Variables\n" .
            "3. Add these variables:\n" .
            "   DB_HOST=<your-database-host>\n" .
            "   DB_USER=<your-database-user>\n" .
            "   DB_PASSWORD=<your-database-password>\n" .
            "   DB_NAME=<your-database-name>\n\n" .
            "Use services like:\n" .
            "- JawsDB (jawsdb.com)\n" .
            "- Hostinger Remote MySQL\n" .
            "- AWS RDS\n"
        );
    } else {
        die("Connection failed: " . $conn->connect_error);
    }
}

?>
