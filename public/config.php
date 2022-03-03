<?php
require_once __DIR__ . "/../vendor/autoload.php";
Dotenv\Dotenv::createImmutable(__DIR__ . '/../')->load();

define('BASE_URL', $_ENV['BASE_URL']);

define('DB_CONNECTION', $_ENV['DB_CONNECTION']);
define('DB_PORT', $_ENV['DB_PORT']);
define('DB_DATABASE', $_ENV['DB_DATABASE']);
define('DB_HOST', $_ENV['DB_HOST']);
define('DB_USERNAME', $_ENV['DB_USERNAME']);
define('DB_PASSWORD', $_ENV['DB_PASSWORD']);
