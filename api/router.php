<?php
// Vercel PHP router for the BERMS application.
// This file lets Vercel execute the PHP app through a single API function.

$documentRoot = realpath(__DIR__ . '/../');
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rawurldecode($uri);
$uri = preg_replace('#/+#', '/', $uri);

$staticPrefixes = [
    '/img',
    '/assets',
    '/images',
    '/uploads',
    '/report_uploads',
    '/admin_uploads',
];
foreach ($staticPrefixes as $prefix) {
    if ($uri === $prefix || str_starts_with($uri, $prefix . '/')) {
        http_response_code(404);
        echo 'Not found';
        exit;
    }
}

if ($uri === '' || $uri === '/') {
    $relativePath = '/index.php';
} else {
    $relativePath = $uri;
}

$filePath = $documentRoot . $relativePath;
if (is_dir($filePath)) {
    $filePath = rtrim($filePath, '/') . '/index.php';
}

if (!file_exists($filePath) || !is_file($filePath)) {
    http_response_code(404);
    echo '404 Not Found';
    exit;
}

$realFile = realpath($filePath);
if ($realFile === false || !str_starts_with($realFile, $documentRoot)) {
    http_response_code(403);
    echo '403 Forbidden';
    exit;
}

$_SERVER['SCRIPT_FILENAME'] = $realFile;
$_SERVER['SCRIPT_NAME'] = $relativePath;
$_SERVER['PHP_SELF'] = $relativePath;
$_SERVER['DOCUMENT_ROOT'] = $documentRoot;

chdir(dirname($realFile));

require $realFile;
