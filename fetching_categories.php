<?php
header('Content-Type: application/json');
require "connection.php";

$sql = "SELECT type, image_url FROM LearningCategory";
$result = $conn->query($sql);

$categories = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}

$conn->close();

echo json_encode($categories);
?>
