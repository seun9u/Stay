<?php
// 로그인 처리 코드
session_start();

// 세션에서 로그인된 사용자 ID 가져오기
$member_id = isset($_SESSION['member_id']) ? $_SESSION['member_id'] : null;

// 세션에서 총 수량과 총 결제 금액 가져오기
$totalQuantity = $_SESSION['total_quantity'] ?? 0;
$totalPrice = $_SESSION['total_price'] ?? 0;

// 데이터베이스 연결
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'stay';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("DB 연결 실패: " . $conn->connect_error);
}

// POST 요청 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 세션 값 유지
    $_SESSION['total_quantity'] = $totalQuantity;
    $_SESSION['total_price'] = $totalPrice;

    $couponType = $_POST['coupon_type'];

    if ($couponType === 'signup') {
        $sql = "INSERT INTO coupons (member_id, coupon_name, discount_rate, is_used)
                VALUES ('$member_id', '신규가입 쿠폰', 10, 0)";
    } elseif ($couponType === 'first_booking') {
        $sql = "INSERT INTO coupons (member_id, coupon_name, discount_rate, is_used)
                VALUES ('$member_id', '첫 예약 기념 쿠폰', 20, 0)";
    } else {
        die("<script>alert('잘못된 쿠폰 요청입니다.'); location.href = 'coupon_issue.php';</script>");
    }

    // 쿠폰 발급 쿼리 실행
    if ($conn->query($sql)) {
        // 리다이렉트: 쿠폰 발급 성공 시 예약 확인 페이지로 이동
        header('Location: contents_reservation.php');
        exit;
    } else {
        echo "<script>alert('쿠폰 발급 실패: " . $conn->error . "');</script>";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>쿠폰 발급</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }

 /* 뒤로가기 버튼 */
        .back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: transparent;
            color: #000;
            font-size: 30px;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }

        .back-btn:hover {
            color: #333;
        }


        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            text-align: center;
            background-color: #0070c0;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #0058a0;
        }
    </style>
</head>
<body>

<!-- 뒤로가기 버튼 -->
    <a href="contents_reservation.php" class="back-btn">&lt;</a>

    <div class="container">
        <h2>쿠폰 발급</h2>
        <form method="POST" action="coupon_issue.php">
            <button class="btn" name="coupon_type" value="signup">신규가입 기념 10% 할인 쿠폰</button>
            <button class="btn" name="coupon_type" value="first_booking">첫 예약 기념 20% 쿠폰</button>
        </form>
    </div>
</body>
</html>
