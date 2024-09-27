<?php
// Database connection
require "connection.php";

// Check if the request method is POST and content type is JSON
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SERVER["CONTENT_TYPE"]) && $_SERVER["CONTENT_TYPE"] === "application/json") {

    // Get the raw POST data (JSON)
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    // Log incoming data for debugging
    error_log(print_r($data, true)); // Log incoming data

    // Extract data from the JSON request and validate
    $user_id = isset($data['user_id']) ? $data['user_id'] : null;
    $score = isset($data['score']) ? $data['score'] : null;
    $time_spent = isset($data['time_spent']) ? $data['time_spent'] : null;
    $quiz_attempts = isset($data['quiz_attempts']) ? $data['quiz_attempts'] : null;
    $progress = isset($data['progress']) ? $data['progress'] : null;
    $level = isset($data['level']) ? $data['level'] : null;

    // Check for missing data
    if (is_null($user_id) || is_null($score) || is_null($time_spent) || is_null($quiz_attempts) || is_null($progress) || is_null($level)) {
        echo json_encode(array("status" => "error", "message" => "Missing data fields."));
        exit;
    }

    // Current date
    $date = date('Y-m-d');

    // Prepare the SQL query
    $sql = "INSERT INTO performance (user_id, score, time_spent, date, level, progress, quiz_attempts)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo json_encode(array("status" => "error", "message" => "Failed to prepare statement: " . $conn->error));
        exit;
    }

    // Bind parameters (use d for double if progress is a float)
    $stmt->bind_param("iiisidi", $user_id, $score, $time_spent, $date, $level, $progress, $quiz_attempts);

    // Execute the statement
    if ($stmt->execute()) {
        $response = array("status" => "success", "message" => "Performance data inserted successfully.");
    } else {
        $response = array("status" => "error", "message" => "Failed to insert performance data: " . $stmt->error);
    }

    // Return the response as JSON
    echo json_encode($response);

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(array("status" => "error", "message" => "Invalid request method or content type."));
}
?>