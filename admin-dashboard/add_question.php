<?php
require("../connection.php");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question_text = $_POST['question_text'];
    $category_id = $_POST['category_id'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO QuizQuestions (question_text, category_id) VALUES (?, ?)");
    $stmt->bind_param("si", $question_text, $category_id);

    if ($stmt->execute()) {
        echo "<script>alert('Question added successfully!'); window.location.href='manage_questions.php';</script>";
    } else {
        echo "<script>alert('Error adding question: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Question</title>
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
            <h1>Add New Question</h1>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="question_text">Question Text</label>
                    <input type="text" class="form-control" id="question_text" name="question_text" required>
                </div>
                <div class="form-group">
                    <label for="category_id">Category ID</label>
                    <input type="number" class="form-control" id="category_id" name="category_id" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Question</button>
                <a href="manage_questions.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>