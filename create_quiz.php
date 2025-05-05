<?php
header('Content-Type: application/json');
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['title'])) {
    echo json_encode(["success" => false, "message" => "Title is required"]);
    exit;
}

$title = $data['title'];
$description = $data['description'] ?? '';

$stmt = $connect->prepare("INSERT INTO quizzes (title, description) VALUES (?, ?)");
$stmt->execute([$title, $description]);

echo json_encode(["success" => true, "message" => "Quiz created successfully"]);
?>
