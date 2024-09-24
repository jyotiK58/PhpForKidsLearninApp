<?php
require "connection.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start the session at the beginning
session_start();

// Check if POST data is received
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Extract POST data
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate data
    if (empty($username) || empty($password)) {
        echo json_encode(["status" => "error", "message" => "Please fill all fields"]);
        exit();
    }

    // Prepare SQL statement to fetch user data
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "Error preparing statement: " . $conn->error]);
        exit();
    }

    // Bind parameters to the SQL statement
    $stmt->bind_param("s", $username);

    // Execute the statement
    $stmt->execute();

    // Store the result
    $stmt->store_result();

    // Check if the user exists
    if ($stmt->num_rows > 0) {
        // Bind the result
        $stmt->bind_result($userId, $hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Regenerate session ID to prevent session fixation attacks
            session_regenerate_id(true);

            // Set session variables for login
            $_SESSION['user_id'] = $userId;
            $_SESSION['username'] = $username;
            $_SESSION['login_time'] = time(); // Store the login timestamp

            // Return success response with user ID
            echo json_encode(["status" => "success", "user_id" => $userId, "message" => "Login successful!"]);
            exit();
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid password."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "User not found."]);
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method!"]);
}

// Session expiration check
if (isset($_SESSION['login_time'])) {
    // Check if the session has expired (6 hours = 21600 seconds)
    if (time() - $_SESSION['login_time'] > 21600) { // Changed to 21600 for 6 hours
        // Session expired
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }
}
?>