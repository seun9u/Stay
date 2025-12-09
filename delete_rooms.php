<?php
// 데이터베이스 연결
require_once(__DIR__ . "/inc/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 선택된 체크박스 값 가져오기
    $selected_items = $_POST['selected_items'] ?? [];

    if (!empty($selected_items)) {
        try {
            // PDO 객체 생성
            $pdo = db_get_pdo();

            // 삭제 쿼리 실행
            $placeholders = implode(',', array_fill(0, count($selected_items), '?'));
            $query = "DELETE FROM rooms WHERE room_code IN ($placeholders)";
            $stmt = $pdo->prepare($query);

            if ($stmt->execute($selected_items)) {
                echo "<script>alert('선택된 항목이 삭제되었습니다.'); window.location.href='manager_product.php';</script>";
            } else {
                echo "<script>alert('삭제 중 오류가 발생했습니다.'); window.location.href='manager_product.php';</script>";
            }
        } catch (PDOException $e) {
            die("데이터베이스 오류: " . $e->getMessage());
        }
    } else {
        echo "<script>alert('삭제할 항목을 선택하세요.'); window.location.href='manager_product.php';</script>";
    }
}
?>
