<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>자주 묻는 질문</title>
    <link rel="stylesheet" href="css/hotelqna.css">
    <style>
         .main-page-icon-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .main-page-icon {
            width: 60px;
            height: 60px;
        }
       
        .faq-header {
    text-align: center;
    padding: 15px;
    font-weight: bold;
    font-size: 16px;
    background-color: #ffffff;
    color: #000000;
    border-top-left-radius: 8px;  /* 아래쪽 왼쪽 모서리 둥글게 */
    border-top-right-radius: 8px;
    border-bottom: 2px solid black; 
    }

        .faq-container {
            border: 2px solid #ddd; 
            padding: 20px; 
            margin: 20px auto; 
            background-color: #ffffff; 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); 
            max-width: 1500px; 
            
        }

        .faq-item {
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 10px;
            background-color: #ffffff;
            cursor: pointer;
        }

        .faq-item:hover {
            background-color: #f0f8ff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .faq-answer {
            display: none;
            border: 1px solid #007bff;
            border-radius: 6px;
            padding: 15px;
            margin-top: 10px;
            background-color: #ffffff;
            color: #333;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.3s ease;
        }
        .faq-categories {
    text-align: center;
    padding: 15px;
    font-weight: bold;
    font-size: 14px;
    background-color: #ffffff;
    color: #000000; 
    word-spacing: 10px;
    border-top: none;
}

.faq-categories a {
    color: #000000; 
    text-decoration: none; 
}

.faq-categories a:hover {
    color: #555555;
    text-decoration: underline; 
}

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
/* STAY 중앙 로고 */
.logo_wrapper {
    text-align: center;
    padding: 20px 0;
   
}

.logo_wrapper a {
    font-size: 32px;
    font-weight: bold;
    text-decoration: none;
    color: #0070C0; /* 파란색 */
    transition: color 0.3s ease;
}

.logo_wrapper a:hover {
    color: #0070C0; /* 어두운 파란색 */
}
.main-page-button {
        display: inline-block;
        padding: 12px 20px;
        font-size: 14px;
        color: #fff;
        background-color: #0070c0;
        text-decoration: none;
        border-radius: 6px;
        transition: background-color 0.3s ease;
    position: relative;
    top: 1px;   /* 원래 위치에서 아래로 20px 이동 */
    left: 570px;  /* 원래 위치에서 오른쪽으로 20px 이동 */
    }

    .main-page-button:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>

<div class="logo_wrapper">
    <a href="index.php">STAY</a>
</div>

<div class="faq-container">
    <div class="faq-header">자주 묻는 질문</div>
    
    <div class="faq-categories">
        <a href="qna.php">전체</a>
        <a href="hotelqna.php">숙소</a>
        <a href="memberqna.php">회원</a>
        <a href="couponqna.php">쿠폰</a>
        <a href="payqna.php">결제/영수증</a>
    </div>
    
    <div class="faq-item">[모텔] 취소/환불 규정이 어떻게 되나요?</div>
    <div class="faq-item">[호텔] 취소/환불 규정이 어떻게 되나요?</div>
    <div class="faq-item">예약 내역 조회가 안 돼요.</div>
    <div class="faq-item">천재지변 / 기상악화로 인한 취소는 어떻게 하나요?</div>
    <div class="faq-item">입실할 때 모바일 신분증도 사용할 수 있나요?</div>
    <div class="faq-item">숙소에서 취소를 요청했어요. 환불 받을 수 있나요?</div>
    <div class="faq-item">연박 예약도 할 수 있나요?</div>
    <div class="faq-item">3인 이상 투숙하면 추가 요금이 있나요?</div>
    <div class="faq-item">조식, 수영장 등 부대시설에 대해 궁금한 점이 있어요.</div>
    <div class="faq-item">숙소 연락처를 알고 싶어요</div>
    <div class="faq-item">당일 예약이 가능한가요?</div>
    <div class="faq-item">예약 내역을 삭제할 수 있나요?</div>
    <div class="faq-item">예약 내역 공유는 어떻게 하나요?</div>
    </div>
    <div class="main-page-icon-container">
    <a href="customer.php" class="main-page-button">고객센터</a>
</div>






   
</div>

</body>
</html>
