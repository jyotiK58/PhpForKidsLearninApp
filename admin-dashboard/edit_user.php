<?php
session_start();
require("../connection.php");


// Get user ID from URL
$id = $_GET['id'];

// Fetch user details
$sql = "SELECT * FROM users WHERE id='$id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

// Handle user update
if (isset($_POST['update_user'])) {
    // Sanitize and validate inputs
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $phone_number = trim($_POST['phone_number']);
    $address = trim($_POST['address']);
    $username = trim($_POST['username']);

    // Update query
    $sql = "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email', 
            phone_number='$phone_number', address='$address', username='$username' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        $update_message = "User updated successfully!";
        header("Location: manage_users.php");
        exit;
    } else {
        $update_message = "Error updating user: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit User</title>
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
            <h2>Edit User</h2>

            <?php if (isset($update_message)) { ?>
                <div class="alert alert-info"><?php echo $update_message; ?></div>
            <?php } ?>

            <form method="POST">
                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" class="form-control" name="firstname" value="<?php echo $user['firstname']; ?>"
                        required>
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" class="form-control" name="lastname" value="<?php echo $user['lastname']; ?>"
                        required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>"
                        required>
                </div>
                <div class="form-group">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control" name="phone_number"
                        value="<?php echo $user['phone_number']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" value="<?php echo $user['address']; ?>"
                        required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" value="<?php echo $user['username']; ?>"
                        required>
                </div>
                <button type="submit" name="update_user" class="btn btn-primary">Update User</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>