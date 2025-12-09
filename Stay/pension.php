<?php
session_start();
?>

<?php
// 데이터베이스 연결 정보
$host = 'localhost';
$port = '3306';
$dbname = 'stay'; // 데이터베이스 이름
$charset = 'utf8';
$username = 'root'; // MySQL 기본 사용자
$password = ""; // MySQL 기본 비밀번호 (XAMPP는 기본적으로 빈 값)

// 데이터베이스 연결
$conn = new mysqli($host, $username, $password, $dbname);

// 연결 오류 확인
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// 검색어와 필터 값 가져오기
$keyword = $_GET['keyword'] ?? ''; // 검색어
$minPrice = $_GET['min_price'] ?? 0; // 기본값: 0원
$maxPrice = $_GET['max_price'] ?? 500000; // 기본값: 500000원
$categoryLarge = $_GET['category_large'] ?? '펜션'; // 숙소 유형 필터
$availability = $_GET['is_available_today'] ?? ''; // 사용 가능 여부
$roomLocation = $_GET['room_location'] ?? ''; // 지역 필터

// 기본 SQL 쿼리
$sql = "SELECT * FROM rooms WHERE room_price BETWEEN ? AND ?";

// 필터 조건 추가
$params = [$minPrice, $maxPrice];
$types = "ii"; // 두 개의 정수 값

if (!empty($categoryLarge)) {
    $sql .= " AND category_large = ?";
    $params[] = $categoryLarge;
    $types .= "s";
}

if (!empty($roomLocation)) {
    $sql .= " AND room_location = ?";
    $params[] = $roomLocation;
    $types .= "s";
}

if ($availability === "Y") {
    $sql .= " AND is_available_today = 'Y'";
}

// SQL 쿼리 준비 및 실행
$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

// HTML 시작
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STAY</title>
    <link rel="stylesheet" href="css/buttonstyle.css">

</head>

<body>
    <!-- 헤더 -->
    <header>
        <div class="header-wrapper">
            <a href="index.php" class="logo1">STAY</a>
            <div class="util-menu">
                <?php if (isset($_SESSION['id'])): ?>
                    <!-- 로그인한 경우 -->
                    <a href="logout.php">로그아웃</a>
                    <a href="my-page_member_pwd.php">마이페이지</a>
                <?php else: ?>
                    <!-- 로그인하지 않은 경우 -->
                    <a href="sign_up.php">회원가입</a>
                    <a href="login.php">로그인</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- 검색 섹션 -->
    <section class="search-section">
        <div class="search-wrapper">
            <a href="#" class="logo">펜션</a>
            <form class="search-form" action="search.php" method="GET">
                <div class="input-group">
                    <input type="text" placeholder="펜션을 검색해보세요 !" class="wide-input">
                </div>
                <div class="input-group">
                    <div class="date-picker">
                        <input type="text" id="date-input" placeholder="체크인 ~ 체크아웃" readonly />
                        <div id="calendar" class="calendar hidden">
                            <div class="calendar-header">
                                <button id="prev-month">&lt;</button>
                                <span id="current-month"></span>
                                <button id="next-month">&gt;</button>
                            </div>
                            <div class="calendar-days">
                                <div class="day-name">일</div>
                                <div class="day-name">월</div>
                                <div class="day-name">화</div>
                                <div class="day-name">수</div>
                                <div class="day-name">목</div>
                                <div class="day-name">금</div>
                                <div class="day-name">토</div>
                            </div>
                            <div id="calendar-grid" class="calendar-grid"></div>
                        </div>
                    </div>

                    <input type="text" placeholder="인원 2">
                </div>
                <button type="submit">검색</button>
            </form>
        </div>
    </section>
    <!-- carousel 섹션 -->
    <section class="carousel-section">
        <h2>이벤트</h2>
        <div class="carousel-container">
            <div class="carousel">
                <div class="carousel-item">
                    <img src="img/contents/event1.png" alt="이벤트 1">
                </div>
                <div class="carousel-item">
                    <img src="img/contents/event2.png" alt="이벤트 2">
                </div>
                <div class="carousel-item">
                    <img src="img/contents/event3.png" alt="이벤트 3">
                </div>
                <div class="carousel-item">
                    <img src="img/contents/event4.png" alt="이벤트 4">
                </div>
                <div class="carousel-item">
                    <img src="img/contents/event5.png" alt="이벤트 5">
                </div>
                <div class="carousel-item">
                    <img src="img/contents/event6.png" alt="이벤트 6">
                </div>
                <div class="carousel-item">
                    <img src="img/contents/event7.png" alt="이벤트 7">
                </div>
                <div class="carousel-item">
                    <img src="img/contents/event8.png" alt="이벤트 8">
                </div>
                <div class="carousel-item">
                    <img src="img/contents/event9.png" alt="이벤트 9">
                </div>
            </div>
            <!-- 네비게이션 -->
            <button class="carousel-prev">‹</button>
            <button class="carousel-next">›</button>
            <div class="carousel-indicators">
                <span data-index="0" class="active"></span>
                <span data-index="1"></span>
                <span data-index="2"></span>
            </div>
        </div>
    </section>
    <!-- 숙소 내용 들어옴-->
    <section>
        <div class="results">
            <h1>이런 펜션은 어때요 ?</h1> <!-- 제목 -->

            <div class="result-list"> <!-- 결과 리스트 컨테이너 -->
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
    </section>
    <section class="recommend-hotels">
        <div class="section-header">
            <h2>이 지역은 이 펜션</h2>
            <a href="#" class="view-all">전체보기</a>
        </div>
        <div class="hotel-list">
            <!-- Hotel Item 1 -->
            <div class="hotel-item">
                <div class="rank">1</div>
                <img src="img/special/special6.jpg" alt="호텔 이미지">
                <div class="hotel-info">
                    <h3>[인천]종이학펜션(애견동반)</h3>
                    <p class="rating">⭐ 4.2 (1,559)</p>
                    <p class="price">62,000원~</p>
                </div>
            </div>

            <!-- Hotel Item 2 -->
            <div class="hotel-item">
                <div class="rank">2</div>
                <img src="img/special/special7.jpg" alt="호텔 이미지">
                <div class="hotel-info">
                    <h3>[양평]양평 생각속의 집 펜션</h3>
                    <p class="rating">⭐ 4.4 (572)</p>
                    <p class="price">55,000원~</p>
                </div>
            </div>

            <!-- Hotel Item 3 -->
            <div class="hotel-item">
                <div class="rank">3</div>
                <img src="img/special/special8.jpg" alt="호텔 이미지">
                <div class="hotel-info">
                    <h3>[홍천]홍천 유리트리트 펜션</h3>
                    <p class="rating">⭐ 4.0 (326)</p>
                    <p class="price">54,900원~</p>
                </div>
            </div>

            <!-- Hotel Item 4 -->
            <div class="hotel-item">
                <div class="rank">4</div>
                <img src="img/special/special9.jpg" alt="호텔 이미지">
                <div class="hotel-info">
                    <h3>[경주]경주 라궁펜션</h3>
                    <p class="rating">⭐ 4.6 (320)</p>
                    <p class="price">152,150원~</p>
                </div>
            </div>

            <!-- Hotel Item 5 -->
            <div class="hotel-item">
                <div class="rank">5</div>
                <img src="img/special/special10.jpg" alt="호텔 이미지">
                <div class="hotel-info">
                    <h3>[울릉도]코스모스 펜션</h3>
                    <p class="rating">⭐ 4.5 (1,353)</p>
                    <p class="price">106,000원~</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 푸터 -->
    <footer>
        <div class="footer-wrapper">
            <p>&copy; 2024 STAY. All Rights Reserved.</p>
            <nav class="footer-nav">
                <a href="#">이용약관</a>
                <a href="#">개인정보 처리방침</a>
                <a href="#">고객센터</a>
            </nav>
        </div>
    </footer>
</body>
<script src="js/carousel.js"></script>
<script src="js/calendar.js"></script>

</html>