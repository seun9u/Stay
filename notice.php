
<?php
include_once 'inc/db.php'; 

$pdo = db_get_pdo(); 

try {
    
    $sql = "SELECT * FROM notices ORDER BY created_at DESC"; 
    $stmt = $pdo->query($sql);
    $notices = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("데이터를 가져오는 중 오류 발생: " . $e->getMessage());
}
?>


<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>공지사항</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .back {
            position: absolute;
            left: 10px;
            top: 10px;
            text-decoration: none;
            font-size: 18px;
            color: #333;
        }

        .notices {
            margin: 20px;
            padding: 0;
            list-style: none;
        }

        .notices li {
            padding: 15px 10px;
            border-bottom: 1px solid #ddd;
            font-size: 16px;
        }

        .notices li a {
            text-decoration: none;
            color: #333;
        }

        .notices li a:hover {
            color: #0070C0;
        }
        .custom img {
    width: 24px;
    height: 24px;
}
    </style>
</head>
<body>
<div class="custom">
    <a href="customer.php">
        <img src="arrow.png" alt="고객센터">
    </a>
</div>
    <div class="header">공지사항</div>
    <ul class="notices">
        <?php if (!empty($notices)): ?>
            <?php foreach ($notices as $notice): ?>
                <li>
                    <a href="notice_detail.php?id=<?= htmlspecialchars($notice['id']) ?>">
                        [공지] <?= htmlspecialchars($notice['title']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>등록된 공지사항이 없습니다.</li>
        <?php endif; ?>
    </ul>
</body>
</html>



