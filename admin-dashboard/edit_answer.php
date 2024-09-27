<?php
require("../connection.php");


// Initialize variables
$question_id = "";
$answer_text = "";
$is_correct = 0;
$message = "";

// Fetch the answer to edit
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT question_id, answer_text, is_correct FROM QuizAnswer WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($question_id, $answer_text, $is_correct);
    $stmt->fetch();
    $stmt->close();
}

// Handle the update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question_id = $_POST['question_id'];
    $answer_text = $_POST['answer_text'];
    $is_correct = isset($_POST['is_correct']) ? 1 : 0;

    $stmt = $conn->prepare("UPDATE QuizAnswer SET question_id=?, answer_text=?, is_correct=? WHERE id=?");
    $stmt->bind_param("isii", $question_id, $answer_text, $is_correct, $id);

    if ($stmt->execute()) {
        $message = "Answer updated successfully!";
    } else {
        $message = "Error updating answer: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Answer</title>
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
            <h1>Edit Answer</h1>

            <!-- Display message -->
            <?php if ($message): ?>
                <div class="alert alert-info">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <form action="edit_answer.php?id=<?php echo $id; ?>" method="POST">
                <div class="form-group">
                    <label for="question_id">Question ID</label>
                    <input type="number" class="form-control" id="question_id" name="question_id"
                        value="<?php echo htmlspecialchars($question_id); ?>" required>
                </div>
                <div class="form-group">
                    <label for="answer_text">Answer Text</label>
                    <input type="text" class="form-control" id="answer_text" name="answer_text"
                        value="<?php echo htmlspecialchars($answer_text); ?>" required>
                </div>
                <div class="form-group">
                    <label for="is_correct">Is Correct?</label>
                    <input type="checkbox" id="is_correct" name="is_correct" <?php echo $is_correct ? 'checked' : ''; ?>>
                </div>
                <button type="submit" class="btn btn-primary">Update Answer</button>
                <a href="manage_answers.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>