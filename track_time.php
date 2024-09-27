<?php
require "connection.php";

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Get parameters from POST request
$user_id = isset($_POST['user_id']) ? (int)$_POST['user_id'] : '';
$category_name = isset($_POST['category']) ? $_POST['category'] : '';
$time_spent = isset($_POST['time_spent']) ? (int)$_POST['time_spent'] : '';

// Check if the required parameters are set
if (empty($user_id) || empty($category_name) || empty($time_spent)) {
    echo json_encode(["status" => "error", "message" => "Missing parameters"]);
    $conn->close();
    exit;
}

// Check if the database connection is successful
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database connection failed: " . $conn->connect_error]);
    exit;
}

// Fetch the category_id based on the category name
$sql_category = "SELECT id FROM LearningCategory WHERE type = ?";
$stmt_category = $conn->prepare($sql_category);
$stmt_category->bind_param("s", $category_name);
$stmt_category->execute();
$result_category = $stmt_category->get_result();

if ($result_category->num_rows > 0) {
    $row = $result_category->fetch_assoc();
    $category_id = $row['id'];

    // Check if an entry already exists for the user and category
    $sql = "SELECT * FROM user_time_tracking WHERE user_id = ? AND category_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $category_id); // Using integers for user_id and category_id
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Entry exists, update the time
        $sql_update = "UPDATE user_time_tracking SET time_spent = time_spent + ? WHERE user_id = ? AND category_id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("iii", $time_spent, $user_id, $category_id);
        if ($stmt_update->execute()) {
            echo json_encode(["status" => "success", "message" => "Time updated successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error updating time: " . $stmt_update->error]);
        }
        $stmt_update->close();
    } else {
        // Entry doesn't exist, insert a new record
        $sql_insert = "INSERT INTO user_time_tracking (user_id, category_id, time_spent) VALUES (?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("iii", $user_id, $category_id, $time_spent);
        if ($stmt_insert->execute()) {
            echo json_encode(["status" => "success", "message" => "Time inserted successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error inserting time: " . $stmt_insert->error]);
        }
        $stmt_insert->close();
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Category not found"]);
}

$stmt_category->close();
$conn->close();
?>
