<?php
require "connection.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if POST data is received
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Extract POST data
    $userId = isset($_POST['user_id']) ? $_POST['user_id'] : null; // Get user_id if provided
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $phonenumber = $_POST['phonenumber'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    // Validate data
    if (empty($firstname) || empty($lastname) || empty($email) || empty($username) || empty($phonenumber) || empty($address)) {
        echo json_encode(["status" => "error", "message" => "Please fill all fields"]);
        exit();
    }

    // Check if user_id is provided for update
    if ($userId) {
        // Update user
        $sql = "UPDATE users SET firstname = ?, lastname = ?, email = ?, username = ?, phone_number = ?, address = ?";
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql .= ", password = ?";
        }
        $sql .= " WHERE id = ?";

        if ($stmt = $conn->prepare($sql)) {
            if (!empty($password)) {
                $stmt->bind_param("sssssssi", $firstname, $lastname, $email, $username, $phonenumber, $address, $hashed_password, $userId);
            } else {
                $stmt->bind_param("ssssssi", $firstname, $lastname, $email, $username, $phonenumber, $address, $userId);
            }

            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Update successful!"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error executing statement: " . $stmt->error]);
            }

            $stmt->close();
        } else {
            echo json_encode(["status" => "error", "message" => "Error preparing statement: " . $conn->error]);
        }
    } else {
        // Register new user
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, username, password, phone_number, address) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            echo json_encode(["status" => "error", "message" => "Error preparing statement: " . $conn->error]);
            exit();
        }

        $stmt->bind_param("sssssss", $firstname, $lastname, $email, $username, $hashed_password, $phonenumber, $address);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Registration successful!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error executing statement: " . $stmt->error]);
        }

        $stmt->close();
    }

    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method!"]);
}
?>
