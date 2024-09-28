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

try {
    $query = "SELECT user_id, correct_answers_count, wrong_answers_count FROM user_quiz_category";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $data = [];

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        echo json_encode($data);
    } else {
        echo json_encode([]);
    }
} catch (Exception $e) {
    echo json_encode(['error' => 'Caught exception: ' . $e->getMessage()]);
} finally {
    $conn->close();
}
?>
