<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STAY</title>
    <link rel="stylesheet" href="css/indexstyle.css">
</head>

<body>
    <!-- 헤더 -->
    <header>
        <div class="header-wrapper">
            <a href="index.php" class="logo2">STAY</a>
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
            <a href="index.php" class="logo">STAY</a>
            <form class="search-form" action="search.php" method="GET">
                <div class="input-group">
                    <input type="text" name="destination" placeholder="여행지나 숙소를 검색해보세요" class="wide-input">
                </div>
                <div class="input-group">
                    <div class="date-picker">
                        <input type="text" id="date-input" name="checkin_checkout" placeholder="체크인 ~ 체크아웃" readonly />
                        <div id="calendar" class="calendar hidden">
                            <div class="calendar-header">
                                <button id="prev-month" type="button">&lt;</button>
                                <span id="current-month"></span>
                                <button id="next-month" type="button">&gt;</button>
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
                    <input type="text" name="guests" placeholder="인원 2">
                </div>
                <button type="submit">검색</button>
            </form>
        </div>
    </section>
    <!-- 추천 섹션 -->
    <main>
        <section class="recommend-section">
            <div class="button-wrapper">
                <a href="hotel.php" class="button">
                    <img src="img/icon/hotel_icon.png" alt="호텔">
                    <p>호텔</p>
                </a>
                <a href="motel.php" class="button">
                    <img src="img/icon/motel_icon.png" alt="모텔">
                    <p>모텔</p>
                </a>
                <a href="pension.php" class="button">
                    <img src="img/icon/pension_icon.png" alt="펜션">
                    <p>펜션</p>
                </a>
                <a href="glamping.php" class="button">
                    <img src="img/icon/glamping_icon.png" alt="글램핑">
                    <p>글램핑</p>
                </a>
                <a href="resort.php" class="button">
                    <img src="img/icon/resort_icon.png" alt="리조트">
                    <p>리조트</p>
                </a>
                <a href="food.php" class="button">
                    <img src="img/icon/food_icon.png" alt="주변맛집">
                    <p>주변맛집</p>
                </a>
            </div>

        </section>
    </main>
    <!-- wide-banner 섹션 -->
    <section class="wide-banner-section">
        <a href="#" class="wide-banner-link">
            <img src="img/contents/long.png" alt="Promotional Banner" />
        </a>
    </section>
    <!-- carousel 섹션 -->
    <section class="carousel-section">
        <div class="section-header">
            <h2>이벤트</h2>
            <a href="#" class="view-all">전체보기</a>
        </div>
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

    <!--숙소 추천 페이지 -->
    <section class="recommend-hotels">
        <div class="section-header">
            <h2>이 지역은 이 숙소</h2>
            <a href="#" class="view-all">전체보기</a>
        </div>
        <div class="hotel-list">
            <!-- Hotel Item 1 -->
            <div class="hotel-item">
                <div class="rank">1</div>
                <img src="img/index/index1.jpg" alt="호텔 이미지">
                <div class="hotel-info">
                    <h3>제주 센트럴 시티 호텔</h3>
                    <p class="rating">⭐ 4.2 (1,559)</p>
                    <p class="price">62,000원~</p>
                </div>
            </div>

            <!-- Hotel Item 2 -->
            <div class="hotel-item">
                <div class="rank">2</div>
                <img src="img/index/index2.jpg" alt="호텔 이미지">
                <div class="hotel-info">
                    <h3>더 베스트 제주 성산</h3>
                    <p class="rating">⭐ 4.4 (572)</p>
                    <p class="price">55,000원~</p>
                </div>
            </div>

            <!-- Hotel Item 3 -->
            <div class="hotel-item">
                <div class="rank">3</div>
                <img src="img/index/index3.jpg" alt="호텔 이미지">
                <div class="hotel-info">
                    <h3>신신호텔 제주시티</h3>
                    <p class="rating">⭐ 4.0 (326)</p>
                    <p class="price">54,900원~</p>
                </div>
            </div>

            <!-- Hotel Item 4 -->
            <div class="hotel-item">
                <div class="rank">4</div>
                <img src="img/index/index4.jpg" alt="호텔 이미지">
                <div class="hotel-info">
                    <h3>스탠포드 호텔 제주</h3>
                    <p class="rating">⭐ 4.6 (320)</p>
                    <p class="price">152,150원~</p>
                </div>
            </div>

            <!-- Hotel Item 5 -->
            <div class="hotel-item">
                <div class="rank">5</div>
                <img src="img/index/index5.jpg" alt="호텔 이미지">
                <div class="hotel-info">
                    <h3>페어필드 바이 메리어트 부산</h3>
                    <p class="rating">⭐ 4.5 (1,353)</p>
                    <p class="price">106,000원~</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 이벤트 섹션 -->
    <main>
        <section class="event-section">
            <h2>인기있는 여행지</h2>
            <div class="card-wrapper">
                <div class="card">
                    <img src="img/index/jeju.jpg" alt="제주도">
                    <p>제주도</p>
                </div>
                <div class="card">
                    <img src="img/index/seoul.jpg" alt="서울">
                    <p>서울</p>
                </div>
                <div class="card">
                    <img src="img/index/busan.jpg" alt="부산">
                    <p>부산</p>
                </div>
                <div class="card">
                    <img src="img/index/gangwon.jpg" alt="강원도">
                    <p>강원도</p>
                </div>
                <div class="card">
                    <img src="img/index/daejeon.jpg" alt="대전">
                    <p>대전</p>
                </div>
            </div>
        </section>
    </main>
    <!-- 푸터 -->
    <footer>
        <div class="footer-wrapper">
            <p>&copy; 2024 STAY. All Rights Reserved.</p>
            <nav class="footer-nav">
                <a href="#">이용약관</a>
                <a href="#">개인정보 처리방침</a>
                <a href="customer.php">고객센터</a>
                <a href="#" onclick="checkAdmin()">관리자 페이지</a>
                <script>
                    function checkAdmin() {
                        <?php if (isset($_SESSION['id']) && $_SESSION['id'] === 'admin'): ?>
                            // 관리자인 경우 관리자 페이지로 이동
                            window.location.href = 'manager_home.php';
                        <?php else: ?>
                            // 관리자가 아닌 경우 알림 메시지 표시
                            alert('관리자만 접근할 수 있습니다.');
                        <?php endif; ?>
                    }
                </script>
            </nav>
        </div>
    </footer>
</body>
<script src="js/carousel.js"></script>
<script src="js/calendar.js"></script>

</html>