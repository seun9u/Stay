<?php
session_start();

// 로그인 여부 확인
if (!isset($_SESSION['id'])) {
    header("Location: login2.php");
    exit();
}

$user_id = $_SESSION['id'];

// 데이터베이스 연결
$conn = new mysqli("localhost", "root", "", "stay");

// 연결 확인
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// 로그인한 사용자의 장바구니 항목 조회
$stmt = $conn->prepare(
    "SELECT id, content_code, room_name, thumbnail, nights, total_price, created_at 
     FROM cart WHERE user_id = ? ORDER BY created_at DESC"
);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>장바구니</title>
    <link rel="stylesheet" href="cart.css"> <!-- CSS 연결 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery 연결 -->
</head>
<body>
    <h1><a href="index.php" style="text-decoration: none; color: inherit;">STAY</a></h1>

    <div class="cart-container">
        <div class="cart-items">
            <div class="toggle-container">
                <label class="toggle-switch">
                    <input type="checkbox" id="select-all-toggle">
                    <span class="slider"></span>
                </label>
                <span id="toggle-label">전체 선택</span>
            </div>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="cart-item" data-id="<?php echo $row['id']; ?>" data-price="<?php echo $row['total_price']; ?>" data-content-code="<?php echo $row['content_code']; ?>">
                        <input type="checkbox" class="cart-checkbox">
                        <img src="<?php echo htmlspecialchars($row['thumbnail']); ?>" alt="Thumbnail">
                        <div class="cart-item-info">
                            <h2><?php echo htmlspecialchars($row['room_name']); ?></h2>
                            <p class="content-code">숙소 코드: <?php echo htmlspecialchars($row['content_code']); ?></p>
                            <p>₩<span class="item-price"><?php echo number_format($row['total_price']); ?></span> / <?php echo htmlspecialchars($row['nights']); ?>박</p>
                        </div>
                        <div class="cart-item-quantity">
                            <button class="decrease-btn">-</button>
                            <span class="quantity">1</span>
                            <button class="increase-btn">+</button>
                        </div>
                        <button class="cart-item-delete">&times;</button>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>장바구니가 비어 있습니다.</p>
            <?php endif; ?>
        </div>

        <div class="order-summary">
            <h2>주문 정보</h2>
            <table>
                <tr>
                    <th>총 수량</th>
                    <td id="total-quantity">0개</td>
                </tr>
                <tr>
                    <th>총 선택 금액</th>
                    <td id="total-price">₩0</td>
                </tr>
                <tr>
                    <th>환불 수수료</th>
                    <td>무료</td>
                </tr>
                <tr>
                    <th>총 예약 금액</th>
                    <td id="total-order-price">₩0</td>
                </tr>
            </table>
            <div class="order-buttons">
                <button class="reserve-btn">예약하기</button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // 전체 선택 / 해제 기능
            $('#select-all-toggle').change(function() {
                const isChecked = $(this).is(':checked');
                $('.cart-checkbox').prop('checked', isChecked);
                $('#toggle-label').text(isChecked ? '전체 해제' : '전체 선택');
                updateSummary();
            });

            // 수량 증가 기능
            $('.increase-btn').click(function() {
                let quantityElem = $(this).siblings('.quantity');
                let quantity = parseInt(quantityElem.text()) + 1;
                quantityElem.text(quantity);
                updateSummary();
            });

            // 수량 감소 기능
            $('.decrease-btn').click(function() {
                let quantityElem = $(this).siblings('.quantity');
                let quantity = parseInt(quantityElem.text());
                if (quantity > 1) {
                    quantityElem.text(quantity - 1);
                    updateSummary();
                }
            });

            // 항목 삭제 기능 (AJAX)
            $('.cart-item-delete').click(function() {
                let cartItem = $(this).closest('.cart-item');
                let itemId = cartItem.data('id');
                        
                $.ajax({
                    url: 'cart_delete.php',
                    type: 'POST',
                    data: { id: itemId },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            cartItem.remove(); // UI에서 항목 제거
                            updateSummary();   // 요약 정보 업데이트
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function() {
                        alert('삭제 요청 중 오류가 발생했습니다.');
                    }
                });
            });


            // 예약하기 버튼 클릭 시 선택된 항목 데이터 전송
            $('.reserve-btn').click(function() {
                let selectedItems = $('.cart-item').filter(function() {
                    return $(this).find('.cart-checkbox').is(':checked');
                });

                if (selectedItems.length === 0) {
                    alert('예약할 항목을 선택해주세요.');
                    return;
                }

                let contentCode = selectedItems.first().data('content-code');
                let totalPayment = 0;

                selectedItems.each(function() {
                    let quantity = parseInt($(this).find('.quantity').text());
                    let price = parseInt($(this).data('price'));
                    totalPayment += price * quantity;
                });

                window.location.href = `payment.php?content_code=${contentCode}&total_payment=${totalPayment}`;
            });

            // 체크박스 선택에 따른 요약 업데이트
            $('.cart-checkbox').change(updateSummary);

            function updateSummary() {
                let totalQuantity = 0;
                let totalPrice = 0;

                $('.cart-item').each(function() {
                    if ($(this).find('.cart-checkbox').is(':checked')) {
                        let quantity = parseInt($(this).find('.quantity').text());
                        let price = parseInt($(this).data('price'));
                        totalQuantity += quantity;
                        totalPrice += price * quantity;
                    }
                });

                $('#total-quantity').text(totalQuantity + '개');
                $('#total-price').text('₩' + totalPrice.toLocaleString());
                $('#total-order-price').text('₩' + totalPrice.toLocaleString());
            }
        });
    </script>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>
