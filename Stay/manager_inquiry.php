<?php
include_once 'inc/db.php';

$pdo = db_get_pdo();

try {
    // 전체 글 목록 가져오기
    $sql = "SELECT * FROM onetoone ORDER BY created_at DESC";
    $stmt = $pdo->query($sql);
    $inquiries = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("데이터를 가져오는 중 오류 발생: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/manager_inquiry.css">
    <title>관리자 페이지 - 고객 문의 관리</title>
    <div class="header-wrapper">
        <a href="index.php"
        class = "logo">STAY</a>
</head>
<body id="manager_body">
    
    <main class="main_wrapper home">
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
                    <li class="menus">이벤트 관리</li>
                </a>
                <a href="manager_inquiry.php" style="text-decoration: none;">
                    <li class="menus active">고객 문의 관리</li>
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

            <section class="contents_header">
                <div class="title">고객 문의 관리</div>
                <div class="action_buttons">
                    <form method="GET" action="manager_inquiry.php">
                        <input type="text" class="search" name="search" placeholder="고객 문의 검색">
                        <button class="order_button btn-search" type="submit">검색</button>
                    </form>
                    <a href="#"><button class="action_button">삭제</button></a>
                </div>
            </section>

            <article class="scroller">
                <table class="table">
                    

                <div class="table_wrapper">
    <table class="table">
        <thead>
            <tr>
                <th><input type="checkbox"></th>
                <th>분류</th>
                <th>제목</th>
                <th>글쓴이</th>
                <th>날짜</th>
                <th>관리</th>
            </tr>
        </thead>
        <tbody>
    <?php if (!empty($inquiries)): ?>
        <?php foreach ($inquiries as $inquiry): ?>
            <tr>
                <td><input type="checkbox" name="selected[]" value="<?= htmlspecialchars($inquiry['id']) ?>"></td>
                <td><?= htmlspecialchars($inquiry['inquiry_type']) ?></td>
                <td><?= htmlspecialchars($inquiry['inquiry_title']) ?></td>
                <td><?= htmlspecialchars($inquiry['userid'] ?? '익명') ?></td> <!-- 작성자 출력 -->
                <td><?= date('Y-m-d', strtotime($inquiry['created_at'])) ?></td>
                <td>
                    <!--<a href="onetoone.php?inquiry_id=<?= htmlspecialchars($inquiry['id']) ?>" class="button">상세 보기</a> -->
                    <a href="admin_response.php?inquiry_id=<?= htmlspecialchars($inquiry['id']) ?>" class="button">답변 작성</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6">문의 내역이 없습니다.</td>
        </tr>
    <?php endif; ?>
</tbody>
                </table>
            </article>
        </section>
    </main>
</body>
</html>
