<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("location: login.php");
    exit;
}

require("../connection.php");


// Handle video deletion
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM VideoDetail WHERE id='$id'";
    $conn->query($sql);
}

// Handle adding a new video
if (isset($_POST['add_video'])) {
    $video_url = $_POST['video_url'];
    $title = $_POST['title'];
    $image_url = $_POST['image_url'];
    $category_id = $_POST['category_id'];

    $sql = "INSERT INTO VideoDetail (video_url, title, image_url, category_id) 
            VALUES ('$video_url', '$title', '$image_url', '$category_id')";
    if ($conn->query($sql) === TRUE) {
        $add_message = "Video added successfully!";
    } else {
        $add_message = "Error adding video: " . $conn->error;
    }
}

// Fetch videos
$sql = "SELECT * FROM VideoDetail";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Videos</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .content {
            margin-left: 260px;
            padding: 20px;
        }

        .table img {
            max-width: 100px;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .card {
            margin-top: 20px;
        }

        .no-data {
            text-align: center;
            font-size: 1.2em;
            color: #777;
        }
    </style>
</head>

<body>
    <!-- Include Topbar -->
    <?php include('topbar.php'); ?>

    <div class="d-flex">
        <!-- Include Sidebar -->
        <?php include('sidebar.php'); ?>

        <!-- Main Content Area -->
        <div class="container">
            <h2 class="mb-4">
                Manage Videos

            </h2>
            <div class="mb-3">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addVideoModal">
                    <i class="fas fa-plus"></i> Add Video
                </button>
            </div>

            <?php if (isset($add_message)) { ?>
                <div class="alert alert-info"><?php echo $add_message; ?></div>
            <?php } ?>

            <!-- Video Management Table inside a Bootstrap card -->
            <div class="card">
                <div class="card-header bg-info text-white">
                    <i class="fas fa-video"></i> Video List
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="tableid">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Video</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                            <td>{$row['id']}</td>
                                            <td><a href='{$row['video_url']}' target='_blank' class='btn btn-sm btn-primary'>Watch <i class='fas fa-play'></i></a></td>
                                            <td>{$row['title']}</td>
                                            <td><img src='{$row['image_url']}' alt='Video Image' class='img-fluid'></td>
                                            <td>{$row['category_id']}</td>
                                            <td>
                                                <form method='POST'>
                                                    <input type='hidden' name='id' value='{$row['id']}'>
                                                    <a href='edit_video.php?id={$row['id']}' class='btn btn-warning btn-sm'>
                                                        <i class='fas fa-edit'></i> Edit
                                                    </a>
                                                    <button type='submit' name='delete' class='btn btn-danger btn-sm'>
                                                        <i class='fas fa-trash'></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6' class='no-data'>No videos found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Add Video Modal -->
    <div class="modal fade" id="addVideoModal" tabindex="-1" role="dialog" aria-labelledby="addVideoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addVideoModalLabel">Add New Video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="video_url">Video URL</label>
                            <input type="text" class="form-control" name="video_url" required>
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="image_url">Image URL</label>
                            <input type="text" class="form-control" name="image_url" required>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category ID</label>
                            <input type="number" class="form-control" name="category_id" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="add_video" class="btn btn-primary">Add Video</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
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