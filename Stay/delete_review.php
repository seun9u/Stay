<?php
$host = 'localhost';
$user = 'root';
$password = ''; // MySQL 비밀번호
$dbname = 'stay'; // 데이터베이스 이름

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("DB 연결 실패: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['review_id'])) {
    $review_id = $_POST['review_id'];

    $stmt = $conn->prepare("DELETE FROM review WHERE review_id = ?");
    $stmt->bind_param("i", $review_id);

    if ($stmt->execute()) {
        header("Location: reviews.php");
        exit();
    } else {
        echo "리뷰 삭제 실패: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
