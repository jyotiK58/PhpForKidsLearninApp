<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("location: login.php");
    exit;
}

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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .profile-menu {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }
        .profile-menu .dropdown-menu {
            right: 0;
            left: auto;
        }
        .dashboard-menu {
            list-style-type: none;
            padding: 0;
        }
        .dashboard-menu li {
            margin-bottom: 10px;
        }
        .dashboard-menu a {
            text-decoration: none;
            font-weight: bold;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-menu">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="profileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Profile
                </button>
                <div class="dropdown-menu" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="profile.php">Edit Profile</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
        <h1>Welcome to Admin Dashboard</h1>
        <ul class="dashboard-menu">
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="manage_categories.php">Manage Categories</a></li>
            <li><a href="manage_questions.php">Manage Questions</a></li>
            <li><a href="manage_videos.php">Manage Videos</a></li>
            <li><a href="view_performance.php">View Performance</a></li>
        </ul>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
