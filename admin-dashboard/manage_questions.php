<?php
require("../connection.php");


// Initialize message variables
$message = "";

// Fetch questions
$sql = "SELECT * FROM QuizQuestions";
$result = $conn->query($sql);

// Handle deletion
if (isset($_GET['delete'])) {
    $id_to_delete = $_GET['delete'];
    $delete_sql = "DELETE FROM QuizQuestions WHERE id=?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $id_to_delete);
    $stmt->execute();
    $stmt->close();
    header("Location: manage_questions.php");
    exit;
}

// Handle insertion of a new question
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_question'])) {
    $question_text = $_POST['question_text'];
    $category_id = $_POST['category_id'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO QuizQuestions (question_text, category_id) VALUES (?, ?)");
    $stmt->bind_param("si", $question_text, $category_id);

    if ($stmt->execute()) {
        $message = "Question added successfully!";
    } else {
        $message = "Error adding question: " . $stmt->error;
    }

    $stmt->close();
    header("Location: manage_questions.php?message=" . urlencode($message));
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manage Questions</title>
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
            <h1>Manage Questions</h1>
            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addQuestionModal">Add New
                Question</button>

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
                        <th>Question Text</th>
                        <th>Category ID</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['id']}</td>
                                <td>" . htmlspecialchars($row['question_text']) . "</td>
                                <td>{$row['category_id']}</td>
                                <td>
                                    <a href='edit_question.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='manage_questions.php?delete={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this question?\");'>Delete</a>
                                </td>
                              </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No questions found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Question Modal -->
    <div class="modal fade" id="addQuestionModal" tabindex="-1" role="dialog" aria-labelledby="addQuestionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addQuestionModalLabel">Add New Question</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="manage_questions.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="question_text">Question Text</label>
                            <input type="text" class="form-control" id="question_text" name="question_text" required>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category ID</label>
                            <input type="number" class="form-control" id="category_id" name="category_id" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="add_question" class="btn btn-primary">Add Question</button>
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