<?php
// Parse database URL
$dbopts = parse_url(getenv('JAWSDB_URL'));

// Replace placeholders in Config class with actual values
$configFile = file_get_contents(__DIR__ . '/config.php');
$configFile = str_replace('HEROKU_DB_HOST', $dbopts['host'], $configFile);
$configFile = str_replace('HEROKU_DB_NAME', ltrim($dbopts['path'], '/'), $configFile);
$configFile = str_replace('HEROKU_DB_USERNAME', $dbopts['user'], $configFile);
$configFile = str_replace('HEROKU_DB_PASSWORD', $dbopts['pass'], $configFile);

// Write the updated config back to the file
file_put_contents(__DIR__ . '/config.php', $configFile);
