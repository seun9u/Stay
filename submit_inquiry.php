<?php
include_once 'inc/db.php';

$pdo = db_get_pdo();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 폼에서 입력된 값 가져오기
    $userid = $_POST['inquiry_id'] ?? '익명';
    $inquiry_password = $_POST['inquiry_password'] ?? '';
    $inquiry_type = $_POST['inquiry_type'] ?? '';
    $inquiry_title = $_POST['inquiry_title'] ?? '';
    $inquiry_content = $_POST['inquiry_content'] ?? '';

    // 비밀번호 해시화
    $hashed_password = password_hash($inquiry_password, PASSWORD_DEFAULT);

    try {
        // SQL 쿼리 작성 및 실행
        $sql = "INSERT INTO onetoone (userid, inquiry_title, inquiry_type, content, password, created_at) 
                VALUES (:userid, :inquiry_title, :inquiry_type, :content, :password, NOW())";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':userid', $userid);
        $stmt->bindParam(':inquiry_title', $inquiry_title);
        $stmt->bindParam(':inquiry_type', $inquiry_type);
        $stmt->bindParam(':content', $inquiry_content);
        $stmt->bindParam(':password', $hashed_password);

        // 실행 및 확인
        if ($stmt->execute()) {
            echo "<script>alert('문의가 성공적으로 등록되었습니다.'); window.location.href = 'onetoone.php';</script>";
        } else {
            echo "문의 등록 실패: ";
            print_r($stmt->errorInfo());
        }
    } catch (PDOException $e) {
        echo "데이터 저장 중 오류 발생: " . $e->getMessage();
    }
}
?>
