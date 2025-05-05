<?php
header('Content-Type: application/json');
require 'db.php';

$stmt = $connect->query("SELECT * FROM quizzes ORDER BY created_at DESC");
$quizzes = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(["success" => true, "quizzes" => $quizzes]);
?>
