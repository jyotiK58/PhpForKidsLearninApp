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
$wrong_count = $_POST['wrong'] ?? null; // Get wrong count

if ($user_id === null || $category_id === null || $correct_count === null || $wrong_count === null) {
    echo json_encode(['error' => 'Missing parameters.']);
    exit;
}

try {
    // Check if an entry already exists
    $checkQuery = "SELECT * FROM user_quiz_category WHERE user_id = ? AND category_id = ?";
    $checkStmt = $conn->prepare($checkQuery);

    if ($checkStmt === false) {
        echo json_encode(['error' => 'Error preparing check statement: ' . $conn->error]);
        exit;
    }

    $checkStmt->bind_param("ii", $user_id, $category_id);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        // Update the existing entry
        $updateQuery = "UPDATE user_quiz_category SET correct_answers_count = correct_answers_count + ?, wrong_answers_count = wrong_answers_count + ? WHERE user_id = ? AND category_id = ?";
        $updateStmt = $conn->prepare($updateQuery);

        if ($updateStmt === false) {
            echo json_encode(['error' => 'Error preparing update statement: ' . $conn->error]);
            exit;
        }

        $updateStmt->bind_param("iiii", $correct_count, $wrong_count, $user_id, $category_id);

        if ($updateStmt->execute() === false) {
            echo json_encode(['error' => 'Error executing update statement: ' . $updateStmt->error]);
        } else {
            echo json_encode(['success' => true, 'message' => 'Results updated successfully']);
        }

        $updateStmt->close();
    } else {
        // Insert a new entry
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
    }

    $checkStmt->close();
} catch (Exception $e) {
    echo json_encode(['error' => 'Caught exception: ' . $e->getMessage()]);
} finally {
    $conn->close();
}
?>
