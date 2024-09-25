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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $_POST['type'];
    $image_url = $_POST['image_url'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO LearningCategory (type, image_url) VALUES (?, ?)");
    $stmt->bind_param("ss", $type, $image_url);

    if ($stmt->execute()) {
        echo "<script>alert('Category added successfully!'); window.location.href='manage_categories.php';</script>";
    } else {
        echo "<script>alert('Error adding category: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Add New Category</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="type">Category Type</label>
                <input type="text" class="form-control" id="type" name="type" required>
            </div>
            <div class="form-group">
                <label for="image_url">Image URL</label>
                <input type="url" class="form-control" id="image_url" name="image_url" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Category</button>
            <a href="manage_categories.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
