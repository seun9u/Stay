<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/managerstyle.css">
    <title>관리자 페이지-공지사항</title>
</head>
<header>
    <div class="header-wrapper">
        <a href="index.php" class="logo">STAY</a>
</header>

<body id="manager_body">
    <main class="main_wrapper notice">
        <!-- 좌측 메뉴 섹션 -->
        <section class="main_menu_wrapper">
            <ul class="menu_list">
                <a href="manager_home.php" style="text-decoration: none;">
                    <li class="menus">홈</li>
                </a>
                <a href="manager_notice.php" style="text-decoration: none;">
                    <li class="menus active">공지사항 관리</li>
                </a>
                <a href="manager_product.php" style="text-decoration: none;">
                    <li class="menus">숙소 관리</li>
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
                <section class="contents_header">
                    <div class="title">공지사항 관리</div>
                    <div class="action_buttons">
                        <form method="GET" action="manager_notice.php">
                            <input type="text" class="search" name="search" placeholder="공지사항 검색">
                            <button class="order_button btn-search" type="submit">검색</button>
                        </form>
                        <a href="#"><button class="action_button">등록</button></a>
                        <a href="#"><button class="action_button">삭제</button></a>
                    </div>
                </section>
                <article class="scroller">
                    <form action="" method="INQUIRY">
                        <div class="table_wrapper">
                            <div class="table_header">
                                <div class="table_col checkbox_col"><input type="checkbox"></div>
                                <div class="table_col class">분류</div>
                                <div class="table_col title">제목</div>
                                <div class="table_col writer">글쓴이</div>
                                <div class="table_col views">조회수</div>
                                <div class="table_col date">날짜</div>
                            </div>
                            <div class="table_row">
                                <div class="table_col checkbox_col"><input type="checkbox" name="selected_items[]" value="1"></div>
                                <div class="table_col class">1</div>
                                <div class="table_col title">겨울 프로모션 안내</div>
                                <div class="table_col writer">admin</div>
                                <div class="table_col views">15,100</div>
                                <div class="table_col date">2023-11-20</div>
                            </div>
                            <div class="table_row">
                                <div class="table_col checkbox_col"><input type="checkbox" name="selected_items[]" value="2"></div>
                                <div class="table_col class">2</div>
                                <div class="table_col title">체크인/체크아웃 시간 변경 안내</div>
                                <div class="table_col writer">manager</div>
                                <div class="table_col views">12,450</div>
                                <div class="table_col date">2023-11-15</div>
                            </div>
                            <div class="table_row">
                                <div class="table_col checkbox_col"><input type="checkbox" name="selected_items[]" value="3"></div>
                                <div class="table_col class">3</div>
                                <div class="table_col title">정기 방역 작업 일정 안내</div>
                                <div class="table_col writer">support</div>
                                <div class="table_col views">10,320</div>
                                <div class="table_col date">2023-11-10</div>
                            </div>
                            <div class="table_row">
                                <div class="table_col checkbox_col"><input type="checkbox" name="selected_items[]" value="4"></div>
                                <div class="table_col class">4</div>
                                <div class="table_col title">객실 리노베이션 작업 공지</div>
                                <div class="table_col writer">system</div>
                                <div class="table_col views">18,504</div>
                                <div class="table_col date">2023-10-25</div>
                            </div>
                            <div class="table_row">
                                <div class="table_col checkbox_col"><input type="checkbox" name="selected_items[]" value="5"></div>
                                <div class="table_col class">5</div>
                                <div class="table_col title">여름 성수기 예약 안내</div>
                                <div class="table_col writer">manager</div>
                                <div class="table_col views">9,678</div>
                                <div class="table_col date">2023-06-20</div>
                            </div>
                            <div class="table_row">
                                <div class="table_col checkbox_col"><input type="checkbox" name="selected_items[]" value="6"></div>
                                <div class="table_col class">6</div>
                                <div class="table_col title">Wi-Fi 점검 작업 공지</div>
                                <div class="table_col writer">tech_team</div>
                                <div class="table_col views">7,321</div>
                                <div class="table_col date">2023-09-05</div>
                            </div>
                            <div class="table_row">
                                <div class="table_col checkbox_col"><input type="checkbox" name="selected_items[]" value="7"></div>
                                <div class="table_col class">7</div>
                                <div class="table_col title">연말 특별 패키지 안내</div>
                                <div class="table_col writer">sales</div>
                                <div class="table_col views">20,522</div>
                                <div class="table_col date">2023-12-01</div>
                            </div>

                        </div>
    </main>
    <!-- 체크박스 -->
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