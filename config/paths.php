<?php

/**
 * Dynamic Base Path Helper for BERMS
 * This file provides functions to get correct paths regardless of deployment structure
 */

// Get the root directory of the application
$appRoot = dirname(__DIR__);

// Define path constants
define('APP_ROOT', $appRoot);
define('CONFIG_PATH', APP_ROOT . '/config');
define('PAGES_PATH', APP_ROOT . '/pages');
define('ADMIN_PATH', APP_ROOT . '/admin');
define('UPLOADS_PATH', APP_ROOT . '/uploads');
define('IMAGES_PATH', APP_ROOT . '/images');
define('ASSETS_PATH', APP_ROOT . '/assets');
define('DATABASE_PATH', APP_ROOT . '/database');

/**
 * Get the base URL of the application
 * This is used for generating URLs in HTML
 */
function baseUrl() {
    // Check if APP_URL is set in environment
    if (function_exists('env')) {
        $appUrl = env('APP_URL');
        if ($appUrl) {
            return rtrim($appUrl, '/');
        }
    }
    
    // Fallback to dynamic URL calculation
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $basePath = dirname($_SERVER['SCRIPT_NAME']);
    
    // Normalize base path
    $basePath = str_replace('\\', '/', $basePath);
    $basePath = rtrim($basePath, '/');
    
    return "$protocol://$host$basePath";
}

/**
 * Get relative path from a specific page
 */
function getRelativePath($targetPath, $fromFile = __FILE__) {
    $fromDir = dirname($fromFile);
    $relative = '';
    
    // Count how many directories up we need to go
    $currentDir = dirname($fromFile);
    $appDir = dirname(__DIR__);
    
    if (strpos($targetPath, APP_ROOT) !== 0) {
        $targetPath = APP_ROOT . '/' . ltrim($targetPath, '/');
    }
    
    $relative = '';
    $temp = $currentDir;
    
    while (strlen($temp) > strlen($appDir) && strpos($targetPath, $temp) !== 0) {
        $relative .= '../';
        $temp = dirname($temp);
    }
    
    $relative .= str_replace($temp . '/', '', $targetPath);
    $relative = str_replace('\\', '/', $relative);
    
    return $relative;
}

/**
 * Asset URL - for CSS, JS, images
 */
function assetUrl($path) {
    return baseUrl() . '/' . ltrim($path, '/');
}

/**
 * Image URL
 */
function imageUrl($imageName) {
    return assetUrl('images/' . ltrim($imageName, '/'));
}

/**
 * Page URL
 */
function pageUrl($pageName) {
    return baseUrl() . '/pages/' . ltrim($pageName, '/');
}

/**
 * Admin URL
 */
function adminUrl($adminPage) {
    return baseUrl() . '/admin/' . ltrim($adminPage, '/');
}

/**
 * Upload URL - for serving uploaded files
 */
function uploadUrl($uploadPath) {
    return baseUrl() . '/uploads/' . ltrim($uploadPath, '/');
}

/**
 * Report upload URL
 */
function reportUploadUrl($fileName) {
    return assetUrl('report_uploads/' . ltrim($fileName, '/'));
}

?>