<?php
include_once 'inc/db.php';

$pdo = db_get_pdo();

// GET 요청으로 글 ID 가져오기
$inquiry_id = $_GET['inquiry_id'] ?? null;

// POST 요청으로 비밀번호 확인
$password_attempt = $_POST['password'] ?? null;

try {
    if ($inquiry_id) {
        $sql = "SELECT id, userid, inquiry_title, inquiry_type, content, created_at, admin_response, password FROM onetoone WHERE id = :inquiry_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':inquiry_id', $inquiry_id, PDO::PARAM_INT);
        $stmt->execute();
        $inquiry = $stmt->fetch(PDO::FETCH_ASSOC);

        // POST 요청 처리 (비밀번호 검증)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($inquiry) {
                // 암호화된 비밀번호 또는 평문 비교
                if (password_verify($password_attempt, $inquiry['password'])) {
                    $access_granted = true;
                } else if ($password_attempt === $inquiry['password']) {
                    $access_granted = true;
                } else {
                    $error_message = "비밀번호가 올바르지 않습니다.";
                }
            } else {
                $error_message = "존재하지 않는 문의입니다.";
            }
        }
    } else {
        $sql = "SELECT id, userid, inquiry_title, inquiry_type, created_at FROM onetoone ORDER BY created_at DESC";
        $stmt = $pdo->query($sql);
        $inquiries = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    die("데이터를 가져오는 중 오류 발생: " . $e->getMessage());
}

?>


<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>문의 관리</title>
    <link rel="stylesheet" href="css/onetoone.css">
</head>
<body>
<style>


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


/* 이미지 스타일 */
.custom img {
    width: 30px;  /* 크기 약간 확대 */
    height: 30px;
    object-fit: contain; /* 이미지 비율 유지 */
}

/* 기본 body 스타일 */
body {
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f7fc;
    color: #333;
}

/* 헤더 스타일 */
h1 {
    text-align: center;
    line-height: 100px;
    margin: 0;
    height: 100px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 32px;
    color: #333;
    background-color: #ffffff;
    text-transform: uppercase;
    font-weight: bold;
}

/* 테이블 스타일 */
table {
    margin: 20px auto; 
    width: 80%;        
    text-align: center;
    border-collapse: collapse;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}


table th, table td {
    padding: 12px;
    font-size: 16px;
    color: #333;
    border-bottom: 1px solid #ddd;
}

table th {
    background-color: #ffffff;
    color: #000000;
    text-transform: uppercase;
    font-weight: bold;
}



/* 푸터 스타일 */
.footer {
    text-align: right;
    margin-top: 20px;
    font-size: 14px;
    color: #777;
}

/* 등록 버튼 스타일 */
.btn-register {
    display: inline-block;
    background-color: #0070c0;
    color: white;
    text-decoration: none;
    padding: 12px 18px;
    border-radius: 4px;
    font-size: 16px;
    font-weight: bold;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.btn-register:hover {
    background-color: #0056b3;
    transform: translateY(-2px);
}

.btn-register:focus {
    outline: none;
    box-shadow: 0 0 0 2px rgba(0, 112, 192, 0.5);
}


/* 버튼 컨테이너 스타일 */
.button-container {
    text-align: right;   /* 우측 정렬 */
    margin-top: 10px;    /* 테이블과의 간격 */
    padding-right: 10%;  /* 테이블과 동일한 여백 맞춤 (조정 가능) */
}

/* que 버튼 스타일 */
.btn-que {
    display: inline-block;
    background-color: #0070c0;
    color: white;
    text-decoration: none;
    padding: 12px 18px;
    border-radius: 6px;
    font-size: 18px;
    font-weight: bold;
  
}

/* 버튼 호버 효과 */
.btn-que:hover {
    background-color: #0056b3;
    
}


/* 중앙 텍스트 스타일 */
.center-text {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50vh;
    font-size: 18px;
    color: #555;
    font-weight: 400;
    text-align: center;
    background-color: #e9ecef;
    padding: 20px;
    border-radius: 8px;
}








/*문의 상세 css */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #ffffff;
    margin: 0;
    padding: 0;
    color: #333;
}

/* 문의 상세 영역 스타일 */
#inquiry-details {
    max-width: 900px;
    margin: 40px auto;
    background-color: #ffffff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    background: #ffffff;
}

/* 제목 스타일 */
#inquiry-details h1 {
    font-size: 32px;
    color: #333;
    margin-bottom: 20px;
    font-weight: bold;
    text-align: center;
}

/* 문의 제목 스타일 */
#inquiry-details h2 {
    font-size: 24px;
    margin-bottom: 15px;
    color: #0070c0;
    font-weight: 600;
    border-bottom: 2px solid #0070c0; /* 제목과 내용 구분 */
    padding-bottom: 10px;
}

/* 각 항목 스타일 (문의 제목, 내용, 작성일 등) */
#inquiry-details p {
    font-size: 16px;
    line-height: 1.8;
    margin: 12px 0;
    color: #000000;
    border-bottom: 1px solid #ddd; /* 각 항목 구분을 위한 선 추가 */
    padding-bottom: 10px;
}

/* 문의 유형, 내용, 작성일 스타일 */
#inquiry-details strong {
    font-weight: bold;
    color: #333;
}

/* 답변 섹션 */
#inquiry-details h3 {
    font-size: 20px;
    color: #0070c0;
    margin-top: 30px;
    font-weight: 600;
    border-bottom: 2px solid #0070c0;
    padding-bottom: 10px;
}

/* 관리자 답변이 있을 경우, 답변 박스 스타일 */
#inquiry-details .admin-response {
    background-color: #ffffff;
    padding: 20px;
    border: 2px solid #0070c0;
    border-radius: 8px;
    margin-top: 20px;
    font-size: 16px;
    line-height: 1.6;
    color: #333;
}

/* 관리자 답변이 없을 경우 */
#inquiry-details p strong {
    color: #000000; /* 빨간색 경고 색상 */
    font-weight: bold;
    font-size: 16px;
}

/* 돌아가기 버튼 스타일 */
.btn-back {
    display: inline-block;
    padding: 12px 25px;
    background-color: #0070c0;
    color: #ffffff;
    text-decoration: none;
    border-radius: 5px;
    font-size: 18px;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease;
    margin-top: 30px;
    align-self: flex-end;
}

/* 버튼 호버 효과 */
.btn-back:hover {
    background-color: #0056b3;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

/* 버튼 포커스 효과 */
.btn-back:focus {
    outline: none;
    border: 2px solid #0056b3;
}



/*비밀번호 */
/* 비밀번호 확인 폼 스타일 */
#password-form {
    max-width: 400px;
    margin: 50px auto;
    padding: 30px;
    background-color: #ffffff;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    text-align: center;
}

/* 비밀번호 확인 폼 제목 스타일 */
#password-form h1 {
    font-size: 24px;
    color: #333;
    margin-bottom: 20px;
}

/* 입력 필드 스타일 */
#password-form input[type="password"] {
    width: 80%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    box-sizing: border-box;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

#password-form input[type="password"]:focus {
    border-color: #0070c0;
    box-shadow: 0 0 5px rgba(0, 112, 192, 0.5);
    outline: none;
}
/* 비밀번호 입력 필드 그룹 스타일 */
#password-form .form-group {
    margin-bottom: 20px;
    text-align: center;
}

/* 오류 메시지 스타일 */
#password-form .error-message {
    margin-top: 5px;
    color: #ff4d4f; /* 빨간색 */
    font-size: 14px;
    font-weight: bold;
}


/* 버튼 스타일 */
#password-form button[type="submit"] {
    display: inline-block;
    width: 86%;
    padding: 12px;
    background-color: #0070c0;
    color: #ffffff;
    font-size: 18px;
    font-weight: bold;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

#password-form button[type="submit"]:hover {
    background-color: #0056b3;
    transform: translateY(-2px);
}

#password-form button[type="submit"]:focus {
    outline: none;
    box-shadow: 0 0 0 2px rgba(0, 112, 192, 0.5);
}

/* 취소 버튼 스타일 */
#password-form .btn-back {
    display: inline-block;
    width: 80%;
    padding: 12px;
    margin-top: 10px;
    background-color: #ccc;
    color: #333;
    text-align: center;
    font-size: 18px;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

#password-form .btn-back:hover {
    background-color: #b3b3b3;
    transform: translateY(-2px);
}




        </style>

<div class="logo_wrapper">
    <a href="index.php">STAY</a>
</div>

<?php if ($inquiry_id && isset($inquiry)): ?>
    <?php if (isset($access_granted) && $access_granted): ?>
        <!-- 비밀번호 인증 성공 후 상세 보기 -->
        <div id="inquiry-details">
            <h1>문의 상세 내용</h1>
            <h2><?= htmlspecialchars($inquiry['inquiry_title']) ?></h2>
            <p><strong>작성자:</strong> <?= htmlspecialchars($inquiry['userid'] ?? '익명') ?></p>
            <p><strong>문의 유형:</strong> <?= htmlspecialchars($inquiry['inquiry_type']) ?></p>
            <p><strong>문의 내용:</strong> <?= nl2br(htmlspecialchars($inquiry['content'])) ?></p>
            <p><strong>작성일:</strong> <?= date('Y-m-d', strtotime($inquiry['created_at'])) ?></p>

            <?php if (!empty($inquiry['admin_response'])): ?>
                <h3>관리자 답변</h3>
                <p><?= nl2br(htmlspecialchars($inquiry['admin_response'])) ?></p>
            <?php else: ?>
                <p><strong>관리자 답변:</strong> 아직 답변이 없습니다.</p>
            <?php endif; ?>

            <a href="onetoone.php" class="btn-back">목록으로 돌아가기</a>
        </div>
    <?php else: ?>
        <div id="password-form">
    <h1>비밀번호 확인</h1>
    <form action="onetoone.php?inquiry_id=<?= htmlspecialchars($inquiry_id) ?>" method="post">
        <div class="form-group">
            <label for="password"></label>
            <input type="password" name="password" id="password" required>
            <?php if (!empty($error_message)): ?>
                <p class="error-message"><?= htmlspecialchars($error_message) ?></p>
            <?php endif; ?>
        </div>
        <button type="submit">확인</button>
        <a href="onetoone.php" class="btn-back">취소</a>
    </form>
</div>

    <?php endif; ?>
<?php else: ?>
    <!-- 전체 글 목록 -->
    <div id="inquiry-list">
        <h1>문의 목록</h1>
        <table>
            <thead>
                <tr>
                    <th>문의 제목</th>
                    <th>문의 유형</th>
                    <th>작성자</th>
                    <th>작성일</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($inquiries)): ?>
                    <?php foreach ($inquiries as $inquiry): ?>
                        <tr>
                            <td>
                                <a href="onetoone.php?inquiry_id=<?= htmlspecialchars($inquiry['id']) ?>">
                                    <?= htmlspecialchars($inquiry['inquiry_title']) ?>
                                </a>
                            </td>
                            <td><?= htmlspecialchars($inquiry['inquiry_type']) ?></td>
                            <td><?= htmlspecialchars($inquiry['userid'] ?? '익명') ?></td>
                            <td><?= date('Y-m-d', strtotime($inquiry['created_at'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">문의 내역이 없습니다.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="button-container">
            <a href="ctc.php" class="btn-que">문의하기</a>
        </div>
    </div>
<?php endif; ?>

</body>
</html>