<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Send a response to indicate success
    echo json_encode(["status" => "success", "message" => "Logout successful"]);
} 
?>
