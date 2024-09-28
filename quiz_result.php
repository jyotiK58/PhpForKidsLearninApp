<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kidslearningapp";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

$user_id = $_POST['user_id'] ?? null;
$category_id = $_POST['category_id'] ?? null;
$correct_count = $_POST['correct'] ?? null;
$wrong_count = $_POST['wrong'] ?? null;

if ($user_id === null || $category_id === null || $correct_count === null || $wrong_count === null) {
    echo json_encode(['error' => 'Missing parameters.']);
    exit;
}

try {
    // Delete any existing records for this user and category
    $deleteQuery = "DELETE FROM user_quiz_category WHERE user_id = ? AND category_id = ?";
    $deleteStmt = $conn->prepare($deleteQuery);

    if ($deleteStmt === false) {
        echo json_encode(['error' => 'Error preparing delete statement: ' . $conn->error]);
        exit;
    }

    $deleteStmt->bind_param("ii", $user_id, $category_id);

    if ($deleteStmt->execute() === false) {
        echo json_encode(['error' => 'Error executing delete statement: ' . $deleteStmt->error]);
        exit;
    }

    $deleteStmt->close();

    // Insert the new results
    $insertQuery = "INSERT INTO user_quiz_category (user_id, category_id, correct_answers_count, wrong_answers_count) VALUES (?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertQuery);

    if ($insertStmt === false) {
        echo json_encode(['error' => 'Error preparing insert statement: ' . $conn->error]);
        exit;
    }

    $insertStmt->bind_param("iiii", $user_id, $category_id, $correct_count, $wrong_count);

    if ($insertStmt->execute() === false) {
        echo json_encode(['error' => 'Error executing insert statement: ' . $insertStmt->error]);
    } else {
        echo json_encode(['success' => true, 'message' => 'Results inserted successfully']);
    }

    $insertStmt->close();
} catch (Exception $e) {
    echo json_encode(['error' => 'Caught exception: ' . $e->getMessage()]);
} finally {
    $conn->close();
}
?>
