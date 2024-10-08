<?php
require "connection.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['user_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $phonenumber = $_POST['phonenumber'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    if (empty($firstname) || empty($lastname) || empty($email) || empty($username) || empty($phonenumber) || empty($address)) {
        echo json_encode(['status' => 'error', 'message' => 'Please fill all fields']);
        exit();
    }

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
            echo json_encode(['status' => 'success', 'message' => 'Update successful!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error executing statement: ' . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error preparing statement: ' . $conn->error]);
    }

    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>