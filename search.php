<?php
// 데이터베이스 연결 정보
$host = 'localhost';
$port = '3306';
$dbname = 'stay';
$charset = 'utf8';
$username = 'root';
$password = "";

// 데이터베이스 연결
$conn = new mysqli($host, $username, $password, $dbname);

// 연결 오류 확인
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// 검색어와 필터 값 가져오기
$destination = $_GET['destination'] ?? '';
$checkin_checkout = $_GET['checkin_checkout'] ?? '';
$guests = $_GET['guests'] ?? '';
$minPrice = $_GET['min_price'] ?? 0;
$maxPrice = $_GET['max_price'] ?? 500000;
$categoryLarge = $_GET['category_large'] ?? '';
$availability = $_GET['is_available_today'] ?? '';

// 기본 SQL 쿼리
$sql = "SELECT * FROM rooms WHERE room_price BETWEEN ? AND ?";
$params = [$minPrice, $maxPrice];
$types = "ii";

// 검색어 조건 추가
if (!empty($destination)) {
    $sql .= " AND (room_name LIKE ? OR room_location LIKE ?)";
    $params[] = "%$destination%";
    $params[] = "%$destination%";
    $types .= "ss";
}

// 숙소 유형 조건 추가
if (!empty($categoryLarge)) {
    $sql .= " AND category_large = ?";
    $params[] = $categoryLarge;
    $types .= "s";
}

// 사용 가능 여부 조건 추가
if ($availability === "Y") {
    $sql .= " AND is_available_today = 'Y'";
}

// SQL 쿼리 준비 및 실행
$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

session_start();
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>검색 결과</title>
    <link rel="stylesheet" href="css/indexstyle.css">
</head>

<header>
    <div class="header-wrapper">
        <a href="index.php" class="logo1">STAY</a>
        <div class="util-menu">
            <?php if (isset($_SESSION['id'])): ?>
                <a href="logout.php">로그아웃</a>
                <a href="my-page_member_pwd.php">마이페이지</a>
            <?php else: ?>
                <a href="sign_up.php">회원가입</a>
                <a href="login.php">로그인</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<body>
    <div class="search-wrapper">
        <form class="search-form" action="search.php" method="GET">
            <div class="input-group">
                <input type="text" name="destination" placeholder="여행지나 숙소를 검색해보세요" class="wide-input" value="<?= htmlspecialchars($destination) ?>">
            </div>
            <div class="input-group">
                <input type="text" id="date-input" name="checkin_checkout" placeholder="체크인 ~ 체크아웃" readonly value="<?= htmlspecialchars($checkin_checkout) ?>">
                <input type="text" name="guests" placeholder="인원 2" value="<?= htmlspecialchars($guests) ?>">
            </div>
            <button type="submit">검색</button>
        </form>
    </div>
    <div class="container">
        <!-- 왼쪽 필터 -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h2>필터</h2>
                <button type="button" id="reset-filters" class="reset-button">초기화</button>
            </div>
            <form action="search.php" method="GET">
                <!-- 기존 검색창 값 유지 -->
                <input type="hidden" name="destination" value="<?= htmlspecialchars($destination) ?>">
                <input type="hidden" name="checkin_checkout" value="<?= htmlspecialchars($checkin_checkout) ?>">
                <input type="hidden" name="guests" value="<?= htmlspecialchars($guests) ?>">
                <div class="filter-group">
                    <h3>숙소 유형</h3>
                    <label><input type="radio" name="category_large" value="" <?= empty($categoryLarge) ? 'checked' : '' ?>> 전체</label>
                    <label><input type="radio" name="category_large" value="호텔" <?= $categoryLarge === '호텔' ? 'checked' : '' ?>> 호텔</label>
                    <label><input type="radio" name="category_large" value="모텔" <?= $categoryLarge === '모텔' ? 'checked' : '' ?>> 모텔</label>
                    <label><input type="radio" name="category_large" value="리조트" <?= $categoryLarge === '리조트' ? 'checked' : '' ?>> 리조트</label>
                    <label><input type="radio" name="category_large" value="펜션" <?= $categoryLarge === '펜션' ? 'checked' : '' ?>> 펜션</label>
                </div>
                <div class="price-range-wrapper">
                    <h3>가격</h3>
                    <div class="slider-container">
                        <div class="range-fill"></div>
                        <!-- 최소 가격 -->
                        <input type="range" id="min-price" name="min_price" min="0" max="500000" value="<?= htmlspecialchars($minPrice) ?>">
                        <!-- 최대 가격 -->
                        <input type="range" id="max-price" name="max_price" min="0" max="500000" value="<?= htmlspecialchars($maxPrice) ?>">
                    </div>
                    <p>
                        <span id="min-price-value"><?= number_format($minPrice) ?>원</span>
                        <span id="max-price-value"><?= number_format($maxPrice) ?>원</span>
                    </p>
                </div>

                <div class="filter-group">
                    <label><input type="checkbox" name="is_available_today" value="Y" <?= $availability === 'Y' ? 'checked' : '' ?>> 오늘 사용 가능</label>
                </div>
                <div class="filter-buttons">
                    <button type="submit">적용</button>
                </div>
            </form>
        </div>

        <div class="results">
            <h1>검색 결과</h1>
            <div class="result-list">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <a href="contents_detail.php?content_code=<?= urlencode($row['room_code']) ?>" class="result-item-link">
                            <div class="result-item">
                                <img src="<?= htmlspecialchars($row['content_img']) ?>" alt="숙소 이미지" class="result-item-img">
                                <div class="info">
                                    <h3><?= htmlspecialchars($row['room_name']) ?></h3>
                                    <p>가격: ₩<?= number_format($row['room_price']) ?> ~</p>
                                    <p>카테고리: <?= htmlspecialchars($row['category_large']) ?></p>
                                    <p>지역: <?= htmlspecialchars($row['room_location']) ?></p>
                                </div>
                            </div>
                        </a>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>검색 결과가 없습니다.</p>
                <?php endif; ?>
            </div>
        </div>

        <script src="js/calendar.js"></script>
        <script src="js/slider.js"></script>
</body>

</html>

<?php
// 데이터베이스 연결 종료
$conn->close();
?>