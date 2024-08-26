<?php
header('Content-Type: application/json');

require "connection.php";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch questions and answers
$sql = "
    SELECT q.id AS question_id, q.question_text, a.id AS answer_id, a.answer_text, a.is_correct
    FROM QuizQuestions q
    LEFT JOIN QuizAnswer a ON q.id = a.question_id
";
$result = $conn->query($sql);

$questions = array();
$question_map = array();

while ($row = $result->fetch_assoc()) {
    $question_id = $row["question_id"];
    if (!isset($question_map[$question_id])) {
        $question_map[$question_id] = array(
            "id" => $question_id,
            "question_text" => $row["question_text"],
            "answers" => array()
        );
    }
    if ($row["answer_id"]) {
        $question_map[$question_id]["answers"][] = array(
            "id" => $row["answer_id"],
            "answer_text" => $row["answer_text"],
            // Convert is_correct to boolean
            "is_correct" => ($row["is_correct"] == '1')
        );
    }
}

// Encode to JSON
echo json_encode(array_values($question_map));

$conn->close();
?>
