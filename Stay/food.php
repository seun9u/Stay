<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>맛집 메인페이지</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            text-align: left; /* 전체를 왼쪽 정렬 */
        }
        h1 {
            text-align: center;
        }
        .search-box {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .search-box select,
        .search-box input[type="text"],
        .search-box button {
            padding: 10px;
            font-size: 16px;
            height: 40px; /* 높이 일관성 있게 설정 */
            border: 1px solid #ccc;
            box-sizing: border-box; /* padding, border가 요소 크기에 포함되도록 설정 */
            vertical-align: middle; /* 수직 정렬 */
            border-radius: 5px; /* 모든 요소에 일관된 border-radius 적용 */
        }
        .search-box input[type="text"] {
            width: 200px; /* 텍스트 입력란의 너비 설정 */
            /* border-left: none; 제거 */
        }
        .search-box button {
            width: 80px; /* 버튼 너비 설정 */
            background-color: #007BFF;
            color: white;
            cursor: pointer;
        }
        .search-box button:hover {
            background-color: #0056b3;
        }
        .restaurant-list-section, .ad-section {
            text-align: left;
            margin: 20px 0;
        }
        .ad-section h2, .restaurant-list-section h2 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }
        .ad-section img, .restaurant-list img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .restaurant-list {
            list-style-type: none;
            padding: 0;
        }
        .restaurant-item {
            padding: 15px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            display: flex; /* 수평으로 배치 */
            align-items: center; /* 세로 중앙 정렬 */
            gap: 20px; /* 이미지와 텍스트 간의 간격 */
        }
        .restaurant-item img {
            width: 120px; /* 이미지 크기 조정 */
            height: 120px;
            object-fit: cover;
            border-radius: 5px;
        }
        .restaurant-item h3 {
            margin: 0 0 5px;
        }
        .restaurant-item p {
            margin: 5px 0;
        }
        /* 필터 버튼을 일렬로 배치하는 스타일 */
        .filter-buttons {
            display: flex;
            justify-content: flex-start; /* 왼쪽 정렬 */
            gap: 10px; /* 항목 간 간격 조정 */
            flex-wrap: wrap; /* 화면 크기 축소 시 줄바꿈 */
            margin-bottom: 20px;
        }
        .filter-buttons div {
            display: flex;
            align-items: center;
        }
        .filter-buttons select, .filter-buttons button {
            padding: 6px 10px;
            font-size: 14px;
            border-radius: 5px;
            margin-right: 5px;
        }

        /* 이미지와 텍스트가 나란히 오게 만들기 위한 스타일 */
        .ad-section img {
            display: block;
            margin: 10px 0;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>맛집</h1>

    <!-- 검색창 -->
    <div class="search-box">
        <form method="GET" action="">
            <select name="region">
                <option value="">지역 선택</option>
                <option value="서울">서울</option>
                <option value="경기">경기</option>
                <option value="인천">인천</option>
                <option value="강원">강원</option>
                <option value="제주">제주</option>
                <option value="대전">대전</option>
                <option value="충북">충북</option>
                <option value="충남">충남</option>
                <option value="부산">부산</option>
                <option value="울산">울산</option>
                <option value="경남">경남</option>
                <option value="대구">대구</option>
                <option value="경북">경북</option>
                <option value="광주">광주</option>
                <option value="전남">전남</option>
                <option value="전북">전북</option>
            </select>
            &nbsp; <!-- 간격 추가 -->
            <input type="text" name="search" placeholder="맛집을 검색하세요..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            &nbsp; <!-- 간격 추가 -->
            <button type="submit">검색</button>
        </form>
    </div>

    <!-- 추천 레스토랑 및 광고 이미지 섹션 -->
    <div class="ad-section">
        <h2>추천 레스토랑</h2>
         <img src="<?php echo "http://localhost/stay/img/food/food0.jpg"; ?>" alt="추천 레스토랑 광고 이미지">
    </div>

    <!-- 모든 레스토랑 섹션 -->
    <div class="restaurant-list-section">
        <h2>모든 레스토랑</h2>

        <!-- 필터 버튼 섹션 (모든 레스토랑 아래) -->
        <div class="filter-buttons">
            <!-- 거리 -->
            <div>
                <select name="distance">
                    <option value="">거리</option>
                    <option value="5km">5km 이내</option>
                    <option value="10km">10km 이내</option>
                    <option value="20km">20km 이내</option>
                </select>
            </div>
            <!-- 음식 종류 -->
            <div>
                <select name="food-type">
                    <option value="">음식 종류</option>
                    <option value="한식">한식</option>
                    <option value="중식">중식</option>
                    <option value="양식">양식</option>
                    <option value="일식">일식</option>
                </select>
            </div>
            <!-- 검색 조건 -->
            <div>
                <select name="search">
                    <option value="">검색 조건</option>
                </select>
            </div>
            <!-- 정렬 -->
            <div>
                <select name="list">
                    <option value="">정렬</option>
                </select>
            </div>
        </div>

        <!-- 레스토랑 목록 -->
   <ul class="restaurant-list">
    <?php
    // 맛집 목록 배열 예제 (각 레스토랑에 이미지 경로 추가)
    $restaurants = [
        [
            "name" => "맛있는 레스토랑",
            "description" => "평점 4.9 (1,422) | 가격: 88,000",
            "location" => "현재 위치까지 거리: 714m",
            "image" => "http://localhost/stay/img/food/food1.jpg"     // 사진 경로
        ],
        [
            "name" => "더 맛있는 레스토랑",
            "description" => "평점 4.9 (1,422) | 가격: 88,000",
            "location" => "현재 위치까지 거리: 714m",
            "image" => "http://localhost/stay/img/food/food2.jpg"
        ],
        [
            "name" => "뒤지게 맛있는 레스토랑",
            "description" => "평점 4.9 (1,422) | 가격: 88,000",
            "location" => "현재 위치까지 거리: 714m",
            "image" => "http://localhost/stay/img/food/food3.jpg"
        ],
        [
            "name" => "살떨리게 맛있는 레스토랑",
            "description" => "평점 4.9 (1,422) | 가격: 88,000",
            "location" => "현재 위치까지 거리: 714m",
            "image" => "http://localhost/stay/img/food/food4.jpg"
        ],
        [
            "name" => "둘이먹다 둘다죽는 레스토랑",
            "description" => "평점 4.9 (1,422) | 가격: 88,000",
            "location" => "현재 위치까지 거리: 714m",
            "image" => "http://localhost/stay/img/food/food5.jpg"
        ],
        [
            "name" => "나만 알고 싶은 레스토랑",
            "description" => "평점 4.9 (1,422) | 가격: 88,000",
            "location" => "현재 위치까지 거리: 714m",
            "image" => "http://localhost/stay/img/food/food6.jpg"
        ]
    ];

    // 검색 키워드와 선택한 지역
    $searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';
    $selectedRegion = isset($_GET['region']) ? $_GET['region'] : '';

    // 맛집 정보를 필터링하여 동적으로 생성
    foreach ($restaurants as $restaurant) {
        // 검색 키워드와 지역 필터링
        if (!empty($searchKeyword) && stripos($restaurant['name'], $searchKeyword) === false) {
            continue;
        }
        if (!empty($selectedRegion) && stripos($restaurant['location'], $selectedRegion) === false) {
            continue;
        }
        ?>
        <!-- 레스토랑 항목을 클릭하면 restaurant_detail1.php로 이동 -->
        <li class="restaurant-item">
            <a href="restaurant_detail1.php?name=<?php echo urlencode($restaurant['name']); ?>&image=<?php echo urlencode($restaurant['image']); ?>&description=<?php echo urlencode($restaurant['description']); ?>&location=<?php echo urlencode($restaurant['location']); ?>" style="display: flex; text-decoration: none; color: black;">
                <!-- 이미지 -->
                <img src="<?php echo $restaurant['image']; ?>" alt="<?php echo $restaurant['name']; ?>" style="width: 120px; height: 120px; object-fit: cover; border-radius: 5px;">
                <!-- 텍스트 -->
                <div style="margin-left: 20px;">
                    <h3><?php echo $restaurant['name']; ?></h3>
                    <p><?php echo $restaurant['description']; ?></p>
                    <p>위치: <?php echo $restaurant['location']; ?></p>
                </div>
            </a>
        </li>
    <?php } ?>
</ul>

    </div>
</div>

</body>
</html>
