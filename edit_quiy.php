<?php
header('Content-Type: application/json');
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id'], $data['title'])) {
    echo json_encode(["success" => false, "message" => "Missing fields"]);
    exit;
}

$id = $data['id'];
$title = $data['title'];
$description = $data['description'] ?? '';

$stmt = $connect->prepare("UPDATE quizzes SET title = ?, description = ? WHERE id = ?");
$stmt->execute([$title, $description, $id]);

echo json_encode(["success" => true, "message" => "Quiz updated successfully"]);
?>
