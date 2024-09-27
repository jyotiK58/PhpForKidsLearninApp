<?php
header('Content-Type: application/json');

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', 'path/to/your/error.log');

require "connection.php"; 

// Check if the connection is successful
if ($conn->connect_error) {
    echo json_encode(["error" => "Connection failed: " . $conn->connect_error]);
    exit;
}

// Check if the category parameter is set
if (!isset($_GET['category'])) {
    echo json_encode(["error" => "No category provided"]);
    exit;
}

$category = $_GET['category'];

// Prepare the SQL statement
$sql = "
    SELECT q.id, q.question_text, a.id AS answer_id, a.answer_text, a.is_correct 
    FROM QuizQuestions q 
    JOIN QuizAnswer a ON q.id = a.question_id 
    WHERE q.category_id = (SELECT id FROM LearningCategory WHERE type = ?)
";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    error_log("SQL prepare error: " . $conn->error);
    echo json_encode(["error" => "Failed to prepare statement"]);
    exit;
}

$stmt->bind_param("s", $category);
if (!$stmt->execute()) {
    error_log("SQL execution error: " . $stmt->error);
    echo json_encode(["error" => "Failed to execute statement"]);
    exit;
}

$result = $stmt->get_result();
$questions = [];

// Fetch questions and their corresponding answers
while ($row = $result->fetch_assoc()) {
    $questionId = $row['id'];

    if (!isset($questions[$questionId])) {
        $questions[$questionId] = [
            'id' => $questionId,
            'question_text' => $row['question_text'],
            'answers' => []
        ];
    }

    $questions[$questionId]['answers'][] = [
        'id' => $row['answer_id'],
        'answer_text' => $row['answer_text'],
        // Convert integer (0 or 1) to boolean (false or true)
        'is_correct' => (bool) $row['is_correct'] 
    ];
}

$questions = array_values($questions);
echo json_encode($questions);

$stmt->close();
$conn->close();
?>
