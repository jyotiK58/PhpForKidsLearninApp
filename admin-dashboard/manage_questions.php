<?php
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

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Questions</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Manage Questions</h1>
        <a href="add_question.php" class="btn btn-primary mb-3">Add New Question</a>
        <table class="table table-bordered">
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
                                <td>{$row['question_text']}</td>
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

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
