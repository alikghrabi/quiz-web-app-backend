<?php

$host = "localhost";
$dbname = "qwizwebapp";
$username = "root";
$password = "";

try {
    $connect = new PDO("mysql:host=$host;port=3306;dbname=$dbname", $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(["success" => false, "message" => "Database connection failed: " . $e->getMessage()]));
}
?>
