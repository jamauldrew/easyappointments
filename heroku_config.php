<?php
// Parse database URL
$dbopts = parse_url(getenv('JAWSDB_URL'));

// Check if config.php exists
if (file_exists(__DIR__ . '/config.php')) {
    // If it exists, read the existing config file
    $configFile = file_get_contents(__DIR__ . '/config.php');
} else {
    // Log that the config file does not exist
    error_log('Config file does not exist. Creating a new one from the sample.');

    // Check if config-sample.php exists before copying
    if (file_exists(__DIR__ . '/config-sample.php')) {
        // Create config.php from config-sample.php
        copy(__DIR__ . '/config-sample.php', __DIR__ . '/config.php');
        // Read from the newly created config.php
        $configFile = file_get_contents(__DIR__ . '/config.php');
    } else {
        // Log an error if config-sample.php is also missing
        error_log('Sample config file (config-sample.php) does not exist. Cannot create config.php.');
        return; // Exit the script or handle the error as needed
    }
}

// Replace placeholders in the configuration with actual values
$configFile = str_replace('HEROKU_DB_HOST', $dbopts['host'], $configFile);
$configFile = str_replace('HEROKU_DB_NAME', ltrim($dbopts['path'], '/'), $configFile);
$configFile = str_replace('HEROKU_DB_USERNAME', $dbopts['user'], $configFile);
$configFile = str_replace('HEROKU_DB_PASSWORD', $dbopts['pass'], $configFile);

// Write the updated config back to the file
file_put_contents(__DIR__ . '/config.php', $configFile);
