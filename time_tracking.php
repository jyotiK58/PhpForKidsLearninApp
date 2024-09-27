<?php
header('Content-Type: application/json');
require 'connection.php'; // Your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id']; // Get user ID from the request
    $timeSpent = $_POST['time_spent']; // Get time spent

    // Insert or update the time spent for the user
    $stmt = $conn->prepare("INSERT INTO UserTime (user_id, time_spent) VALUES (?, ?) ON DUPLICATE KEY UPDATE time_spent = time_spent + VALUES(time_spent)");
    $stmt->bind_param("ii", $userId, $timeSpent);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }

    $stmt->close();
}

$conn->close();
?>