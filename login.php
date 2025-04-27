<?php

header('Content-Type: application/json');
require 'connect.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['email'], $data['password'])) {
    echo json_encode(["success" => false, "message" => "Missing fields"]);
    exit;
}

$email = $data['email'];
$password = $data['password'];

$select = $connect->prepare("SELECT * FROM users WHERE email = ?");
$select->execute([$email]);

$user = $select->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    echo json_encode([
        "success" => true,
        "message" => "Login successful",
        "user" => [
            "id" => $user['id'],
            "name" => $user['name'],
            "email" => $user['email'],
            "is_admin" => (bool) $user['is_admin']
        ]
    ]);
} else {
    echo json_encode(["success" => false, "message" => "Invalid email or password"]);
}
?>
