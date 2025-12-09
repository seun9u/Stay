<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // POST 데이터 유효성 검증
    $discount = filter_var($_POST['discount'] ?? 0, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]) ?: 0;
    $finalPrice = filter_var($_POST['finalPrice'] ?? 0, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]) ?: 0;
    $totalQuantity = filter_var($_POST['total_quantity'] ?? ($_SESSION['total_quantity'] ?? 0), FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]) ?: 0;
    $totalPrice = filter_var($_POST['total_price'] ?? ($_SESSION['total_price'] ?? 0), FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]) ?: 0;

    // 할인 값이 유효하지 않은 경우 초기화
    if (!isset($_POST['discount']) || $discount === 0) {
        $_SESSION['discount'] = 0; // 할인 값 초기화
    } else {
        $_SESSION['discount'] = $discount; // 할인 값 설정
    }

    // 최종 결제 금액 설정
    if ($finalPrice === 0) {
        $_SESSION['final_price'] = $totalPrice - $_SESSION['discount'];
    } else {
        $_SESSION['final_price'] = $finalPrice;
    }

    // 세션 값 업데이트
    $_SESSION['total_quantity'] = $totalQuantity;
    $_SESSION['total_price'] = $totalPrice;

    // 응답 반환
    echo json_encode([
        'status' => 'success',
        'updated_values' => [
            'discount' => $_SESSION['discount'],
            'final_price' => $_SESSION['final_price'],
            'total_quantity' => $_SESSION['total_quantity'],
            'total_price' => $_SESSION['total_price']
        ]
    ]);
    exit;
}

