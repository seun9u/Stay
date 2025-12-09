<?php
require_once("inc/db.php");

// 현재 페이지 가져오기 (기본값: 1)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// 한 페이지에 표시할 항목 수
$limit = 7;

// 시작 지점 계산
$offset = ($page - 1) * $limit;

// 최신 작성된 순서대로 데이터 가져오기
$query = "SELECT * FROM rooms ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
try {
    $result = db_select($query);

    if (!$result) {
        die("데이터를 가져오는데 실패했습니다. 쿼리: $query");
    }
} catch (Exception $e) {
    die("Error fetching data: " . $e->getMessage());
}

// 총 데이터 개수 가져오기
$total_query = "SELECT COUNT(*) as total FROM rooms";
try {
    $total_result = db_select($total_query);

    if (!$total_result || !isset($total_result[0]['total'])) {
        die("총 개수를 가져오는데 실패했습니다. SQL: $total_query");
    }

    $total_items = (int)$total_result[0]['total'];
    $total_pages = ceil($total_items / $limit);
} catch (Exception $e) {
    die("Error fetching total count: " . $e->getMessage());
}

// 높은 가격순으로 정렬된 데이터 가져오기 (필요 시 유지)
$query_price_h = "SELECT * FROM rooms ORDER BY room_price DESC LIMIT $limit OFFSET $offset";
try {
    $result_price_H = db_select($query_price_h);
} catch (Exception $e) {
    $result_price_H = [];
    error_log("Error fetching high price data: " . $e->getMessage());
}

// 낮은 가격순으로 정렬된 데이터 가져오기 (필요 시 유지)
$query_price_l = "SELECT * FROM rooms ORDER BY room_price ASC LIMIT $limit OFFSET $offset";
try {
    $result_price_L = db_select($query_price_l);
} catch (Exception $e) {
    $result_price_L = [];
    error_log("Error fetching low price data: " . $e->getMessage());
}

// 디버깅용 로그 출력 (옵션)
if (isset($_GET['debug'])) {
    echo "<pre>";
    echo "Query: $query\n";
    echo "Result:\n";
    print_r($result);
    echo "</pre>";
}
?>
