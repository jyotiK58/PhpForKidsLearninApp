
<?php
require "connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve posted parameters
    $userId = $_POST['user_id']; // Ensure this is sent from Android
    $time_spent = $_POST['time_spent'];
    $currentDate = date("Y-m-d"); // Get the current date

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO performance (user_id, time_spent, date) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $userId, $time_spent, $currentDate); // "iis" means integer, integer, string

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error; // Output error message
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
