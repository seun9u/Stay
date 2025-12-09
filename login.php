<?php
session_start(); // 세션 시작

// 로그인 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $pass = $_POST['pass'];

    // 예제 인증 (실제 환경에서는 데이터베이스에서 사용자 정보를 확인해야 합니다)
    if ($id === 'kang' && $pass === '1234') {
        $_SESSION['id'] = $id; // 세션에 사용자 이메일 저장
        header('Location: index.php'); // 로그인 성공 시 메인 페이지로 리다이렉트
        exit();
    } else {
        echo "<p style='color: red;'>이메일 또는 비밀번호가 잘못되었습니다.</p>";
    }
}
?>


<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STAY - 로그인 시작</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #ffffff;
        }

        /* STAY 상단 제목 스타일 */
        .header {
            background-color: #f9f9f9; /* 상단 배경색 */
            padding: 20px 0;
            border-bottom: 1px solid #dddddd; /* 아래쪽 경계선 */
        }

        .header a {
            text-decoration: none; /* 링크 밑줄 제거 */
        }

        .header h1 {
            font-size: 24px;
            color: #0070C0; /* STAY 텍스트 색상 */
            margin: 0;
            cursor: pointer;
        }

        /* 로그인 컨테이너 */
        .login-container {
            margin: 50px auto;
            width: 80%; /* 가로 길이를 줄임 */
            max-width: 400px; /* 최대 가로 길이 */
            padding: 20px;
            border: 1px solid #cccccc; /* 윤곽선 */
            border-radius: 10px; /* 모서리를 약간 둥글게 */
        }

        .login-title {
            font-size: 16px;
            margin-bottom: 30px;
            color: #555555;
        }

        /* 소셜 로그인 버튼 */
        .social-button {
            width: 100%; /* 버튼이 박스 너비에 맞도록 설정 */
            margin: 15px 0; /* 버튼 간의 간격을 넓힘 */
            padding: 15px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px; /* 모서리를 둥글게 */
            border: none;
            cursor: pointer;
            display: flex;
            justify-content: center; /* 텍스트 중앙 정렬 */
            align-items: center; /* 텍스트 수직 중앙 정렬 */
            transition: background-color 0.3s ease, border-color 0.3s ease;
            position: relative; /* 아이콘 위치 조정 가능 */
        }

        .social-button img {
            position: absolute; /* 아이콘을 버튼 왼쪽에 배치 */
            left: 20px;
            width: 24px;
            height: 24px;
        }

        .kakao { background-color: #FFEB00; color: #3C1E1E; }
        .naver { background-color: #00D070; color: white; }
        .apple { background-color: #000000; color: white; }
        .facebook { background-color: #3A559F; color: white; }
        .google {
            background-color: #ffffff;
            color: #333333;
            border: 1px solid #dddddd; /* 테두리 색상 */
        }
        .google:hover {
            background-color: #f5f5f5; /* 호버 시 배경색 */
            border-color: #cccccc; /* 호버 시 테두리 색상 */
        }

        .email { background-color: #0070C0; color: white; margin-top: 20px; }
        .email:hover { background-color: #005a99; }

        /* 비즈니스 로그인/회원가입 */
        .business-login {
            margin-top: 20px;
            font-size: 14px;
            color: #888888;
            text-decoration: none;
        }

        .business-login:hover { color: #0070C0; }
    </style>
</head>
<body>
    <!-- STAY 상단 제목 -->
    <div class="header">
        <a href="index.php"> <!-- 로고 클릭 시 메인 페이지로 이동 -->
            <h1>STAY</h1>
        </a>
    </div>

    <!-- 로그인 컨테이너 -->
    <div class="login-container">
        <div class="login-title">로그인/회원가입</div>
        <!-- 소셜 로그인 버튼 -->
        <form action="social_login.php" method="post">
            <button class="social-button kakao" type="submit" name="provider" value="kakao">
                <img src="icons/kakao.png" alt="카카오 로고"> 카카오로 시작하기
            </button>
            <button class="social-button naver" type="submit" name="provider" value="naver">
                <img src="icons/naver.png" alt="네이버 로고"> 네이버로 시작하기
            </button>
            <button class="social-button apple" type="submit" name="provider" value="apple">
                <img src="icons/apple.png" alt="애플 로고"> Apple로 시작하기
            </button>
            <button class="social-button facebook" type="submit" name="provider" value="facebook">
                <img src="icons/facebook.png" alt="페이스북 로고"> 페이스북으로 시작하기
            </button>
            <button class="social-button google" type="submit" name="provider" value="google">
                <img src="icons/google.png" alt="구글 로고"> 구글로 시작하기
            </button>
        </form>

        <!-- 이메일 로그인 -->
        <button class="social-button email" onclick="location.href='login2.php'">
             이메일로 시작하기
        </button>
    </div>
</body>
</html>
