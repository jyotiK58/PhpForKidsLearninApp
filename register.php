<?php
require "connection.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if POST data is received
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Extract POST data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $phonenumber = $_POST['phonenumber'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    // Validate data (you can add more validation as per your requirements)
    if (empty($firstname) || empty($lastname) || empty($email) || empty($username) || empty($phonenumber) || empty($address) || empty($password)) {
        echo "Please fill all fields";
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement to insert data
    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, username, password, phone_number, address) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
        exit();
    }

    // Bind parameters to the SQL statement
    $stmt->bind_param("sssssss", $firstname, $lastname, $email, $username, $hashed_password, $phonenumber, $address);

    // Execute the statement
   // Execute the statement
if ($stmt->execute()) {
    echo "Registration successful!";
} else {
    echo "Error executing statement: " . $stmt->error;
}

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method!";
}
?>
