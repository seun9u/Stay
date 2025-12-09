<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>고객센터</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
        }
        .main-page-icon-container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .main-page-icon {
            width: 200px; 
            height: 120px; 
        }
        
        .container {
            width: 300px;
            text-align: center;
            margin-top: 20px;
        }
        h1 {
            font-size: 40px;
            margin: 0;
            padding: 10px 0;
            border-bottom: 2px solid #ccc;
        }
        h2 {
            font-size: 20px;
            color: #333;
            margin: 20px 0;
        }
        .grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr); 
        gap: 10px; 
        justify-content: center; 
        align-items: center; 
        }
        .grid-item {
        border: 1px solid #ccc;
        width: 150px; /* 너비를 고정 */
        height: 150px; /* 높이를 너비와 동일하게 고정 */
        background-color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 20px;
        color: #333;
        text-decoration: none;
        }

        .grid-item:hover {
            
            background-color: #e0e0e0;
        }
        
    </style>
</head>
<body>

</div>
<div class="main-page-icon-container">
    <a href="index.php">
        <img src="home.png" alt="메인 페이지로 돌아가기" class="main-page-icon">
    </a>
</div>
<div class="container">
    <h1>고객센터</h1>
    <h2>무엇을 도와드릴까요?</h2>
    <div class="grid">
        <a href="notice.php" class="grid-item">공지사항</a>
        <a href="ctc.php" class="grid-item">1:1문의</a>
        <a href="qna.php" class="grid-item">자주 묻는 질문</a>
        <a href="onetoone.php" class="grid-item">1:1문의 내역</a>
        <a href="" class="grid-item">고객상담센터</a>
        <a href="" class="grid-item">카카오톡 문의</a>
    </div>
</div>

</body>
</html>
