<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "KidsApp";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$totalCorrectAnswers = $_POST['total_correct_answers'];

$sql = "INSERT INTO results (correct_answer) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $totalCorrectAnswers);

if ($stmt->execute()) {
    echo "Success";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

