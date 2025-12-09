<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>자주 묻는 질문</title>
    <link rel="stylesheet" href="css/qna.css">
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
    <div class="faq-answer">
        취소/환불 규정은 다음과 같습니다:
        <ul>
            <li>예약당일은취소불가능합니다.</li>
             <li>취소는예약전날23:59까지 무료취소가능합니다.</li>
             <li>이벤트쿠폰, 할인 쿠폰은환불이불가능합니다.</li>
             <li> 환불규정에따라수수료가발생할수있습니다</li>
    </ul>
    </div>
    <div class="faq-item">[호텔] 취소/환불 규정이 어떻게 되나요?</div>
    <div class="faq-item">아이디/비밀번호를 잊어버렸어요.</div>
    <div class="faq-item">예약을 취소 했는데 결제 환불이 되지 않아요.</div>
    <div class="faq-item">숙소 이용내역 증빙자료(예약 내역서)는 어떻게 받나요?</div>
    <div class="faq-item">미성년자도 이용할 수 있나요?</div>
    <div class="faq-item">과거 예약 기록이나 제 계정 정보를 찾고 싶어요.</div>
    <div class="faq-item">제 개인정보를 안전하게 보호하려면 어떻게 해야하죠?</div>
    <div class="faq-item">예약 내역 조회가 안 돼요.</div>
    <div class="faq-item">회원 가입 할 때 인증 문자가 오지 않아요.</div>
    <div class="faq-item">탈퇴한 아이디로 재가입 할 수 있나요?</div>
    <div class="faq-item"> 로그인이 안돼요.</div>
    <div class="faq-answer">
        로그인이 안 되는 주요 원인은 다음과 같습니다:
        <ul>
            <li>아이디 또는 비밀번호가 잘못 입력되었을 수 있습니다.</li>
            <li>계정이 비활성화되었거나 정지되었습니다.</li>
            <li>인터넷 연결 상태를 확인해주세요.</li>
        </ul>
    </div>
    <div class="faq-item">현금영수증 발급은 어떻게 받나요?</div>
</div>
<div class="main-page-icon-container">
    <a href="customer.php" class="main-page-button">고객센터</a>
</div>
<script>
   document.querySelectorAll('.faq-item').forEach(item => {
        item.addEventListener('click', () => {
            const answer = item.nextElementSibling; // 다음 요소인 .faq-answer 선택
            if (answer.style.display === 'block') {
                // 닫기
                answer.style.display = 'none';
                item.classList.remove('open'); // 화살표 회전 복구
            } else {
                // 다른 열려 있는 항목 닫기
                document.querySelectorAll('.faq-answer').forEach(ans => ans.style.display = 'none');
                document.querySelectorAll('.faq-item').forEach(it => it.classList.remove('open'));

                // 선택한 항목 열기
                answer.style.display = 'block';
                item.classList.add('open');
            }
        });
    }); 
</script>
</body>
</html>
