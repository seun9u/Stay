<?php
// 세션 시작
session_start();

// 임시 비밀번호 확인
if (!isset($_SESSION['temp_password'])) {
    header("Location: forgot_password.php"); // 임시 비밀번호가 없으면 비밀번호 찾기 페이지로 리디렉션
    exit();
}

// 임시 비밀번호 가져오기
$temp_password = $_SESSION['temp_password'];

// 세션에서 임시 비밀번호 제거
unset($_SESSION['temp_password']);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STAY - 임시 비밀번호</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #0070C0;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            color: #333333;
            margin-bottom: 20px;
        }

        .temp-password {
            font-size: 18px;
            font-weight: bold;
            color: #28a745;
            margin-top: 15px;
        }

        .return-link {
            display: block;
            margin-top: 20px;
            font-size: 14px;
            color: #0070C0;
            text-decoration: none;
        }

        .return-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>임시 비밀번호</h1>
        <p>아래 임시 비밀번호를 사용하여 로그인하시고, 로그인 후 비밀번호를 변경해주세요.</p>
        <div class="temp-password">임시 비밀번호: <?php echo htmlspecialchars($temp_password); ?></div>
        <a href="index.php" class="return-link">홈으로 돌아가기</a>
    </div>
</body>
</html>
