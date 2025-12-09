<?php
session_start();

// 데이터베이스 연결 및 함수 포함
require_once 'inc/db.php';

// 로그인한 사용자 정보 가져오기
$user_id = $_SESSION['id'] ?? null;

// 세션이 없는 경우 로그인 페이지로 리다이렉트
if (!$user_id) {
    header("Location: login.php");
    exit();
}

// 사용자 정보 초기화
$customer_name = '';
$customer_phone = '';

if ($user_id) {
    // 사용자 정보 조회
    $user = db_select("SELECT name, phone FROM members WHERE id = :id", ['id' => $user_id]);
    if ($user && count($user) > 0) {
        $customer_name = $user[0]['name'];
        $customer_phone = $user[0]['phone'];
    } else {
        die("사용자 정보를 가져오는 데 실패했습니다.");
    }
}

// 숙소 정보 가져오기
$room_code = htmlspecialchars($_GET['content_code'] ?? '');
$room_name = '';
$total_payment = htmlspecialchars($_GET['total_payment'] ?? 0);

if ($room_code) {
    // 숙소 정보 조회
    $room = db_select("SELECT room_name FROM rooms WHERE room_code = :room_code", ['room_code' => $room_code]);
    if ($room && count($room) > 0) {
        $room_name = $room[0]['room_name'];
    } else {
        die("해당 숙소 정보를 찾을 수 없습니다.");
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>결제 화면</title>
    <link rel="stylesheet" href="payment.css">
</head>
<body>
    <div class="payment-container">
        <div class="header">
            <h1>결제 화면</h1>
        </div>

        <div class="reservation-summary">
            <h2>예약 정보</h2>
            <p><?php echo htmlspecialchars($room_name); ?></p>
            <p>총 결제 금액: ₩<?php echo number_format($total_payment); ?></p>
        </div>

        <div class="payment-form">
            <h2>결제 정보</h2>
            <form action="payment_complete.php" method="POST">
                <input type="hidden" name="content_code" value="<?php echo htmlspecialchars($room_code); ?>">
                <input type="hidden" name="total_payment" value="<?php echo htmlspecialchars($total_payment); ?>">

                <label for="customer-name">예약자 이름:</label>
                <input type="text" id="customer-name" name="customer_name" value="<?php echo htmlspecialchars($customer_name); ?>" required>

                <label for="customer-phone">전화번호:</label>
                <input type="text" id="customer-phone" name="customer_phone" value="<?php echo htmlspecialchars($customer_phone); ?>" required>

                <label for="card-number">카드 번호:</label>
                <input type="text" id="card-number" name="card_number" placeholder="1234-5678-9012-3456" required pattern="\d{4}-\d{4}-\d{4}-\d{4}">

                <label for="expiration-date">유효 기간:</label>
                <input type="text" id="expiration-date" name="expiration_date" placeholder="MM/YY" required pattern="\d{2}/\d{2}">

                <label for="cvv">CVC:</label>
                <input type="text" id="cvv" name="cvv" placeholder="123" required pattern="\d{3}">

                <!-- 동의 섹션 -->
                <div class="terms">
                    <h3>결제 전 동의 사항</h3>
                    <div class="terms-container">
                        <!-- 전체 동의 -->
                        <div class="terms-item">
                            <input type="checkbox" id="agree-all">
                            <label for="agree-all"><strong>전체 동의</strong></label>
                        </div>

                        <!-- 이용 약관 동의 -->
                        <div class="terms-item individual-terms">
                            <input type="checkbox" id="agree-terms">
                            <label for="agree-terms">이용 약관 동의</label>
                            <a href="#" class="view-button" data-target="terms-modal">내용 보기</a>
                        </div>

                        <!-- 개인정보 보호정책 동의 -->
                        <div class="terms-item individual-terms">
                            <input type="checkbox" id="agree-privacy">
                            <label for="agree-privacy">개인정보 보호정책 동의</label>
                            <a href="#" class="view-button" data-target="privacy-modal">내용 보기</a>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn">결제하기</button>
            </form>
        </div>
    </div>

    <!-- 약관 모달 -->
    <div id="terms-modal" class="modal hidden">
        <div class="modal-content">
            <h2>이용 약관</h2>
            <p>제 1조 (목적)<br>
본 약관은 [서비스명] (이하 '회사')가 제공하는 [서비스명] (이하 '서비스')의 이용에 관한 조건 및 절차, 회사와 이용자 간의 권리, 의무, 책임사항을 규정함을 목적으로 합니다.</p>

<p>제 2조 (이용 계약의 성립)<br>
이용 계약은 이용자가 본 약관에 동의하고, 회사가 제공하는 서비스에 접속하여 회원 가입을 완료함으로써 성립됩니다.<br>
이용자는 약관 동의 후 회원가입을 통해 서비스를 이용할 수 있습니다.</p>

<p>제 3조 (회원의 의무)<br>
1. 회원은 서비스 이용 중 다음 각 호의 행위를 하여서는 안 됩니다.<br>
- 타인의 개인정보를 도용하는 행위<br>
- 서비스를 악용하여 불법적인 활동을 하는 행위<br>
- 회사의 시스템에 악영향을 미치는 행위<br>
2. 회원은 자신의 계정을 타인에게 양도하거나 대여할 수 없습니다.</p>

<p>제 4조 (분쟁 해결)<br>
1. 본 약관과 관련된 분쟁이 발생할 경우, 회사와 이용자는 우선적으로 합의를 통해 해결하도록 노력합니다.<br>
2. 합의가 이루어지지 않을 경우, 서울중앙지방법원을 제1심 법원으로 합니다.</p>
            <button class="close-modal">닫기</button>
        </div>
    </div>

    <!-- 개인정보 보호정책 모달 -->
    <div id="privacy-modal" class="modal hidden">
        <div class="modal-content">
            <h2>개인정보 보호정책</h2>
            <p>[회사명] (이하 '회사')는 이용자의 개인정보를 중요하게 생각하며, 개인정보 보호법을 준수하고 있습니다. 본 개인정보 보호정책은 회사가 수집하는 개인정보의 항목, 이용 목적, 보유 및 이용 기간, 제3자 제공 등의 내용에 대해 설명합니다. 이용자는 본 정책을 숙지하고 동의함으로써 회사의 서비스 이용에 대한 개인정보 처리 방침에 동의하게 됩니다.</p>

<p>제 1조 (개인정보의 수집 및 이용 목적)
회사는 다음과 같은 목적을 위해 개인정보를 수집하고 이용합니다.<br>

1. 회원가입 및 관리: 서비스 제공을 위한 사용자 식별, 회원가입 및 탈퇴 관리<br>
2. 서비스 제공: 서비스 제공 및 이용에 따른 정보 제공, 예약 확인 및 알림<br>
3. 고객 지원 및 서비스 개선: 고객 문의 응대 및 서비스 개선을 위한 피드백 수집<br>
4. 마케팅 및 광고: 맞춤형 서비스 제공을 위한 통계 분석 및 광고 목적으로 개인정보를 사용할 수 있습니다.</p>

<p>제 2조 (수집하는 개인정보의 항목)
회사는 서비스를 제공하기 위해 다음과 같은 개인정보를 수집합니다.<br>

1. 회원가입 시:<br>
	- 필수 항목: 이름, 이메일 주소, 전화번호, 생년월일 등<br>
	- 선택 항목: 성별, 주소 등<br>
2. 서비스 이용 시:<br>
	- 서비스 이용 기록, 접속 로그, 쿠키, IP 주소 등<br>
3. 결제 및 거래 관련 정보:<br>
	- 카드 번호, 결제 기록, 배송지 주소 등</p>

<p>제 3조 (개인정보의 보유 및 이용 기간)<br>
1. 회원 가입 및 관리에 관한 개인정보는 회원 탈퇴 시까지 보유합니다.<br>
2. 서비스 이용 기록 및 결제 관련 개인정보는 관련 법령에 따라 일정 기간 보유합니다.<br>
3. 법령에 의한 보유: 법률에 의한 의무 이행을 위해 필요한 개인정보는 관련 법령에서 정한 기간 동안 보유합니다.</p>
            <button class="close-modal">닫기</button>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // 전체 동의 기능
        const agreeAllCheckbox = document.getElementById('agree-all');
        const individualCheckboxes = document.querySelectorAll('.individual-terms input');

        agreeAllCheckbox.addEventListener('change', function () {
            individualCheckboxes.forEach(checkbox => {
                checkbox.checked = agreeAllCheckbox.checked;
            });
        });

        // 개별 동의 체크 상태에 따라 전체 동의 업데이트
        individualCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                agreeAllCheckbox.checked = Array.from(individualCheckboxes).every(cb => cb.checked);
            });
        });

        // 모달 열기
        document.querySelectorAll('.view-button').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                document.getElementById(this.dataset.target).classList.remove('hidden');
            });
        });

        // 모달 닫기
        document.querySelectorAll('.close-modal').forEach(button => {
            button.addEventListener('click', function () {
                this.closest('.modal').classList.add('hidden');
            });
        });
    </script>
</body>
</html>
