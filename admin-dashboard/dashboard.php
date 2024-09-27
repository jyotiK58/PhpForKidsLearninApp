<?php


// Database connection
require("../connection.php");

// Fetch total categories
$categoryQuery = "SELECT COUNT(*) AS total_categories FROM learningcategory";
$categoryResult = $conn->query($categoryQuery);
$totalCategories = $categoryResult->fetch_assoc()['total_categories'];

// Fetch total users
$userQuery = "SELECT COUNT(*) AS total_users FROM users";
$userResult = $conn->query($userQuery);
$totalUsers = $userResult->fetch_assoc()['total_users'];

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .content {
            margin-left: 260px;
            padding: 20px;
        }

        .card {
            margin-bottom: 20px;
        }

        .card-icon {
            font-size: 40px;
            color: white;
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
            <h1>Welcome to Admin Dashboard</h1>
            <p>Select an option from the sidebar to manage content.</p>

            <!-- Cards for Total Categories and Users -->
            <div class="row">
                <!-- Card for Total Categories -->
                <div class="col-md-4">
                    <div class="card text-white bg-info">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="card-title">Total Categories</h5>
                                    <p class="card-text display-4"><?php echo $totalCategories; ?></p>
                                </div>
                                <div>
                                    <i class="fas fa-list-alt card-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card for Total Users -->
                <div class="col-md-4">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="card-title">Total Users</h5>
                                    <p class="card-text display-4"><?php echo $totalUsers; ?></p>
                                </div>
                                <div>
                                    <i class="fas fa-users card-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>