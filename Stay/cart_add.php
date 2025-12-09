<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login2.php");
    exit();
}

$user_id = $_SESSION['id'];
$content_code = $_POST['content_code'] ?? null;
$room_name = $_POST['room_name'] ?? null;
$thumbnail = $_POST['thumbnail'] ?? null;
$total_payment = $_POST['total_payment'] ?? null;
$nights = $_POST['nights'] ?? null;

if (!$content_code || !$room_name || !$thumbnail || !$total_payment || !$nights) {
    die("모든 입력 필드가 필요합니다.");
}

$conn = new mysqli("localhost", "root", "", "stay");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO cart (user_id, content_code, nights, total_price, room_name, thumbnail) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssisss", $user_id, $content_code, $nights, $total_payment, $room_name, $thumbnail);

if ($stmt->execute()) {
    echo "<script>alert('장바구니에 추가되었습니다!'); window.location.href='cart.php';</script>";
} else {
    echo "<p>오류 발생: " . $stmt->error . "</p>";
}

$stmt->close();
$conn->close();
?>
