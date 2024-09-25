<?php
require 'connection.php';

if (isset($_GET['query'])) {
    $searchTerm = $_GET['query'];

    // Prepare SQL query to search in the "type" field
    $stmt = $conn->prepare("SELECT id, type, image_url FROM learningcategory WHERE type LIKE ?");
    $searchTerm = "%" . $searchTerm . "%"; // Add wildcards for partial matching
    $stmt->bind_param("s", $searchTerm);

    $stmt->execute();
    $result = $stmt->get_result();

    $categories = array();
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }

    if (count($categories) > 0) {
        echo json_encode(array("categories" => $categories));
    } else {
        echo json_encode(array("message" => "No categories found"));
    }

    $stmt->close();
}
$conn->close();
?>