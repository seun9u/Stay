<?php
session_start();

// 로그인 여부 확인
if (!isset($_SESSION['id'])) {
    echo "<script>alert('로그인이 필요합니다.'); window.location.href='login.php';</script>";
    exit();
}

$logged_in_id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1:1 문의</title>
    <link rel="stylesheet" href="css/ctc.css">
</head>
<body>
    <style>
        .form-group#id {
            margin-bottom: 30px;
        }
        .form-group#inquiry-type {
            margin-bottom: 30px;
        }
        .form-group#password {
            margin-bottom: 30px;
        }
    </style>

    <div class="container">
        <div class="header">1:1 문의</div>
        <form action="submit_inquiry.php" method="post">
            <div class="form-group" id="id">
                <label for="inquiry_id">아이디</label>
                <input type="text" name="inquiry_id" id="inquiry_id" value="<?php echo htmlspecialchars($logged_in_id); ?>" placeholder="아이디를 입력하세요" readonly required>
            </div>
            
            <div class="form-group" id="password">
                <label for="inquiry_password">비밀번호</label>
                <input type="password" name="inquiry_password" id="inquiry_password" placeholder="비밀번호를 입력하세요" required>
            </div>

            <div class="form-group" id="inquiry-type">
                <label for="inquiry_type">문의 유형</label>
                <select name="inquiry_type" id="inquiry_type" required>
                    <option value="" disabled selected>문의 유형 선택</option>
                    <option value="숙소">숙소</option>
                    <option value="회원">회원</option>
                    <option value="쿠폰">쿠폰</option>
                    <option value="결제/영수증">결제/영수증</option>
                </select>
            </div>

            <div class="form-group">
                <label for="inquiry_title">문의 제목</label>
                <input type="text" name="inquiry_title" id="inquiry_title" placeholder="제목을 입력하세요" required>
            </div>

            <div class="form-group">
                <label for="inquiry_content">문의 내용</label>
                <textarea name="inquiry_content" id="inquiry_content" placeholder="문의 내용을 입력하세요" required></textarea>
            </div>

            <div class="form-action">
                <button type="submit" class="btn-submit">문의 하기</button>
                <button type="button" class="btn-cancel" onclick="location.href='customer.php'">취소 하기</button>
            </div>
        </form>
    </div>
</body>
</html>
