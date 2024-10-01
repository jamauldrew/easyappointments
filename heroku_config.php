<?php
// Parse database URL
$dbopts = parse_url(getenv('JAWSDB_URL'));

// Replace placeholders in Config class with actual values
if (file_exists(__DIR__ . '/config.php')) {
    $configFile = file_get_contents(__DIR__ . '/config.php');
} else {
    error_log('Config file does not exist. Creating a new one from the sample.');
    copy(__DIR__ . '/config-sample.php', __DIR__ . '/config.php');
    $configFile = file_get_contents(__DIR__ . '/config-sample.php');
}
$configFile = str_replace('HEROKU_DB_HOST', $dbopts['host'], $configFile);
$configFile = str_replace('HEROKU_DB_NAME', ltrim($dbopts['path'], '/'), $configFile);
$configFile = str_replace('HEROKU_DB_USERNAME', $dbopts['user'], $configFile);
$configFile = str_replace('HEROKU_DB_PASSWORD', $dbopts['pass'], $configFile);

// Write the updated config back to the file
file_put_contents(__DIR__ . '/config.php', $configFile);
