<?php
/**
 * Database configuration
 */
/*
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mystoredb";
$conn = new mysqli($servername, $username, $password, $dbname);
*/
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
define('DB_NAME', 'mystoredb');

$db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
?>
