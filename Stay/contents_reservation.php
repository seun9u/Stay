<?php


// 세션 시작
session_start();

// POST 요청 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['total_quantity']) && isset($_POST['total_price'])) {
        $_SESSION['total_quantity'] = intval($_POST['total_quantity']);
        $_SESSION['total_price'] = intval($_POST['total_price']);
    }
}

// 세션에서 총 수량과 총 결제 금액 가져오기
$totalQuantity = $_SESSION['total_quantity'] ?? 0;
$totalPrice = $_SESSION['total_price'] ?? 0;
$discount = isset($_SESSION['discount']) ? $_SESSION['discount'] : 0;
if (empty($_POST['coupon_id']) && empty($_SESSION['selected_coupon'])) {
    $_SESSION['discount'] = 0; // 쿠폰이 선택되지 않았을 경우 할인 초기화
}
$finalPrice = $totalPrice - $discount;



// 세션에서 로그인된 사용자 ID 가져오기
$member_id = $_SESSION['member_id'];

// 데이터베이스 연결
$host = "localhost"; // 데이터베이스 호스트
$user = "root"; // MySQL 사용자
$password = ""; // MySQL 비밀번호
$dbname = "stay"; // 데이터베이스 이름

$conn = new mysqli($host, $user, $password, $dbname);

// 연결 오류 확인
if ($conn->connect_error) {
    die("데이터베이스 연결 실패: " . $conn->connect_error);
}

// 세션에서 가져오기 (POST 데이터가 없으면 세션 값 유지)
$totalQuantity = isset($_POST['total_quantity']) ? intval($_POST['total_quantity']) : ($_SESSION['total_quantity'] ?? 0);
$totalPrice = isset($_POST['total_price']) ? intval($_POST['total_price']) : ($_SESSION['total_price'] ?? 0);

// 세션 값 업데이트
$_SESSION['total_quantity'] = $totalQuantity;
$_SESSION['total_price'] = $totalPrice;

// 쿠폰 목록 가져오기
$sqlCoupons = "SELECT id, coupon_name, discount_rate FROM coupons WHERE member_id = '$member_id' AND is_used = 0";
$resultCoupons = $conn->query($sqlCoupons);

if (!$resultCoupons) {
    die("쿠폰 조회 실패: " . $conn->error);
}


// 선택된 옵션 처리
$selectedOptions = [];
for ($i = 1; $i <= 4; $i++) {
    $optionNameKey = "option_{$i}_name";
    $optionDescriptionKey = "option_{$i}_description";
    $optionQuantityKey = "option_{$i}_quantity";
    $optionPriceKey = "option_{$i}_price";

    // 옵션 데이터가 존재하면 배열에 추가
    if (isset($_POST[$optionQuantityKey]) && intval($_POST[$optionQuantityKey]) > 0) {
        $selectedOptions[] = [
            'name' => $_POST[$optionNameKey] ?? '알 수 없는 옵션',
            'description' => $_POST[$optionDescriptionKey] ?? '설명이 없습니다.', // 키가 없으면 기본값
            'quantity' => intval($_POST[$optionQuantityKey]),
            'price' => intval($_POST[$optionPriceKey]),
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>예약 확인</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .top-bar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 60px;
            background-color: #ffffff;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: transparent;
            color: #000;
            font-size: 30px;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }

        .back-btn:hover {
            color: #333;
        }

.coupon-wrapper {
    display: grid;
    grid-template-columns: 2fr 1fr; /* 열 비율: 쿠폰 리스트 2칸, 버튼 1칸 */
    gap: 10px; /* 각 요소 간 간격 */
    margin-top: 10px; /* 상단과 간격 */
}

/* 쿠폰 드롭다운 스타일 */
#coupon-dropdown {
    grid-column: span 2; /* 두 칸을 차지 */
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 5px;
    width: 100%; /* 드롭다운 전체 너비 */
}

/* 적용 버튼 스타일 */
.apply-btn {
    grid-column: span 1; /* 한 칸 차지 */
    width: 100%;
    background-color: #0070c0;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px;
    font-size: 14px;
    cursor: pointer;
    text-align: center;
}

.apply-btn:hover {
    background-color: #3A88D8;
}

/* 발급 가능한 쿠폰 보기 버튼 스타일 */
.issue-btn {
    grid-column: span 1; /* 한 칸 차지 */
    width: 100%;
    background-color: #ff8000;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px;
    font-size: 14px;
    cursor: pointer;
    text-align: center;
}

.issue-btn:hover {
    background-color: #cc6600;
}


        .container {
            margin: 80px auto;
            width: 90%;
            max-width: 600px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .box {
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }

        .box:last-child {
            border-bottom: none;
        }

        .box-title {
            font-weight: bold;
            margin-bottom: 10px;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        ul li {
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        ul li button {
            background-color: #0070c0;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
            font-size: 12px;
        }

        ul li button:hover {
            background-color: #0058a0;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
        }

        .input-group label {
            margin-bottom: 5px;
            font-size: 14px;
        }

        .input-group input {
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .agreement {
            font-size: 14px;
            margin-top: 15px;
        }

        .agreement input[type="checkbox"] {
            margin-right: 10px;
        }

        .final-btn {
            width: 100%;
            padding: 15px;
            font-size: 18px;
            font-weight: bold;
            color: white;
            background-color: #0070c0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .final-btn:hover {
            background-color: #0058a0;
        }

        .payment-options button {
            width: 100%;
            padding: 15px;
            font-size: 16px;
            font-weight: bold;
            margin: 5px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .payment-options .kakao {
            background-color: #ffeb3b;
            color: black;
        }

        .payment-options .naver {
            background-color: #1ec800;
            color: white;
        }

        .payment-options .card,
        .payment-options .account {
            background-color: #0070c0;
            color: white;
        }
    </style>
</head>
<body>
    <div class="top-bar">
        <a href="contents_detail.php" class="back-btn">&lt;</a>
        <div class="top-bar-title">예약 확인</div>
    </div>

    <div class="container">
        <!-- 총 예약 정보 -->
        <div class="box">
            <div class="box-title">예약 정보</div>
            <ul>
                <?php foreach ($selectedOptions as $option): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($option['name']); ?></strong><br>
                        <span style="color: gray;"><?php echo htmlspecialchars($option['description']); ?></span><br>
                        <?php echo intval($option['quantity']); ?>개 
                        (₩<?php echo number_format($option['price']); ?>)
                    </li>
                <?php endforeach; ?>
                <li><strong>총 수량:</strong> <?php echo $totalQuantity; ?>개</li>
                <li><strong>총 결제 금액:</strong> ₩<?php echo number_format($totalPrice); ?></li>
            </ul>
        </div>

        <!-- 예약자 정보 -->
<div class="box">
    <div class="box-title">예약자 정보</div>
    <div class="input-group">
        <label for="name">성명</label>
        <input type="text" id="name" placeholder="홍길동">
    </div>
    <div class="input-group">
        <label for="phone">전화번호</label>
        <input type="text" id="phone" placeholder="010-1234-5678">
    </div>
</div>

<!-- 쿠폰 적용 -->
<div class="box">
    <div class="box-title">쿠폰 적용</div>
    <div class="coupon-wrapper">
        <!-- 쿠폰 선택 리스트 -->
        <select id="coupon-dropdown">
            <option value="" data-discount="0">쿠폰을 선택하세요</option>
            <?php
            if ($resultCoupons->num_rows > 0):
                while ($row = $resultCoupons->fetch_assoc()):
            ?>
            <option value="<?php echo htmlspecialchars($row['id']); ?>" data-discount="<?php echo $row['discount_rate']; ?>">
                <?php echo htmlspecialchars($row['coupon_name']); ?> (<?php echo intval($row['discount_rate']); ?>% 할인)
            </option>
            <?php
                endwhile;
            else:
            ?>
            <option value="">사용 가능한 쿠폰이 없습니다</option>
            <?php endif; ?>
        </select>
        <!-- 적용 버튼 -->
        <button onclick="applyCoupon()" class="apply-btn">적용</button>
        <!-- 발급 가능한 쿠폰 보기 버튼 -->
        <button onclick="location.href='coupon_issue.php'" class="issue-btn">발급 가능한 쿠폰 보기</button>
    </div>
    <div id="coupon-message" style="color: red; margin-top: 10px;"></div>
</div>

<!-- 결제 금액 -->
<div class="box">
    <div class="box-title">결제 금액</div>
    <ul>
        <li>
            <strong>상품 금액:</strong>
            <span id="original-price">₩<?php echo number_format($totalPrice); ?></span>
        </li>
        <li>
            <strong>쿠폰 할인 금액:</strong>
            <span id="discount-price">₩<?php echo number_format($discount); ?></span>
        </li>
        <li>
            <strong>총 결제 금액:</strong>
            <span id="final-price">₩<?php echo number_format($finalPrice); ?></span>
        </li>
    </ul>
</div>



        <!-- 결제 수단 -->
        <div class="box payment-options">
            <div class="box-title">결제 수단</div>
            <button class="kakao">카카오페이</button>
            <button class="naver">네이버페이</button>
            <button class="card">신용/체크카드</button>
            <button class="account">간편 계좌 결제</button>
        </div>

        <!-- 이용 약관 확인 -->
        <div class="box agreement">
            <label>
                <input type="checkbox" id="agree-all"> 전체 동의
            </label>
            <ul>
                <li>
                    <label>
                        <input type="checkbox" class="agree-item"> 이용 약관 동의
                    </label>
                    <button onclick="showTerms('terms')">내용 보기</button>
                </li>
                <li>
                    <label>
                        <input type="checkbox" class="agree-item"> 개인정보 수집 동의
                    </label>
                    <button onclick="showTerms('privacy')">내용 보기</button>
                </li>
            </ul>
        </div>

        <!-- 최종 결제 버튼 -->
        <button class="final-btn">₩<?php echo number_format($totalPrice); ?> 결제하기</button>
        
    </div>

    <script>

    let totalPrice = <?php echo $totalPrice; ?>; // 상품 총 금액
    let discount = 0; // 할인 금액 초기값

    // 쿠폰 적용 함수
function applyCoupon() {
    const couponDropdown = document.getElementById("coupon-dropdown");
    const selectedOption = couponDropdown.options[couponDropdown.selectedIndex];
    const discountRate = parseInt(selectedOption.getAttribute("data-discount")) || 0;

    if (!discountRate) {
        alert("쿠폰을 선택하세요.");
        return; // 선택되지 않은 경우 요청 중단
    }

    const discount = Math.floor((totalPrice * discountRate) / 100);
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "update_session.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(`discount=${discount}&finalPrice=${totalPrice - discount}`);


    // 금액 업데이트
    updatePrices();
}



 // 금액 업데이트 함수
    function updatePrices() {
    const discountPriceElement = document.getElementById("discount-price");
    const finalPriceElement = document.getElementById("final-price");

    // 할인 금액 및 최종 결제 금액 계산
    discountPriceElement.textContent = `₩${discount.toLocaleString()}`;
    finalPriceElement.textContent = `₩${(totalPrice - discount).toLocaleString()}`;

    console.log("최종 금액 업데이트 완료:", totalPrice - discount);
}




        // 약관 동의 체크 로직
        document.getElementById("agree-all").addEventListener("change", function () {
            const isChecked = this.checked;
            document.querySelectorAll(".agree-item").forEach(function (checkbox) {
                checkbox.checked = isChecked;
            });
        });

        // 약관 내용 보기 함수
        function showTerms(type) {
            let content = '';
            if (type === 'terms') {
                content = `
                    <h3>이용 약관</h3>
                    <p>본 약관은 서비스 이용에 관한 규정을 담고 있습니다. 회원은 이를 준수해야 합니다.</p>
                    <p>- 제1조: 목적</p>
                    <p>- 제2조: 서비스 제공</p>
                    <p>- 제3조: 회원의 의무</p>
                `;
            } else if (type === 'privacy') {
                content = `
                    <h3>개인정보 수집 및 이용</h3>
                    <p>본 서비스는 아래와 같은 목적을 위해 개인정보를 수집 및 이용합니다.</p>
                    <p>- 성명, 전화번호 등 예약 처리</p>
                    <p>- 법적 의무 준수를 위한 기록 보관</p>
                `;
            }

            const popup = window.open("", "popup", "width=400,height=400,scrollbars=yes");
            popup.document.write(`
                <html>
                    <head>
                        <title>약관 내용</title>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                padding: 20px;
                                line-height: 1.6;
                            }
                            h3 {
                                color: #0070c0;
                            }
                            button {
                                margin-top: 20px;
                                padding: 10px 20px;
                                background-color: #0070c0;
                                color: white;
                                border: none;
                                cursor: pointer;
                                border-radius: 5px;
                            }
                            button:hover {
                                background-color: #0058a0;
                            }
                        </style>
                    </head>
                    <body>
                        ${content}
                        <button onclick="window.close()">닫기</button>
                    </body>
                </html>
            `);
        }

        document.querySelector(".final-btn").addEventListener("click", function () {
            const agreeItems = document.querySelectorAll(".agree-item");
            let allChecked = true;
            agreeItems.forEach(function (checkbox) {
                if (!checkbox.checked) {
                    allChecked = false;
                }
            });

            if (!allChecked) {
                alert("모든 약관에 동의해야 결제가 가능합니다.");
                return;
            }

            // 약관 동의가 완료되었을 때 success.php로 이동
            window.location.href = "success.php";
        });
    </script>
</body>
</html>
