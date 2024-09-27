<?php
require("../connection.php");


// Handle adding a new category
if (isset($_POST['add_category'])) {
    $type = $_POST['type'];
    $image_url = $_POST['image_url'];

    $sql = "INSERT INTO LearningCategory (type, image_url) VALUES ('$type', '$image_url')";
    if ($conn->query($sql) === TRUE) {
        $add_message = "Category added successfully!";
    } else {
        $add_message = "Error adding category: " . $conn->error;
    }
}

// Fetch categories
$sql = "SELECT * FROM LearningCategory";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manage Categories</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.min.css">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .action-buttons {
            display: flex;
            gap: 10px;
        }
    </style>
</head>

<body>
    <!-- Include Topbar -->
    <?php include('topbar.php'); ?>

    <div class="d-flex">
        <!-- Include Sidebar -->
        <?php include('sidebar.php'); ?>
        <div class="container">
            <h1>Manage Categories</h1>

            <!-- Add Category Button -->
            <div class="mb-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">
                    Add Category
                </button>
            </div>

            <!-- Add Category Modal -->
            <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog"
                aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="type">Category Type</label>
                                    <input type="text" class="form-control" name="type" required>
                                </div>
                                <div class="form-group">
                                    <label for="image_url">Image URL</label>
                                    <input type="text" class="form-control" name="image_url" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="add_category" class="btn btn-primary">Add Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Show success or failure message for adding category -->
            <?php if (isset($add_message)) { ?>
                <div class="alert alert-info"><?php echo $add_message; ?></div>
            <?php } ?>

            <!-- Category Table -->
            <table class="table table-bordered" id="tableid">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['type']}</td>
                                <td><img src='{$row['image_url']}' width='100' /></td>
                                <td>
                                    <div class='action-buttons'>
                                        <a href='edit_category.php?id={$row['id']}' class='btn btn-warning'>Edit</a>
                                        <a href='delete_category.php?id={$row['id']}' class='btn btn-danger'>Delete</a>
                                    </div>
                                </td>
                              </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No categories found</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#tableid').DataTable();
        });
    </script>
</body>

</html>