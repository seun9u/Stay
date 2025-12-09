<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/my-page.css">
    <title>비밀번호 확인</title>
    <style>
        /* 비밀번호 입력 칸과 버튼 나란히 배치 */
        .form_group {
            display: flex;
            align-items: center;
            gap: 10px; /* 입력 칸과 버튼 간격 */
        }

        .form_group label {
            font-size: 16px;
            font-weight: bold;
        }

        .form_group input[type="password"] {
            flex: 1; /* 입력 필드 확장 */
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .button_join {
            padding: 8px 16px;
            font-size: 14px;
            background-color: #0070C0;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button_join:hover {
            background-color: #005a99;
        }

        /* 링크 기본 스타일 제거 */
        .menu_list a {
            text-decoration: none; /* 밑줄 제거 */
            color: inherit; /* 텍스트 색상을 부모 요소와 동일하게 설정 */
        }

        /* 활성화된 메뉴 스타일 */
        .nav.active {
            font-weight: bold;
        }

        /* 링크 호버 스타일 */
        .menu_list a:hover {
            text-decoration: none; /* 호버 시에도 밑줄 제거 */
            color: #0070C0; /* 텍스트 색상 강조 */
        }
    </style>
    <script>
        // 비밀번호 검증 함수
        function checkPassword(event) {
            var password = document.getElementsByName('pass_member')[0].value;

            // 비밀번호가 비어있는지 확인
            if (password === "") {
                alert("비밀번호를 입력해주세요.");
                event.preventDefault(); // 폼 제출을 막음
                return false;
            }

            return true; // 비밀번호가 올바르면 폼 제출
        }
    </script>
</head>

<body>
    <!-- 상단 중앙 STAY -->
    <div class="logo_wrapper">
        <a href="index.php">STAY</a>
    </div>

    <main class="main_wrapper my-page member_info">
        <!-- 좌측 메뉴 -->
        <section class="menus">
            <div class="my-page_title">MY PAGE</div>
            <ul class="menu_list">
                <a href="my-page_member_pwd.php">
                    <li class="nav active">회원정보 수정</li>
                </a>
                <a href="reservation_lookup.php">
                    <li class="nav">예약 내역</li>
                </a>
                <li class="nav">리뷰 내역</li>
                <a href="cart.php">
                    <li class="nav">장바구니</li>
                </a>
                <li class="nav">하트 목록</li>
                <li class="nav">
                    <a href="customer.php">고객센터</a>
            </li>
                <li class="nav">
                    <a href="my-page_delete_account.php">회원탈퇴</a>
                </li>
            </ul>
        </section>

        <!-- 우측 콘텐츠 -->
        <section class="view">
            <div class="member_pwd_title">비밀번호 확인</div>
            <div class="join_box">
                <!-- 비밀번호 입력 폼 -->
                <form name="password_form" method="POST" action="verify_password.php" onsubmit="return checkPassword(event)">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($_SESSION['id']); ?>">
                    <div class="form_group">
                        <label for="pass_member">비밀번호 입력</label>
                        <input type="password" id="pass_member" name="pass_member" required>
                        <button type="submit" class="button_join">확인</button>
                    </div>
                    <!-- 오류 메시지 표시 -->
                    <?php if (!empty($error_message)): ?>
                        <div class="error_message" style="color: red; font-weight: bold; margin-top: 10px;">
                            <?php echo $error_message; ?>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </section>
    </main>
</body>

</html>
