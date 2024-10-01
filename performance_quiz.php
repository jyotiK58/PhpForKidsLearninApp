<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kidslearningapp";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

// Get user ID from query parameter
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

if ($user_id > 0) {
    // Fetch quiz results for a particular user across all categories
    $query = "SELECT uq.user_id, uq.correct_answers_count, uq.wrong_answers_count, qc.type AS category_name 
              FROM user_quiz_category uq
              JOIN LearningCategory qc ON uq.category_id = qc.id
              WHERE uq.user_id = $user_id";
} else {
    echo json_encode(['error' => 'Invalid user ID']);
    exit;
}

try {
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $data = [];

        // Fetch each quiz result and category information
        while ($row = $result->fetch_assoc()) {
            $data[] = [
                'user_id' => $row['user_id'],
                'correct_answers_count' => $row['correct_answers_count'],
                'wrong_answers_count' => $row['wrong_answers_count'],
                'category_name' => $row['category_name']
            ];
        }

        // Return data as JSON
        echo json_encode($data);
    } else {
        echo json_encode(['message' => 'No quiz results found for this user']);
    }
} catch (Exception $e) {
    echo json_encode(['error' => 'Caught exception: ' . $e->getMessage(), 'query' => $query]);
} finally {
    $conn->close();
}
?>
