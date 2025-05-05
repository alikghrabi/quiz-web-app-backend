<?php

header('Content-Type: application/json');
require 'db.php';

if (!isset($_GET['quiz_id'])) {
    echo json_encode(["success" => false, "message" => "Quiz ID required"]);
    exit;
}

$quiz_id = $_GET['quiz_id'];

$stmt = $connect->prepare("SELECT * FROM questions WHERE quiz_id = ? ORDER BY created_at ASC");
$stmt->execute([$quiz_id]);

$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(["success" => true, "questions" => $questions]);
?>
