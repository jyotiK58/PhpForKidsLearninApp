<?php
header('Content-Type: application/json');
require "connection.php";

// Log connection errors
if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error);
    die(json_encode(array('error' => 'Connection failed: ' . $conn->connect_error)));
}

// Update SQL query to fetch 'image_url'
$sql = "SELECT vd.id, vd.title, vd.video_url, vd.image_url, vc.type 
        FROM VideoDetail vd 
        JOIN VideoCategory vc ON vd.category_id = vc.id";
$result = $conn->query($sql);

// Log query errors
if (!$result) {
    error_log("Query failed: " . $conn->error);
    die(json_encode(array('error' => 'Query failed: ' . $conn->error)));
}

$videos = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $videos[] = $row;
    }
} else {
    error_log("No videos found in the database.");
}

// Return a structured response with "videos" array including 'image_url'
echo json_encode(array('videos' => $videos));

$conn->close();
?>