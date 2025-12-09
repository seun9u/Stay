<?php
// 세션 시작
session_start();

// 로그인 여부 확인
if (!isset($_SESSION['id'])) {
    header("Location: login2.php"); // 로그인 페이지로 리다이렉트
    exit();
}

$user_id = $_SESSION['id']; // 로그인된 사용자 ID

if (!isset($_GET['content_code'])) {
    die("숙소 코드를 제공해 주세요.");
}

$content_code = $_GET['content_code'];

// 데이터베이스 연결
$conn = new mysqli("localhost", "root", "", "stay");

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL 주입 방지를 위해 Prepared Statement 사용
$stmt = $conn->prepare("SELECT * FROM rooms WHERE room_code = ?");
$stmt->bind_param("s", $content_code);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("해당 숙소 정보를 찾을 수 없습니다.");
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($row['room_name']); ?> - 상세 정보</title>
    <link rel="stylesheet" href="css/contents_detail.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"> <!-- Font Awesome -->
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <a href="index.php" class="logo">STAY</a>
        </div>

<div class="image-gallery">
    <div class="image-main">
        <img src="<?php echo htmlspecialchars($row['content_img']); ?>" alt="대표 이미지">
    </div>
    <div class="image-sub">
        <?php if (!empty($row['content_img1'])): ?>
            <img src="<?php echo htmlspecialchars($row['content_img1']); ?>" alt="추가 이미지 1">
        <?php endif; ?>
        <?php if (!empty($row['content_img2'])): ?>
            <img src="<?php echo htmlspecialchars($row['content_img2']); ?>" alt="추가 이미지 2">
        <?php endif; ?>
        <?php if (!empty($row['content_img3'])): ?>
            <img src="<?php echo htmlspecialchars($row['content_img3']); ?>" alt="추가 이미지 3">
        <?php endif; ?>
        <?php if (!empty($row['content_img4'])): ?>
            <img src="<?php echo htmlspecialchars($row['content_img4']); ?>" alt="추가 이미지 4">
        <?php endif; ?>
    </div>
</div>


        <!-- 숙소 정보 -->
        <div class="room-info">
            <div class="info-item"><?php echo htmlspecialchars($row['room_name']); ?></div>
            <div class="info-item"><?php echo htmlspecialchars($row['category_large']); ?></div>
            <div class="price-section">
    <span class="price-label">1박 요금 (2인기준 / 최대 6인):</span>
    <span class="price-text">₩<?php echo number_format($row['room_price']); ?></span>
</div>


        <!-- 박수 선택 -->
        <div class="night-selection">
            <div class="left-section">
                <span class="label-left">숙박</span>
                <div class="counter-wrapper">
                    <button id="decrease-nights">-</button>
                    <span id="nights">1</span>
                    <button id="increase-nights">+</button>
                </div>
                <span class="label-right">일</span>
            </div>
            <div class="right-section">
                총 요금: ₩<span id="total-price"><?php echo number_format($row['room_price']); ?></span>
            </div>
        </div>

<!-- 숙소 옵션 섹션 -->
<div class="room-options">
    <div class="option-item"><i class="fas fa-bed"></i> 더블 침대 1개</div>
    <div class="option-item"><i class="fas fa-smoking-ban"></i> 금연</div>
    <div class="option-item"><i class="fas fa-ruler-combined"></i> 33㎡</div>
    <div class="option-item"><i class="fas fa-wifi"></i> 무료 Wi-Fi</div>
    <div class="option-item"><i class="fas fa-snowflake"></i> 에어컨</div>
    <div class="option-item"><i class="fas fa-bath"></i> 개인 욕실</div>
</div>


        <!-- 하단 버튼 -->
        <div class="action-buttons">
            <form id="cart-form" action="cart_add.php" method="POST" style="display: inline;">
                <input type="hidden" name="content_code" value="<?php echo htmlspecialchars($row['room_code']); ?>">
                <input type="hidden" name="room_name" value="<?php echo htmlspecialchars($row['room_name']); ?>">
                <input type="hidden" name="thumbnail" value="<?php echo htmlspecialchars($row['content_img']); ?>">
                <input type="hidden" name="total_payment" id="total-payment-input-cart" value="<?php echo htmlspecialchars($row['room_price']); ?>">
                <input type="hidden" name="nights" id="nights-input-cart" value="1">
                <button type="submit" class="btn cart-btn">
                    <i class="fas fa-shopping-cart"></i>
                </button>
            </form>
            <form id="reserve-form" action="payment.php" method="GET" style="display: inline;">
                <input type="hidden" name="content_code" value="<?php echo htmlspecialchars($row['room_code']); ?>">
                <input type="hidden" name="total_payment" id="total-payment-input" value="<?php echo htmlspecialchars($row['room_price']); ?>">
                <input type="hidden" name="nights" id="nights-input" value="1">
                <button type="submit" class="btn primary">바로 예약하기</button>
            </form>
        </div>
    </div>

    <script src="js/contents_detail.js"></script>
</body>
</html>
