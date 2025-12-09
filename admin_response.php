<?php
include_once 'inc/db.php'; 

$pdo = db_get_pdo();
$inquiry_id = $_GET['inquiry_id'] ?? null;

if (!$inquiry_id) {
    die("유효한 문의 ID가 필요합니다.");
}

// POST 요청 처리: 답변 저장
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_response'])) {
    $admin_response = $_POST['admin_response'];

    try {
        $sql = "UPDATE onetoone SET admin_response = :admin_response WHERE id = :inquiry_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':admin_response', $admin_response);
        $stmt->bindParam(':inquiry_id', $inquiry_id, PDO::PARAM_INT);
        $stmt->execute();

        // 저장 후 관리자 페이지로 리다이렉트
        header("Location: admin_response.php?inquiry_id=" . $inquiry_id . "&success=1");
        exit;
    } catch (PDOException $e) {
        die("답변 저장 중 오류 발생: " . $e->getMessage());
    }
}

// 특정 문의 데이터 가져오기
try {
    $sql = "SELECT * FROM onetoone WHERE id = :inquiry_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':inquiry_id', $inquiry_id, PDO::PARAM_INT);
    $stmt->execute();
    $inquiry = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$inquiry) {
        die("해당 문의를 찾을 수 없습니다.");
    }
} catch (PDOException $e) {
    die("데이터를 가져오는 중 오류 발생: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>답변 작성</title>
    <link rel="stylesheet" href="css/admin_response.css">
</head>
<body>
    <div id="response-page">
        <h1>답변 작성</h1>
        <h2>문의 제목: <?= htmlspecialchars($inquiry['inquiry_title']) ?></h2>
        <p><strong>문의 내용:</strong> <?= nl2br(htmlspecialchars($inquiry['content'])) ?></p>
        <p><strong>작성일:</strong> <?= date('Y-m-d', strtotime($inquiry['created_at'])) ?></p>

        <?php if (isset($_GET['success'])): ?>
            <p style="color: green;">답변이 저장되었습니다.</p>
        <?php endif; ?>

        <form action="admin_response.php?inquiry_id=<?= htmlspecialchars($inquiry_id) ?>" method="post">
            <textarea name="admin_response" rows="5" cols="50" placeholder="답변 내용을 입력하세요" required><?= htmlspecialchars($inquiry['admin_response'] ?? '') ?></textarea>
            <button type="submit">답변 저장</button>
        </form>

        <a href="onetoone.php" class="btn-back">문의 목록으로 돌아가기</a>
    </div>
</body>
</html>
