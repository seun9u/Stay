<?php
session_start();

// 로그인 여부 확인
if (!isset($_SESSION['id'])) {
    header("Location: login2.php");
    exit();
}

// 로그인된 사용자 정보
$user_id = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content_code = $_POST['content_code'] ?? null;
    $total_payment = $_POST['total_payment'] ?? null;
    $customer_name = $_POST['customer_name'] ?? null;
    $customer_phone = $_POST['customer_phone'] ?? null;

    if (!$content_code || !$total_payment || !$customer_name || !$customer_phone) {
        die("필수 입력 정보가 누락되었습니다.");
    }

    // 랜덤 예약번호 생성
    $reservation_code = strtoupper(bin2hex(random_bytes(4))); // 8자리 랜덤 예약번호

    // 데이터베이스 연결
    $conn = new mysqli("localhost", "root", "", "stay");

    // 연결 확인
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // 예약 정보를 데이터베이스에 저장
    $stmt = $conn->prepare(
        "INSERT INTO reservation (reservation_code, user_id, content_code, customer_name, customer_phone, total_payment, created_at) 
         VALUES (?, ?, ?, ?, ?, ?, NOW())"
    );
    $stmt->bind_param("sssssi", $reservation_code, $user_id, $content_code, $customer_name, $customer_phone, $total_payment);

    if ($stmt->execute()) {
        ?>
        <!DOCTYPE html>
        <html lang="ko">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>결제 완료</title>
            <link rel="stylesheet" href="payment_complete.css"> <!-- CSS 연결 -->
        </head>
        <body>
            <div class="container">
                <h1>결제가 성공적으로 완료되었습니다!</h1>
                <div class="reservation-info">
                    <p>숙소 코드: <?= htmlspecialchars($content_code) ?></p>
                    <p>예약자 이름: <?= htmlspecialchars($customer_name) ?></p>
                    <p>전화번호: <?= htmlspecialchars($customer_phone) ?></p>
                    <p>총 결제 금액: ₩<?= number_format($total_payment) ?></p>
                    <p>예약번호: <strong><?= htmlspecialchars($reservation_code) ?></strong></p>
                </div>
                <p class="note">예약번호를 저장하세요. 예약 조회에 필요합니다.</p>
                <a href="reservation_lookup.php">예약 조회 페이지로 이동</a>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "<p>예약 저장 중 오류가 발생했습니다: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>