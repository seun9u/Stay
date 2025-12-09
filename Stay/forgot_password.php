<?php
// 세션 시작
session_start();

// 데이터베이스 파일 포함
require_once("inc/db.php");

// 오류 디스플레이 활성화
error_reporting(E_ALL);
ini_set('display_errors', 1);

// POST 요청 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $email = $_POST['email'];

    // 입력값 검증
    if (empty($id) || empty($email)) {
        $error_message = "ID와 이메일을 모두 입력해주세요.";
    } else {
        // 데이터베이스에서 ID와 이메일 확인
        $query = "SELECT id FROM members WHERE id = :id AND email = :email";
        $params = array(':id' => $id, ':email' => $email);
        $result = db_select($query, $params);

        if ($result) {
            // 임시 비밀번호 생성
            $temp_password = bin2hex(random_bytes(4)); // 8자리 임시 비밀번호
            $hashed_password = password_hash($temp_password, PASSWORD_DEFAULT);

            // 비밀번호 업데이트
            $update_query = "UPDATE members SET pass = :password WHERE id = :id AND email = :email";
            $update_params = array(':password' => $hashed_password, ':id' => $id, ':email' => $email);
            $update_result = db_update_delete($update_query, $update_params);

            if ($update_result) {
                // 임시 비밀번호를 세션에 저장하고 새 페이지로 이동
                $_SESSION['temp_password'] = $temp_password;
                header("Location: temp_password.php");
                exit();
            } else {
                $error_message = "비밀번호를 업데이트하는 중 문제가 발생했습니다.";
            }
        } else {
            $error_message = "입력하신 ID와 이메일이 일치하지 않습니다.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STAY - 비밀번호 찾기</title>
    <link rel="stylesheet" href="css/forgotPassword.css">
</head>
<body>
    <div class="container">
        <h1>비밀번호 찾기</h1>
        <p>등록된 이메일로 임시 비밀번호를 재설정합니다.</p>
        
        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="text" name="id" class="input-field" placeholder="아이디를 입력하세요." required>
            <input type="email" name="email" class="input-field" placeholder="이메일을 입력하세요." required>
            <button type="submit" class="submit-button">비밀번호 찾기</button>
        </form>

        <a href="index.php" class="return-link">홈으로 돌아가기</a>
    </div>
</body>
</html>
