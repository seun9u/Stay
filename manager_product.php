<?php
// 데이터베이스 연결
require_once(__DIR__ . "/inc/db.php"); // db.php 경로를 정확히 설정

// 현재 페이지 설정
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per_page = 10;
$offset = ($page - 1) * $items_per_page;

// 검색어 처리
$search = isset($_GET['search']) ? $_GET['search'] : '';
$search_query = $search ? "WHERE room_name LIKE :search" : "";

try {
    // PDO 객체 생성
    $pdo = db_get_pdo();

    // 데이터 조회 쿼리
    $query = "SELECT * FROM rooms $search_query LIMIT :offset, :items_per_page";
    $stmt = $pdo->prepare($query);

    // 바인딩 변수 설정
    if ($search) {
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    }
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->bindValue(':items_per_page', (int)$items_per_page, PDO::PARAM_INT);

    // 쿼리 실행
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 총 항목 수 계산
    $count_query = "SELECT COUNT(*) as total FROM rooms $search_query";
    $count_stmt = $pdo->prepare($count_query);

    if ($search) {
        $count_stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    }
    $count_stmt->execute();
    $total_items = $count_stmt->fetchColumn();

    $total_pages = ceil($total_items / $items_per_page);
} catch (PDOException $e) {
    die("데이터베이스 오류: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/managerstyle.css"> <!-- 관리자 전용 스타일 파일 -->
    <title>관리자 페이지 - 숙소 관리</title>
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
                <section class="contents_header">
                    <div class="title">숙소 관리</div>
                    <div class="action_buttons">
                        <form method="GET" action="manager_product.php" style="display: inline;">
                            <input type="text" class="search" name="search" placeholder="숙소명 검색" value="<?php echo htmlspecialchars($search); ?>">
                            <button class="order_button btn-search" type="submit">검색</button>
                        </form>
                        <form action="product_registration.php" method="GET" style="display: inline;">
                            <button class="order_button btn-register" type="submit">등록</button>
                        </form>
                        <form id="delete-form" method="POST" action="delete_rooms.php" style="display: inline;">
                            <button class="order_button btn-delete" type="submit" onclick="return confirmDelete()">삭제</button>
                        </form>
                    </div>
                </section>

                <!-- 숙소 목록 테이블 -->
                <form id="rooms-table-form">
                    <div class="table_wrapper">
                        <div class="table_header">
                            <div class="table_col checkbox_col"><input type="checkbox" onclick="toggleSelectAll(this)"></div>
                            <div class="table_col code">숙소코드</div>
                            <div class="table_col title">숙소명</div>
                            <div class="table_col price">판매가</div>
                            <div class="table_col class">대분류</div>
                        </div>
                        <div class="table_body">
                            <?php foreach ($result as $r): ?>
                                <?php
                                $room_code = $r['room_code'];
                                $room_name = $r['room_name'];
                                $room_price = number_format($r['room_price']); // 숫자 포맷
                                $category_large = !empty($r['category_large']) ? $r['category_large'] : '정보 없음';
                                ?>
                                <div class='table_row'>
                                    <div class='table_col checkbox_col'>
                                        <input type='checkbox' name='selected_items[]' form="delete-form" value='<?php echo htmlspecialchars($room_code); ?>'>
                                    </div>
                                    <div class='table_col code'>
                                        <a href="room_detail.php?room_code=<?php echo urlencode($room_code); ?>">
                                            <?php echo htmlspecialchars($room_code); ?>
                                        </a>
                                    </div>
                                    <div class='table_col title'><?php echo htmlspecialchars($room_name); ?></div>
                                    <div class='table_col price'>₩<?php echo $room_price; ?></div>
                                    <div class='table_col class'><?php echo htmlspecialchars($category_large); ?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </form>

                <!-- 페이징 UI -->
                <div class="pagination">
                    <?php if ($page > 1): ?>
                        <a href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>">이전</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>" class="<?php echo $i == $page ? 'active' : ''; ?>">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                        <a href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>">다음</a>
                    <?php endif; ?>
                </div>
            </section>
        </section>
    </main>

    <script>
        function toggleSelectAll(checkbox) {
            const checkboxes = document.querySelectorAll('input[name="selected_items[]"]');
            checkboxes.forEach(cb => cb.checked = checkbox.checked);
        }

        function confirmDelete() {
            return confirm("선택한 항목을 삭제하시겠습니까?");
        }
    </script>
</body>

</html>