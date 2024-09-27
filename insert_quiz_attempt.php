<?php
// insert_quiz_attempt.php

require "connection.php";

// Log incoming POST data for debugging
file_put_contents('debug.log', print_r($_POST, true)); // This will log the POST data

// Get data from POST request
$user_id = $_POST['user_id'];
$quizquestion_id = $_POST['quizquestion_id'];
$selected_answer_id = $_POST['selected_answer_id'];
$is_correct = $_POST['is_correct'];
$attempt_date = date("Y-m-d H:i:s", $_POST['attempt_date'] / 1000); // Convert milliseconds to seconds

// Prepare the SQL statement to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO quiz_attempts (user_id, quizquestion_id, selected_answer_id, is_correct, attempt_date) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("iiiss", $user_id, $quizquestion_id, $selected_answer_id, $is_correct, $attempt_date);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Quiz attempt recorded successfully."]);
} else {
    echo json_encode(["status" => "error", "message" => "Error recording quiz attempt: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>