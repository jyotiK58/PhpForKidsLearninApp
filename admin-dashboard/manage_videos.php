<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "KidsLearningApp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch videos
$sql = "SELECT * FROM VideoDetail";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Videos</title>
</head>
<body>
    <h1>Manage Videos</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Video URL</th>
            <th>Title</th>
            <th>Image URL</th>
            <th>Category ID</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td><a href='{$row['video_url']}' target='_blank'>Watch</a></td>
                        <td>{$row['title']}</td>
                        <td><img src='{$row['image_url']}' width='100' /></td>
                        <td>{$row['category_id']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No videos found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
