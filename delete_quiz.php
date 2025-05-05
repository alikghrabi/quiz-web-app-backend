<?php
header('Content-Type: application/json');
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id'])) {
    echo json_encode(["success" => false, "message" => "Quiz ID required"]);
    exit;
}

$id = $data['id'];

$stmt = $connect->prepare("DELETE FROM quizzes WHERE id = ?");
$stmt->execute([$id]);

echo json_encode(["success" => true, "message" => "Quiz deleted successfully"]);
?>
