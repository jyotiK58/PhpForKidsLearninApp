<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("location: login.php");
    exit;
}

require("../connection.php");

// Get video details
$id = $_GET['id'];
$sql = "SELECT * FROM VideoDetail WHERE id='$id'";
$result = $conn->query($sql);
$video = $result->fetch_assoc();

// Handle video update
if (isset($_POST['update_video'])) {
    $video_url = $_POST['video_url'];
    $title = $_POST['title'];
    $image_url = $_POST['image_url'];
    $category_id = $_POST['category_id'];

    $sql = "UPDATE VideoDetail SET video_url='$video_url', title='$title', image_url='$image_url', category_id='$category_id' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        $message = "Video updated successfully!";
    } else {
        $message = "Error updating video: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Video</title>
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <!-- Include Topbar -->
    <?php include('topbar.php'); ?>

    <div class="d-flex">
        <!-- Include Sidebar -->
        <?php include('sidebar.php'); ?>
        <div class="container">
            <h1>Edit Video</h1>

            <?php if (isset($message)) { ?>
                <div class="alert alert-info"><?php echo $message; ?></div>
            <?php } ?>

            <form method="POST">
                <div class="form-group">
                    <label for="video_url">Video URL</label>
                    <input type="text" class="form-control" name="video_url" value="<?php echo $video['video_url']; ?>"
                        required>
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" value="<?php echo $video['title']; ?>"
                        required>
                </div>
                <div class="form-group">
                    <label for="image_url">Image URL</label>
                    <input type="text" class="form-control" name="image_url" value="<?php echo $video['image_url']; ?>"
                        required>
                </div>
                <div class="form-group">
                    <label for="category_id">Category ID</label>
                    <input type="number" class="form-control" name="category_id"
                        value="<?php echo $video['category_id']; ?>" required>
                </div>
                <button type="submit" name="update_video" class="btn btn-primary">Update Video</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>