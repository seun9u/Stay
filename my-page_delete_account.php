<?php
// 세션 시작
session_start();

// 데이터베이스 파일 포함
require_once("inc/db.php");

// 오류 디스플레이 활성화
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 세션 ID 확인
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // 로그인 페이지로 리디렉션
    exit();
}

// 사용자 ID 가져오기
$user_id = $_SESSION['id'];

// POST 요청 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm_delete']) && $_POST['confirm_delete'] === 'yes') {
        // 회원 삭제 SQL 실행
        $query = "DELETE FROM members WHERE id = :id";
        $params = array(':id' => $user_id);

        // 데이터베이스 업데이트 시도
        try {
            $result = db_update_delete($query, $params);

            if ($result) {
                // 세션 종료 및 리디렉션
                session_unset();
                session_destroy();
                header("Location: goodbye.php");
                exit();
            } else {
                echo "회원 탈퇴 중 문제가 발생했습니다.";
            }
        } catch (Exception $e) {
            echo "오류 발생: " . $e->getMessage();
        }
    } else {
        header("Location: my-page_member_pwd.php"); // 취소 버튼 클릭 시
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원탈퇴</title>
    <link rel="stylesheet" href="css/deleteAccount.css">
</head>
<body>
    <div class="container">
        <h1>회원탈퇴</h1>
        <p class="warning">정말로 회원탈퇴를 하시겠습니까? <br>이 작업은 되돌릴 수 없습니다.</p>
        <form method="POST" action="my-page_delete_account.php">
            <div class="btn-group">
                <button type="submit" name="confirm_delete" value="yes" class="btn-delete">회원탈퇴</button>
                <a href="my-page_member_pwd.php" class="btn-cancel">취소</a>
            </div>
        </form>
    </div>
</body>
</html>
