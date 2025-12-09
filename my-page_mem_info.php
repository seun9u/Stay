<?php
// 세션 시작
session_start();

// 세션 확인
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// 데이터베이스 연결
$conn = new mysqli('localhost', 'root', '', 'stay');
if ($conn->connect_error) {
    die("데이터베이스 연결 실패: " . $conn->connect_error);
}

// 세션에서 사용자 ID 가져오기
$user_id = $_SESSION['id'];

// 사용자 데이터 가져오기
$stmt = $conn->prepare("SELECT id, name, phone, birth, email, sns_receive, email_receive FROM members WHERE id = ?");
if ($stmt === false) {
    die("쿼리 준비 실패: " . $conn->error);
}

$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
} else {
    // 데이터가 없을 경우 기본 값을 설정
    $user_data = [
        'id' => '',
        'name' => '',
        'phone' => '',
        'birth' => '',
        'email' => '',
        'sns_receive' => 'no',
        'email_receive' => 'no',
    ];
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/my-page.css">
    <title>회원 정보 수정</title>
    <style>
    /* 메뉴 스타일 */
    .menu_list {
        list-style: none; /* 기본 목록 스타일 제거 */
        padding: 0;
        margin: 0;
    }

    .menu_list a {
        text-decoration: none; /* 링크 밑줄 제거 */
        color: inherit; /* 부모 요소의 색상 상속 */
    }

    .menu_list a:hover {
        text-decoration: none; /* 호버 시에도 밑줄 제거 */
    }

    .nav.active a {
        font-weight: bold; /* 활성화된 메뉴는 굵게 표시 */
    }

    /* 회원정보 수정 칸 간격 */
    .form_group {
        margin-bottom: 30px; /* 항목 간의 간격 */
    }

    /* 버튼 컨테이너 스타일 */
    .button_container {
        margin-top: 30px;
        display: flex;
        justify-content: flex-start; /* 버튼들을 왼쪽 정렬 */
        gap: 10px; /* 버튼 간격 */
    }

    /* 버튼 스타일 */
    .button_submit {
        padding: 10px 20px;
        font-size: 14px;
        border: none;
        border-radius: 5px;
        background-color: #0070C0; /* 파란색 */
        color: white;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .button_submit:hover {
        background-color: #005a99; /* 어두운 파란색 */
    }

    .button_cancel {
        padding: 10px 20px;
        font-size: 14px;
        border: none;
        border-radius: 5px;
        background-color: #ccc; /* 회색 */
        color: black;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .button_cancel:hover {
        background-color: #999; /* 어두운 회색 */
    }
    </style>
</head>
<body>
    <div class="logo_wrapper"><a href="index.php">STAY</a></div>
    <main class="main_wrapper my-page member_info">
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
                <li class="nav">장바구니</li>
                <li class="nav">하트 목록</li>
                <li class="nav">
                    <a href="customer.php">고객센터</a>
            </li>
                <li class="nav">
                    <a href="my-page_delete_account.php">회원탈퇴</a>
                </li>
            </ul>
        </section>
        <section class="view">
            <div class="member_pwd_title">회원 정보 수정</div>
            <form method="POST" action="member_update.php">
                <div class="form_group">
                    <label>아이디:</label>
                    <input type="text" name="id" class="input_text" value="<?php echo htmlspecialchars($user_data['id']); ?>" readonly>
                </div>
                <div class="form_group">
                    <label>이름:</label>
                    <input type="text" name="name" class="input_text" value="<?php echo htmlspecialchars($user_data['name']); ?>">
                </div>
                <div class="form_group">
                    <label>휴대전화:</label>
                    <input type="text" name="phone" class="input_text" value="<?php echo htmlspecialchars($user_data['phone']); ?>">
                </div>
                <div class="form_group">
                    <label>생년월일:</label>
                    <input type="text" name="birth" class="input_text" value="<?php echo htmlspecialchars($user_data['birth']); ?>">
                </div>
                <div class="form_group">
                    <label>이메일:</label>
                    <input type="text" name="email" class="input_text" value="<?php echo htmlspecialchars($user_data['email']); ?>">
                </div>
                <div class="form_group">
                    <label>SNS 수신 여부:</label>
                    <div class="radio_group">
                        <label>
                            <input type="radio" name="sns" value="yes" <?php echo isset($user_data['sns_receive']) && $user_data['sns_receive'] === 'yes' ? 'checked' : ''; ?>> 예
                        </label>
                        <label>
                            <input type="radio" name="sns" value="no" <?php echo isset($user_data['sns_receive']) && $user_data['sns_receive'] === 'no' ? 'checked' : ''; ?>> 아니오
                        </label>
                    </div>
                </div>
                <div class="form_group">
                    <label>이메일 수신 여부:</label>
                    <div class="radio_group">
                        <label>
                            <input type="radio" name="email_receive" value="yes" <?php echo isset($user_data['email_receive']) && $user_data['email_receive'] === 'yes' ? 'checked' : ''; ?>> 예
                        </label>
                        <label>
                            <input type="radio" name="email_receive" value="no" <?php echo isset($user_data['email_receive']) && $user_data['email_receive'] === 'no' ? 'checked' : ''; ?>> 아니오
                        </label>
                    </div>
                </div>
                <!-- 새 비밀번호 -->
                <div class="form_group">
                    <label>새 비밀번호:</label>
                    <input type="password" name="new_password" class="input_text" required>
                </div>
                <div class="form_group">
                    <label>비밀번호 확인:</label>
                    <input type="password" name="confirm_password" class="input_text" required>
                </div>
                <div class="button_container">
                    <button type="submit" class="button_submit">수정 완료</button>
                    <button type="button" class="button_cancel" onclick="location.href='my-page_member_pwd.php'">취소</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
