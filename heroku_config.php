<?php

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

// Load environment variables from .env file if it exists (for local development)
if (file_exists(__DIR__ . '/.env')) {
    $envFile = file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($envFile as $line) {
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            putenv("$key=$value");
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }
    }
}

// Determine the environment
$app_env = getenv('APP_ENV') ?: 'production';

if ($app_env === 'production') {
    // Parse database URL for production (Heroku)
    $dbopts = parse_url(getenv('JAWSDB_URL'));

    define('HEROKU_DB_HOST', $dbopts['host']);
    define('HEROKU_DB_NAME', ltrim($dbopts['path'], '/'));
    define('HEROKU_DB_USERNAME', $dbopts['user']);
    define('HEROKU_DB_PASSWORD', $dbopts['pass']);
    define('BASE_URL', 'https://easyappointments-abc994b31e34.herokuapp.com');
    define('DEBUG_MODE', false);
} else {
    // Use local environment variables for development
    define('HEROKU_DB_HOST', getenv('DB_HOST'));
    define('HEROKU_DB_NAME', getenv('DB_NAME'));
    define('HEROKU_DB_USERNAME', getenv('DB_USERNAME'));
    define('HEROKU_DB_PASSWORD', getenv('DB_PASSWORD'));
    define('BASE_URL', getenv('BASE_URL'));
    define('DEBUG_MODE', getenv('DEBUG_MODE') === 'true');
}
