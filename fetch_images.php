<?php
header('Content-Type: application/json');

require "connection.php";

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