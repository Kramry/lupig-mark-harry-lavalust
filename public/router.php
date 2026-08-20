<?php
// Development server router for URL rewriting
$requested = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

// Serve static files and directories as-is
if (preg_match('/\.(?:js|css|png|jpg|jpeg|gif|svg|ico|woff|woff2|ttf|eot)$/', $requested)) {
    return false;
}

// Check if file exists (don't route static files)
if ($requested !== '/' && file_exists(__DIR__ . $requested)) {
    return false;
}

// Route all requests through index.php, simulating /index.php/path format
$_SERVER['REQUEST_URI'] = '/index.php' . $requested;
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['PHP_SELF'] = '/index.php' . $requested;

require __DIR__ . '/index.php';
?>
