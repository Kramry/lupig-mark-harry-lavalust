<?php
// Development server router for URL rewriting
$requested = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

// Serve static files and directories as-is
if (is_file(__DIR__ . $requested) || is_dir(__DIR__ . $requested)) {
    // Check if it's a static asset
    if (preg_match('/\.(?:js|css|png|jpg|jpeg|gif|svg|ico|woff|woff2|ttf|eot)$/', $requested)) {
        return false;
    }
}

// Route all other requests through index.php
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['PHP_SELF'] = $requested;

require __DIR__ . '/index.php';
?>
