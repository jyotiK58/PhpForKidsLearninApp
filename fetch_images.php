<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "KidsLearningApp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$category = $_GET['category'];
$sql = "SELECT imageurl FROM DetailCategory WHERE category_id = (SELECT id FROM LearningCategory WHERE type = ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $category);
$stmt->execute();
$result = $stmt->get_result();

$images = [];
while ($row = $result->fetch_assoc()) {
    $images[] = $row['imageurl'];
}

echo json_encode($images);

$stmt->close();
$conn->close();
?>