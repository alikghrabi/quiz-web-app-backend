<?php
header('Content-Type: application/json');
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['quiz_id'], $data['question_text'], $data['option1'], $data['option2'], $data['option3'], $data['correct_option'])) {
    echo json_encode(["success" => false, "message" => "Missing fields"]);
    exit;
}

$stmt = $connect->prepare("INSERT INTO questions (quiz_id, question_text, option1, option2, option3, correct_option) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->execute([
    $data['quiz_id'],
    $data['question_text'],
    $data['option1'],
    $data['option2'],
    $data['option3'],
    $data['correct_option']
]);

echo json_encode(["success" => true, "message" => "Question created successfully"]);
?>
