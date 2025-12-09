<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>자주 묻는 질문</title>
    <link rel="stylesheet" href="css/memberqna.css">
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
    
   

    <div class="faq-item">고객센터와 빠르게 상담하고 싶어요    </div>
    <div class="faq-item">회원 정보 수정은 어떻게 하나요?    </div>
    <div class="faq-item">아이디/비밀번호를 잊어버렸어요.    </div>
    <div class="faq-item">제가 설정한 적 없는 닉네임으로 되어있어요.    </div>
    <div class="faq-item">탈퇴 했는데, 약관 개정 등의 메일이 왔어요    </div>
    <div class="faq-item">탈퇴하고 싶어요    </div>
    <div class="faq-item">과거 예약 기록이나 제 계정 정보를 찾고 싶어요.    </div>
    <div class="faq-item">제 개인정보를 안전하게 보호하려면 어떻게 해야하죠?    </div>
    <div class="faq-item">광고성 메시지 수신 여부를 수정하고 싶어요.    </div>
    <div class="faq-item">회원 가입 할 때 인증 문자가 오지 않아요.    </div>
    <div class="faq-item">탈퇴한 아이디로 재가입 할 수 있나요?    </div>
    <div class="faq-item">로그인이 안돼요.    </div>
    <div class="faq-item">회원/비회원 예약 내역은 어디에서 조회를 할 수 있나요?</div>
    </div>
    <div class="main-page-icon-container">
    <a href="customer.php" class="main-page-button">고객센터</a>
</div>
</body>
</html>
