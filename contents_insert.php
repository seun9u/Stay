<?php
// 데이터베이스 연결
require_once("inc/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 폼 데이터 받기
    $room_code = $_POST['room_code'];
    $room_name = $_POST['room_name'];
    $room_price = $_POST['room_price'];
    $room_location = $_POST['room_location']; // 지역 필드 추가
    $category_large = $_POST['category_large'];
    $category_small = $_POST['category_small'];
    $content_img = $_POST['content_img'];
    $content_img1 = $_POST['content_img1'] ?? null;
    $content_img2 = $_POST['content_img2'] ?? null;
    $content_img3 = $_POST['content_img3'] ?? null;
    $content_img4 = $_POST['content_img4'] ?? null;

    // 필수 필드 유효성 검사
    if (empty($room_code) || empty($room_name) || empty($room_price) || empty($room_location) || empty($category_large)) {
        die("필수 입력 필드가 비어 있습니다. 데이터를 모두 입력하세요.");
    }

    try {
        // PDO 객체 가져오기
        $pdo = db_get_pdo();

        // 데이터 삽입 쿼리
        $query = "INSERT INTO rooms (room_code, room_name, room_price, room_location, category_large, category_small, content_img, content_img1, content_img2, content_img3, content_img4)
                  VALUES (:room_code, :room_name, :room_price, :room_location, :category_large, :category_small, :content_img, :content_img1, :content_img2, :content_img3, :content_img4)";
        $stmt = $pdo->prepare($query);

        // 바인딩 변수 설정
        $stmt->bindParam(':room_code', $room_code, PDO::PARAM_STR);
        $stmt->bindParam(':room_name', $room_name, PDO::PARAM_STR);
        $stmt->bindParam(':room_price', $room_price, PDO::PARAM_STR);
        $stmt->bindParam(':room_location', $room_location, PDO::PARAM_STR); // 지역 값 바인딩 추가
        $stmt->bindParam(':category_large', $category_large, PDO::PARAM_STR);
        $stmt->bindParam(':category_small', $category_small, PDO::PARAM_STR);
        $stmt->bindParam(':content_img', $content_img, PDO::PARAM_STR);
        $stmt->bindParam(':content_img1', $content_img1, PDO::PARAM_STR);
        $stmt->bindParam(':content_img2', $content_img2, PDO::PARAM_STR);
        $stmt->bindParam(':content_img3', $content_img3, PDO::PARAM_STR);
        $stmt->bindParam(':content_img4', $content_img4, PDO::PARAM_STR);

        // 쿼리 실행
        $stmt->execute();

        // 성공 시 리다이렉트
        header("Location: manager_product.php?message=등록 성공");
        exit();
    } catch (PDOException $e) {
        // 예외 처리
        $error_message = "등록 실패: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>숙소 등록 결과</title>
</head>
<body>
    <?php if (isset($error_message)): ?>
        <p style="color: red;">오류: <?php echo htmlspecialchars($error_message); ?></p>
    <?php endif; ?>
    <a href="manager_product.php">목록으로 돌아가기</a>
</body>
</html>
