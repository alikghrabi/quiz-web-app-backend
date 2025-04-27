<?php
header('Content-Type: application/json');
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['name'], $data['email'], $data['password'])) {
    echo json_encode(["success" => false, "message" => "Missing fields"]);
    exit;
}

$name = $data['name'];
$email = $data['email'];
$password = password_hash($data['password'], PASSWORD_DEFAULT);

$check = $connect->prepare("SELECT id FROM users WHERE email = ?");
$check->execute([$email]);

if ($check->rowCount() > 0) {
    echo json_encode(["success" => false, "message" => "Email already registered"]);
} else {
    $insert = $connect->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $insert->execute([$name, $email, $password]);

    echo json_encode(["success" => true, "message" => "Registration successful"]);
}
?>
