<?php
require("../connection.php");


// Get category details by ID
$id = $_GET['id'];
$sql = "SELECT * FROM LearningCategory WHERE id='$id'";
$result = $conn->query($sql);
$category = $result->fetch_assoc();

// Handle category update
if (isset($_POST['update_category'])) {
    $type = $_POST['type'];
    $image_url = $_POST['image_url'];

    $sql = "UPDATE LearningCategory SET type='$type', image_url='$image_url' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        $message = "Category updated successfully!";
    } else {
        $message = "Error updating category: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Category</title>
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
            <h1>Edit Category</h1>

            <!-- Show success or failure message -->
            <?php if (isset($message)) { ?>
                <div class="alert alert-info"><?php echo $message; ?></div>
            <?php } ?>

            <form method="POST">
                <div class="form-group">
                    <label for="type">Category Type</label>
                    <input type="text" class="form-control" name="type" value="<?php echo $category['type']; ?>"
                        required>
                </div>
                <div class="form-group">
                    <label for="image_url">Image URL</label>
                    <input type="text" class="form-control" name="image_url"
                        value="<?php echo $category['image_url']; ?>" required>
                </div>
                <button type="submit" name="update_category" class="btn btn-primary">Update Category</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>