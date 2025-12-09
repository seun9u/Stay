<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/managerstyle.css"> <!-- 관리자 전용 스타일 파일 -->
    <title>관리자 페이지-홈</title>

</head>
<header>
    <div class="header-wrapper">
        <a href="index.php" class="logo">STAY</a>
</header>

<body id="manager_body">
    <main class="main_wrapper home">
        <!-- 좌측 메뉴 섹션 -->
        <section class="main_menu_wrapper">
            <ul class="menu_list">
                <a href="manager_home.php" style="text-decoration: none;">
                    <li class="menus active">홈</li>
                </a>
                <a href="manager_notice.php" style="text-decoration: none;">
                    <li class="menus">공지사항 관리</li>
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
                    <span class="title">알림</span>
                    <div class="notification">4</div>
                </section>
                <section class="board">
                    <section class="board">
                        <div class="message">공지사항: "12월 1일부터 겨울 프로모션이 시작됩니다."</div>
                        <div class="message">고객 문의: "예약 확인서를 받을 수 있나요?"</div>
                        <div class="message">공지사항: "객실 청소 일정은 11월 30일 오전 10시입니다."</div>
                        <div class="message">고객 문의: "체크인 시간 변경이 가능할까요?"</div>
                        <div class="message">공지사항: "12월 24일~25일은 체크아웃 시간이 오전 10시로 조정됩니다."</div>
                        <div class="message">고객 문의: "추가 침대 제공이 가능한가요?"</div>
                        <div class="message">공지사항: "Wi-Fi 서비스 점검이 12월 5일 오전 1시~4시에 진행됩니다."</div>
                    </section>

                </section>
            </section>
        </section>
    </main>
</body>

</html>