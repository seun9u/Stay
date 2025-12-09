<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STAY - ID 로그인</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f9f9f9;
        }

        .header {
            background-color: #f9f9f9;
            padding: 20px 0;
            border-bottom: 1px solid #ddd;
        }

        .header a {
            text-decoration: none;
        }

        .header h1 {
            font-size: 24px;
            color: #0070C0;
            margin: 0;
            cursor: pointer;
        }

        .login-container {
            width: 80%;
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .login-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        .login-input {
            width: calc(100% - 30px); /* 버튼과 동일한 너비 */
            margin-bottom: 15px;
            padding: 15px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; /* 패딩 포함하여 너비 계산 */
        }

        .login-button {
            width: calc(100% - 30px); /* 입력 필드와 동일한 너비 */
            padding: 15px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            background-color: #0070C0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            box-sizing: border-box; /* 패딩 포함하여 너비 계산 */
        }

        .login-button:hover { background-color: #005a99; }

        .link-wrapper {
            margin-top: 20px;
            font-size: 14px;
            display: flex;
            justify-content: space-between;
        }

        .link-wrapper a {
            color: #0070C0;
            text-decoration: none;
        }

        .link-wrapper a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- 상단 로고 -->
    <div class="header">
        <a href="index.php">
            <h1>STAY</h1>
        </a>
    </div>

    <!-- 로그인 폼 -->
    <div class="login-container">
        <div class="login-title">로그인</div>
        <form action="login.post.php" method="POST">
            <input type="text" name="id" class="login-input" placeholder="아이디를 입력하세요." required>
            <input type="password" name="password" class="login-input" placeholder="비밀번호를 입력하세요." required>
            <button type="submit" class="login-button">로그인</button>
        </form>
        <!-- 회원가입 및 비밀번호 찾기 링크 -->
        <div class="link-wrapper">
            <a href="sign_up.php">회원가입</a>
            <a href="forgot_password.php">비밀번호 찾기</a>
        </div>
    </div>
</body>
</html>
