<?php
session_start();

// 로그인 여부 확인
if (!isset($_SESSION['id'])) {
    header("Location: login2.php");
    exit();
}

// 로그인된 사용자 ID
$user_id = $_SESSION['id'];

// 데이터베이스 연결
$conn = new mysqli("localhost", "root", "", "stay");

// 연결 확인
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// 필터 조건 처리
$reservation_date = $_GET['reservation_date'] ?? null;
$customer_name = $_GET['customer_name'] ?? null;

// 기본 쿼리 작성
$query = "SELECT reservation_code, content_code, customer_name, customer_phone, total_payment, created_at 
          FROM reservation WHERE user_id = ?";

// 조건 추가
$params = [$user_id];
$types = "s";

if ($reservation_date) {
    $query .= " AND DATE(created_at) = ?";
    $params[] = $reservation_date;
    $types .= "s";
}

if ($customer_name) {
    $query .= " AND customer_name LIKE ?";
    $params[] = "%" . $customer_name . "%";
    $types .= "s";
}

$query .= " ORDER BY created_at DESC";

// 쿼리 실행
$stmt = $conn->prepare($query);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>예약 조회</title>
    <style>
        /* 초기화 */
        body, h1, table, th, td, input, button {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Noto Sans KR', sans-serif;
        }

        body {
            background-color: #f9f9f9;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

.header {
    display: flex;
    align-items: center;
    justify-content: center; /* 타이틀을 중앙에 위치 */
    margin-bottom: 20px;
    position: relative; /* 홈 아이콘 위치 고정을 위해 추가 */
}

.header .home-icon {
    font-size: 24px;
    color: #0070C0;
    text-decoration: none;
    position: absolute; /* 아이콘을 타이틀의 왼쪽에 고정 */
    left: 0; /* 컨테이너의 왼쪽에 고정 */
}

.header .home-icon:hover {
    color: #005c99;
}

h1 {
    font-size: 24px;
    color: #0070C0;
    margin: 0;
    text-align: center;
}


        .filters {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .filters div {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .filters label {
            font-size: 12px;
            margin-bottom: 5px;
        }

        .filters input {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 200px;
        }

        .filters button {
            background-color: #0070C0;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            margin-top: 22px;
        }

        .filters button:hover {
            background-color: #005c99;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #0070C0;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        td {
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Section with Home Icon -->
        <div class="header">

            <a href="index.php" class="home-icon">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 12L12 3L21 12"></path>
        <path d="M9 21V14H15V21"></path>
        <path d="M19 21H5C4.44772 21 4 20.5523 4 20V10.5858C4 10.2107 4.15804 9.851 4.43934 9.60967L11.4393 3.60967C11.7691 3.32607 12.2309 3.32607 12.5607 3.60967L19.5607 9.60967C19.842 9.851 20 10.2107 20 10.5858V20C20 20.5523 19.5523 21 19 21Z"></path>
    </svg>
</a>

            <h1>예약 조회</h1>
        </div>
        
        <!-- Filters Section -->
        <form method="GET" class="filters">
            <div>
                <label for="reservation_date">예약 날짜</label>
                <input type="date" id="reservation_date" name="reservation_date" value="<?= htmlspecialchars($reservation_date ?? '') ?>">
            </div>
            <div>
                <label for="customer_name">예약자 이름</label>
                <input type="text" id="customer_name" name="customer_name" placeholder="예약자 이름 입력" value="<?= htmlspecialchars($customer_name ?? '') ?>">
            </div>
            <div>
                <button type="submit">검색</button>
            </div>
        </form>
        
        <!-- Table Section -->
        <table>
            <thead>
                <tr>
                    <th>예약번호</th>
                    <th>숙소 코드</th>
                    <th>예약자 이름</th>
                    <th>전화번호</th>
                    <th>결제 금액</th>
                    <th>예약 날짜</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['reservation_code']); ?></td>
                        <td><?php echo htmlspecialchars($row['content_code']); ?></td>
                        <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['customer_phone']); ?></td>
                        <td>₩<?php echo number_format($row['total_payment']); ?></td>
                        <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>
