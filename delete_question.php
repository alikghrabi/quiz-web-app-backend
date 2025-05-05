<?php

header('Content-Type: application/json');
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id'])) {
    echo json_encode(["success" => false, "message" => "Question ID required"]);
    exit;
}

$id = $data['id'];

$stmt = $connect->prepare("DELETE FROM questions WHERE id = ?");
$stmt->execute([$id]);

echo json_encode(["success" => true, "message" => "Question deleted successfully"]);
?>
