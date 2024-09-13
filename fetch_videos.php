<?php
// fetch_videos.php

header('Content-Type: application/json');

require "connection.php";

// Get category from the request
$category = isset($_GET['category']) ? $_GET['category'] : '';

if (empty($category)) {
    echo json_encode(["error" => "No category specified"]);
    exit();
}

// Prepare and execute SQL query
$sql = "SELECT video_url FROM videos WHERE category = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $category);
$stmt->execute();
$result = $stmt->get_result();

// Fetch all video URLs and encode them as JSON
$videoUrls = [];
while ($row = $result->fetch_assoc()) {
    $videoUrls[] = $row['video_url'];
}

echo json_encode($videoUrls);

// Close the connection
$stmt->close();
$conn->close();
?>
