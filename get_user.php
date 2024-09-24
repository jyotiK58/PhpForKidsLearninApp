<?php
require "connection.php"; // Include your database connection

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if user_id is provided via GET
if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];

    $sql = "SELECT id, firstname, lastname, email, username, phone_number, address FROM users WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            echo json_encode(['status' => 'success', 'data' => $user]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not found']);
        }
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error preparing statement: ' . $conn->error]);
    }
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request, user_id missing']);
}
?>