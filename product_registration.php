<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/managerstyle.css">
    <title>관리자 페이지 - 숙소 등록</title>
</head>
<header>
    <div class="header-wrapper">
        <a href="index.php" class="logo">STAY</a>
</header>

<body id="manager_body">
    <main class="main_wrapper product">
        <!-- 좌측 메뉴 섹션 -->
        <section class="main_menu_wrapper">
            <ul class="menu_list">
                <a href="manager_home.php" style="text-decoration: none;">
                    <li class="menus">홈</li>
                </a>
                <a href="manager_notice.php" style="text-decoration: none;">
                    <li class="menus">공지사항 관리</li>
                </a>
                <a href="manager_product.php" style="text-decoration: none;">
                    <li class="menus active">숙소 관리</li>
                </a>
                <a href="manager_event.php" style="text-decoration: none;">
                    <li class="menus">이벤트 관리</li>
                </a>
                <a href="manager_inquiry.php" style="text-decoration: none;">
                    <li class="menus">고객 문의 관리</li>
                </a>
            </ul>
        </section>

        <!-- 우측 콘텐츠 섹션 -->
        <section class="main_display">
            <header>
                <div class="login_info">
                    <span class="on_id">접속 아이디: admin</span>
                    <span class="on_dep">부서: 비서실</span>
                </div>
            </header>

            <section class="contents">
                <header>
                    <div class="title_and_registration">
                        <span class="title">숙소 등록</span>
                    </div>
                </header>
                <section class="contents">
                    <form action="contents_insert.php" method="POST">
                        <section class="board product">
                            <div class="point_img">
                                <div class="img_insert_header">
                                    <div class="point_title"> 대표 이미지 </div>
                                </div>
                                <section class="img_thumbnail">
                                    <input class="input_css" name="content_img" type="text"
                                        placeholder="대표 이미지를 위한 이미지 URL을 입력하세요." value="img/contents/room1.jpg" required />
                                </section>
                                <div class="img_insert_header">
                                    <div class="point_title"> 추가 이미지 </div>
                                </div>
                                <section class="img_more">
                                    <input class="input_css" type="text" name="content_img1" placeholder="추가 이미지 1">
                                    <input class="input_css" type="text" name="content_img2" placeholder="추가 이미지 2">
                                    <input class="input_css" type="text" name="content_img3" placeholder="추가 이미지 3">
                                    <input class="input_css" type="text" name="content_img4" placeholder="추가 이미지 4">
                                </section>
                                <div class="img_insert_header">
                                    <div class="point_title"> 숙소 정보 </div>
                                </div>
                                <div class="product_detail">
                                    <div class="product_board_three">
                                        <div class="product_code"> 숙소코드:
                                            <input type="text" name="room_code" class="text_product_code"
                                                value="<?php echo uniqid('ROOM_'); ?>" readonly>
                                        </div>
                                        <div class="product_name"> 숙소명:
                                            <input type="text" name="room_name" class="text_product_name" required>
                                        </div>
                                        <div class="product_price"> 1박 판매가:
                                            <input type="number" name="room_price" class="text_product_price" min="0" step="0.01" required>원
                                        </div>
                                    </div>
                                    <div class="product_board_two">
                                        <div class="product_category">
                                            숙소 대분류:
                                            <select name="category_large" onchange="Category_Change(this)" required>
                                                <option value=""> 선택해주세요. </option>
                                                <option value="호텔"> 호텔 </option>
                                                <option value="모텔"> 모텔 </option>
                                                <option value="게스트하우스"> 게스트하우스 </option>
                                                <option value="펜션"> 펜션 </option>
                                                <option value="리조트"> 리조트 </option>
                                                <option value="호스텔"> 호스텔 </option>
                                            </select>
                                        </div>
                                        <div class="product_category">
                                            숙소 소분류:
                                            <select id="category_small" name="category_small">
                                                <option value="" selected>선택 안 함</option> <!-- 기본 선택값 -->
                                                <option value="럭셔리">럭셔리</option>
                                                <option value="스탠다드">스탠다드</option>
                                                <option value="이코노미">이코노미</option>
                                            </select>
                                        </div>
                                        <div class="product_category">
                                            숙소 지역:
                                            <input type="text" name="room_location" placeholder="지역을 입력하세요" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- 제출 버튼 -->
                        <div class="submit_wrapper">
                            <button type="submit" class="input-submit-button">등록</button>
                        </div>
                    </form>
                </section>
            </section>
        </section>
    </main>
</body>

</html>