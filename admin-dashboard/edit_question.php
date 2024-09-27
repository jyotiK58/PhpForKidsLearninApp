<?php
require("../connection.php");


// Initialize variables
$question_text = "";
$category_id = "";
$message = "";

// Fetch the question to edit
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT question_text, category_id FROM QuizQuestions WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($question_text, $category_id);
    $stmt->fetch();
    $stmt->close();
}

// Handle the update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question_text = $_POST['question_text'];
    $category_id = $_POST['category_id'];

    $stmt = $conn->prepare("UPDATE QuizQuestions SET question_text=?, category_id=? WHERE id=?");
    $stmt->bind_param("ssi", $question_text, $category_id, $id);

    if ($stmt->execute()) {
        $message = "Question updated successfully!";
    } else {
        $message = "Error updating question: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Question</title>
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
            <h1>Edit Question</h1>

            <!-- Display message -->
            <?php if ($message): ?>
                <div class="alert alert-info">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <form action="edit_question.php?id=<?php echo $id; ?>" method="POST">
                <div class="form-group">
                    <label for="question_text">Question Text</label>
                    <input type="text" class="form-control" id="question_text" name="question_text"
                        value="<?php echo htmlspecialchars($question_text); ?>" required>
                </div>
                <div class="form-group">
                    <label for="category_id">Category ID</label>
                    <input type="number" class="form-control" id="category_id" name="category_id"
                        value="<?php echo htmlspecialchars($category_id); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Question</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>