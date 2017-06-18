<?php
define ("DB_HOST", "localhost"); // Your database host name
define ("DB_USER", "root"); // Your database user
define ("DB_PASS","1111"); // Your database password
define ("DB_NAME","bannedadsense"); // Your database name

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
?>