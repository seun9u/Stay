<?php
// 세션 시작
session_start();

// 예약번호 확인
$reservationNumber = $_SESSION['reservation_number'] ?? null;
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>예약 완료</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start; /* 상단 정렬 */
            height: 100vh;
        }

        .container {
            margin-top: 20px; /* 상단 여백 추가 */
            text-align: center;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border: 2px solid #0070C0; /* 테두리 색상 변경 */
            max-width: 400px;
            width: 90%;
        }

        .container h1 {
            font-size: 24px;
            color: #0070c0;
            margin-bottom: 20px;
        }

        .container p {
            font-size: 16px;
            color: #555;
            margin-bottom: 30px;
        }

        .reservation-number {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 30px;
        }

        .container a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0070c0;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .container a:hover {
            background-color: #0058a0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>최종 예약이 완료되었습니다!</h1>
        <p>예약이 성공적으로 완료되었습니다.</p>
        <?php if ($reservationNumber): ?>
            <div class="reservation-number">
                예약번호: <?php echo htmlspecialchars($reservationNumber); ?>
            </div>
        <?php else: ?>
            <p>예약번호를 생성하지 못했습니다. 관리자에게 문의해주세요.</p>
        <?php endif; ?>
        <a href="index.php">홈으로 돌아가기</a>
    </div>
</body>
</html>
