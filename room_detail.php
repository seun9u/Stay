<?php
// 데이터베이스 연결
require_once("inc/db.php");

// room_code 파라미터 확인
if (!isset($_GET['room_code']) || empty($_GET['room_code'])) {
    die("잘못된 요청입니다. room_code가 누락되었습니다.");
}

$room_code = $_GET['room_code'];

try {
    $pdo = db_get_pdo();

    // 특정 숙소 정보를 가져오는 쿼리
    $query = "SELECT * FROM rooms WHERE room_code = :room_code";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':room_code', $room_code, PDO::PARAM_STR);
    $stmt->execute();
    $room = $stmt->fetch(PDO::FETCH_ASSOC);

    // 숙소가 존재하지 않을 경우
    if (!$room) {
        $room = null;
    }
} catch (PDOException $e) {
    die("데이터베이스 오류: " . $e->getMessage());
}

// 수정 요청 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_name = $_POST['room_name'];
    $room_price = $_POST['room_price'];
    $category_large = $_POST['category_large'];
    $category_small = $_POST['category_small'];
    $content_img = $_POST['content_img'];
    $content_img1 = $_POST['content_img1'];
    $content_img2 = $_POST['content_img2'];
    $content_img3 = $_POST['content_img3'];
    $content_img4 = $_POST['content_img4'];

    try {
        // 업데이트 쿼리
        $update_query = "UPDATE rooms 
                         SET room_name = :room_name, room_price = :room_price, category_large = :category_large, 
                             category_small = :category_small, content_img = :content_img, content_img1 = :content_img1, 
                             content_img2 = :content_img2, content_img3 = :content_img3, content_img4 = :content_img4
                         WHERE room_code = :room_code";
        $update_stmt = $pdo->prepare($update_query);
        $update_stmt->bindValue(':room_name', $room_name, PDO::PARAM_STR);
        $update_stmt->bindValue(':room_price', $room_price, PDO::PARAM_STR);
        $update_stmt->bindValue(':category_large', $category_large, PDO::PARAM_STR);
        $update_stmt->bindValue(':category_small', $category_small, PDO::PARAM_STR);
        $update_stmt->bindValue(':content_img', $content_img, PDO::PARAM_STR);
        $update_stmt->bindValue(':content_img1', $content_img1, PDO::PARAM_STR);
        $update_stmt->bindValue(':content_img2', $content_img2, PDO::PARAM_STR);
        $update_stmt->bindValue(':content_img3', $content_img3, PDO::PARAM_STR);
        $update_stmt->bindValue(':content_img4', $content_img4, PDO::PARAM_STR);
        $update_stmt->bindValue(':room_code', $room_code, PDO::PARAM_STR);
        $update_stmt->execute();

        // 업데이트 성공 후 리다이렉트
        header("Location: manager_product.php?message=수정 성공");
        exit();
    } catch (PDOException $e) {
        die("수정 실패: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>숙소 정보 수정</title>
    <link rel="stylesheet" href="css/managerstyle.css">
    <style>
        :root {
            --primary-color: #0070C0;
            --secondary-color: #f9f9f9;
            --text-color: #333;
            --border-color: #ddd;
            --hover-color: #005A9C;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: var(--secondary-color);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .main_wrapper {
            max-width: 600px;
            width: 100%;
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .logo {
            font-size: 32px;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        form {
            width: 100%;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: var(--text-color);
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid var(--border-color);
            border-radius: 5px;
        }

        input[readonly] {
            background-color: #f9f9f9;
            color: #666;
        }

        .button-group {
            display: flex;
            flex-direction: column;
            gap: 15px;
            width: 100%;
            margin-top: 20px;
        }

        button, a {
            width: 100%;
            padding: 12px 0;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
        }

        button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        button:hover {
            background-color: var(--hover-color);
            transform: translateY(-2px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
        }

        a {
            background-color: var(--secondary-color);
            color: var(--primary-color);
            text-decoration: none;
            border: 1px solid var(--primary-color);
        }

        a:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <main class="main_wrapper">
        <div class="logo">STAY</div>
        <?php if ($room): ?>
            <form method="POST">
                <label for="room_code">숙소 코드</label>
                <input type="text" id="room_code" name="room_code" value="<?php echo htmlspecialchars($room['room_code']); ?>" readonly>

                <label for="room_name">숙소명</label>
                <input type="text" id="room_name" name="room_name" value="<?php echo htmlspecialchars($room['room_name']); ?>" required>

                <label for="room_price">판매가</label>
                <input type="number" id="room_price" name="room_price" value="<?php echo htmlspecialchars($room['room_price']); ?>" required>

                <label for="category_large">대분류</label>
                <select id="category_large" name="category_large" required>
                    <option value="hotel" <?php echo $room['category_large'] === '호텔' ? 'selected' : ''; ?>>호텔</option>
                    <option value="motel" <?php echo $room['category_large'] === '모텔' ? 'selected' : ''; ?>>모텔</option>
                    <option value="guesthouse" <?php echo $room['category_large'] === '게스트하우스' ? 'selected' : ''; ?>>게스트하우스</option>
                    <option value="pension" <?php echo $room['category_large'] === '팬션' ? 'selected' : ''; ?>>펜션</option>
                    <option value="resort" <?php echo $room['category_large'] === '리조트' ? 'selected' : ''; ?>>리조트</option>
                    <option value="hostel" <?php echo $room['category_large'] === '호스텔' ? 'selected' : ''; ?>>호스텔</option>
                </select>

                <label for="category_small">소분류</label>
                <select id="category_small" name="category_small">
                    <option value="" <?php echo empty($room['category_small']) ? 'selected' : ''; ?>>선택 안 함</option>
                    <option value="luxury" <?php echo $room['category_small'] === '럭셔리' ? 'selected' : ''; ?>>럭셔리</option>
                    <option value="standard" <?php echo $room['category_small'] === '스탠다드' ? 'selected' : ''; ?>>스탠다드</option>
                    <option value="economy" <?php echo $room['category_small'] === '이코노미' ? 'selected' : ''; ?>>이코노미</option>
                </select>

                <label for="content_img">대표 이미지</label>
                <input type="text" id="content_img" name="content_img" value="<?php echo htmlspecialchars($room['content_img']); ?>" required>

                <label for="content_img1">추가 이미지 1</label>
                <input type="text" id="content_img1" name="content_img1" value="<?php echo htmlspecialchars($room['content_img1']); ?>">

                <label for="content_img2">추가 이미지 2</label>
                <input type="text" id="content_img2" name="content_img2" value="<?php echo htmlspecialchars($room['content_img2']); ?>">

                <label for="content_img3">추가 이미지 3</label>
                <input type="text" id="content_img3" name="content_img3" value="<?php echo htmlspecialchars($room['content_img3']); ?>">

                <label for="content_img4">추가 이미지 4</label>
                <input type="text" id="content_img4" name="content_img4" value="<?php echo htmlspecialchars($room['content_img4']); ?>">

                <div class="button-group">
                    <button type="submit">수정 완료</button>
                    <a href="manager_product.php">목록으로 돌아가기</a>
                </div>
            </form>
        <?php else: ?>
            <p>해당 숙소 정보를 찾을 수 없습니다.</p>
        <?php endif; ?>
    </main>
</body>
</html>
