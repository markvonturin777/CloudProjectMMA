<?php
require 'vendor/autoload.php';
use League\Plates\Engine;

$dsn = 'mysql:dbname=mma;port=3306;host=localhost';
$user = 'root';
$password = '';
try {
 $pdo = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
 echo 'Connection failed: ' . $e->getMessage();
exit();
}   