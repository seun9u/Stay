<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/managerstyle.css">
    <title>관리자 페이지-이벤트 관리</title>
</head>
<header>
    <div class="header-wrapper">
        <a href="index.php" class="logo">STAY</a>
</header>

<body id="manager_body">
    <main class="main_wrapper event">
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
                    <li class="menus">숙소 관리</li>
                </a>
                <a href="manager_event.php" style="text-decoration: none;">
                    <li class="menus active">이벤트 관리</li>
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
                <section class="contents_header">
                    <div class="title">이벤트 관리</div>
                    <div class="action_buttons">
                        <input type="text" class="search" placeholder="이벤트 검색">
                        <a href="#"><button class="action_button">등록</button></a>
                        <a href="#"><button class="action_button">삭제</button></a>
                    </div>
                </section>

                <!-- 테이블 형식 -->
                <div class="table_wrapper">
                    <div class="table_header">
                        <div class="table_col checkbox_col">
                            <input type="checkbox" id="select_all" onclick="toggleSelectAll(this)">
                        </div>
                        <div class="table_col class">번호</div>
                        <div class="table_col title">이벤트 제목</div>
                        <div class="table_col type">이벤트 유형</div>
                        <div class="table_col date">기간</div>
                    </div>
                    <div class="table_row">
                        <div class="table_col checkbox_col"><input type="checkbox" name="selected_items[]" value="1"></div>
                        <div class="table_col class">1</div>
                        <div class="table_col title">가을 시즌 특별 할인</div>
                        <div class="table_col type">할인 행사</div>
                        <div class="table_col date">2023-10-01 ~<br>2023-10-15</div>
                    </div>
                    <div class="table_row">
                        <div class="table_col checkbox_col"><input type="checkbox" name="selected_items[]" value="2"></div>
                        <div class="table_col class">2</div>
                        <div class="table_col title">연말 예약 이벤트</div>
                        <div class="table_col type">이벤트</div>
                        <div class="table_col date">2023-11-20 ~<br>2023-12-05</div>
                    </div>
                    <div class="table_row">
                        <div class="table_col checkbox_col"><input type="checkbox" name="selected_items[]" value="3"></div>
                        <div class="table_col class">3</div>
                        <div class="table_col title">무료 조식 제공 프로모션</div>
                        <div class="table_col type">프로모션</div>
                        <div class="table_col date">2023-09-15 ~<br>2023-09-30</div>
                    </div>
                    <div class="table_row">
                        <div class="table_col checkbox_col"><input type="checkbox" name="selected_items[]" value="4"></div>
                        <div class="table_col class">4</div>
                        <div class="table_col title">겨울 휴가 얼리버드 할인</div>
                        <div class="table_col type">할인 행사</div>
                        <div class="table_col date">2023-12-01 ~<br>2023-12-15</div>
                    </div>

                </div>
            </section>
        </section>
    </main>

    <!-- 체크박스 전체 선택 스크립트 -->
    <script>
        function toggleSelectAll(checkbox) {
            const checkboxes = document.querySelectorAll('input[name="selected_items[]"]');
            checkboxes.forEach((cb) => {
                cb.checked = checkbox.checked;
            });
        }
    </script>
</body>

</html>