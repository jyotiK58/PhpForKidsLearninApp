<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("location: login.php");
    exit;
}
require("../connection.php");


// Fetch admin information
$admin_username = $_SESSION['admin']; // Assuming the admin's username is stored in session
$sql = "SELECT * FROM admins WHERE username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $admin_username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $admin_data = $result->fetch_assoc();
} else {
    // Handle case where admin not found
    echo "Admin not found.";
    exit;
}

// Initialize message variable
$message = "";

// Handle profile update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = $_POST['username'];
    $new_password = $_POST['password']; // You might want to hash the password before storing it

    $update_sql = "UPDATE admins SET username=?, password=? WHERE username=?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sss", $new_username, $new_password, $admin_username);

    if ($update_stmt->execute()) {
        $message = "Profile updated successfully!";
        $_SESSION['admin'] = $new_username; // Update the session variable if username is changed
    } else {
        $message = "Error updating profile: " . $update_stmt->error;
    }

    $update_stmt->close();
    header("Location: profile.php?message=" . urlencode($message));
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Profile</title>
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
            <h1 class="mt-4">Edit Profile</h1>

            <?php if (isset($_GET['message'])): ?>
                <div class="alert alert-info">
                    <?php echo htmlspecialchars($_GET['message']); ?>
                </div>
            <?php endif; ?>

            <form action="profile.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username"
                        value="<?php echo htmlspecialchars($admin_data['username']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" id="password" name="password"
                        value="<?php echo htmlspecialchars($admin_data['password']); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>
    </div>
</body>

</html>