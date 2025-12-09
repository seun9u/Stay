<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>자주 묻는 질문</title>
    <link rel="stylesheet" href="css/payqna.css">

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
    
 

    <div class="faq-item">결제 비밀번호는 어떻게 변경하나요?</div>
    <div class="faq-item">은행에서 자동 이체 등록 문자가 왔어요.</div>
    <div class="faq-item">카드 영수증은 어디서 발급 받나요?</div>
    <div class="faq-item">예약을 취소 했는데 결제 환불이 되지 않아요.</div>
    <div class="faq-item">숙소 이용내역 증빙자료(예약 내역서)는 어떻게 받나요?</div>
    <div class="faq-item">주문 후 결제 수단을 변경할 수 있나요?    </div>
    <div class="faq-item">결제 할인을 받을 수 있나요?</div>
    <div class="faq-item">결제 수단 할인을 받고 싶은데 할인 적용이 안돼요.</div>
    <div class="faq-item">결제 창에 제가 가지고 있는 카드가 안 보여요.    </div>
    <div class="faq-item">결제 수단별 결제 취소 소요 기간이 궁금해요.    </div>
    <div class="faq-item">휴대전화 소액 결제가 되지 않습니다.    </div>
    <div class="faq-item">결제 요금은 원화인가요?    </div>
    <div class="faq-item">예약할 때마다 결제수단이 달라져요.    </div>
    </div>
    <div class="main-page-icon-container">
    <a href="customer.php" class="main-page-button">고객센터</a>
</div>
</body>
</html>
