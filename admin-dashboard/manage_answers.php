<?php
require("../connection.php");


// Initialize message variables
$message = "";

// Fetch answers
$sql = "SELECT * FROM QuizAnswer";  // Changed from QuizAnswers to QuizAnswer
$result = $conn->query($sql);

// Handle deletion
if (isset($_GET['delete'])) {
    $id_to_delete = $_GET['delete'];
    $delete_sql = "DELETE FROM QuizAnswer WHERE id=?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $id_to_delete);
    $stmt->execute();
    $stmt->close();
    header("Location: manage_answers.php");
    exit;
}

// Handle insertion of a new answer
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_answer'])) {
    $question_id = $_POST['question_id'];
    $answer_text = $_POST['answer_text'];
    $is_correct = isset($_POST['is_correct']) ? 1 : 0;

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO QuizAnswer (question_id, answer_text, is_correct) VALUES (?, ?, ?)");
    $stmt->bind_param("isi", $question_id, $answer_text, $is_correct);

    if ($stmt->execute()) {
        $message = "Answer added successfully!";
    } else {
        $message = "Error adding answer: " . $stmt->error;
    }

    $stmt->close();
    header("Location: manage_answers.php?message=" . urlencode($message));
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manage Answers</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.min.css">
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
            <h1>Manage Answers</h1>
            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addAnswerModal">Add New
                Answer</button>

            <!-- Display message -->
            <?php if (isset($_GET['message'])): ?>
                <div class="alert alert-info">
                    <?php echo htmlspecialchars($_GET['message']); ?>
                </div>
            <?php endif; ?>

            <table class="table table-bordered" id="tableid">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Question ID</th>
                        <th>Answer Text</th>
                        <th>Is Correct</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['question_id']}</td>
                                <td>" . htmlspecialchars($row['answer_text']) . "</td>
                                <td>" . ($row['is_correct'] ? 'Yes' : 'No') . "</td>
                                <td>
                                    <a href='edit_answer.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='manage_answers.php?delete={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this answer?\");'>Delete</a>
                                </td>
                              </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No answers found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Answer Modal -->
    <div class="modal fade" id="addAnswerModal" tabindex="-1" role="dialog" aria-labelledby="addAnswerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAnswerModalLabel">Add New Answer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="manage_answers.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="question_id">Question ID</label>
                            <input type="number" class="form-control" id="question_id" name="question_id" required>
                        </div>
                        <div class="form-group">
                            <label for="answer_text">Answer Text</label>
                            <input type="text" class="form-control" id="answer_text" name="answer_text" required>
                        </div>
                        <div class="form-group">
                            <label for="is_correct">Is Correct?</label>
                            <input type="checkbox" id="is_correct" name="is_correct">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="add_answer" class="btn btn-primary">Add Answer</button>
                    </div>
                </form>
            </div>
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