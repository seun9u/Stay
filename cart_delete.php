<?php
session_start();

// 로그인 여부 확인
if (!isset($_SESSION['id'])) {
    echo json_encode(['status' => 'error', 'message' => '로그인이 필요합니다.']);
    exit();
}

$user_id = $_SESSION['id'];
$item_id = intval($_POST['id'] ?? 0); // POST 메서드로 ID를 받고 정수로 변환

// ID 검증
if (!$item_id) {
    echo json_encode(['status' => 'error', 'message' => '잘못된 요청입니다.']);
    exit();
}

// 데이터베이스 연결
$conn = new mysqli("localhost", "root", "", "stay");

// 연결 확인
if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'DB 연결 실패: ' . $conn->connect_error]);
    exit();
}

// 장바구니 항목 삭제 쿼리
$stmt = $conn->prepare("DELETE FROM cart WHERE id = ? AND user_id = ?");
$stmt->bind_param("is", $item_id, $user_id);

// 쿼리 실행 및 결과 확인
if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => '장바구니 항목이 삭제되었습니다.']);
} else {
    echo json_encode(['status' => 'error', 'message' => '삭제 중 오류가 발생했습니다: ' . $stmt->error]);
}

// 리소스 정리
$stmt->close();
$conn->close();
?>
