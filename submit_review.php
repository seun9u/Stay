<?php
// 데이터베이스 연결
$host = 'localhost';
$user = 'root';
$password = ''; // MySQL 비밀번호
$dbname = 'stay'; // 데이터베이스 이름

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("DB 연결 실패: " . $conn->connect_error);
}

// POST 요청 데이터 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $writer_id = $_POST['writer_id'];
    $content_code = $_POST['content_code'];
    $review_contents = $_POST['review_contents'];
    $star = $_POST['star'];
    $photo_paths = []; // 여러 이미지 경로를 저장할 배열

    // 이미지 업로드 처리
    if (!empty($_FILES['photo']['name'][0])) {
        $upload_dir = 'uploads/';
        
        // 디렉토리가 없으면 생성
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        foreach ($_FILES['photo']['tmp_name'] as $key => $tmp_name) {
            if (!empty($tmp_name)) {
                $file_name = time() . '_' . basename($_FILES['photo']['name'][$key]);
                $photo_path = $upload_dir . $file_name;

                if (move_uploaded_file($tmp_name, $photo_path)) {
                    $photo_paths[] = $photo_path; // 성공적으로 업로드된 경로를 배열에 추가
                } else {
                    die("이미지 업로드 실패: " . $_FILES['photo']['name'][$key]);
                }
            }
        }
    }

    // 이미지 경로를 JSON 형식으로 변환
    $photo_paths_json = json_encode($photo_paths);

    // 데이터 저장
    $stmt = $conn->prepare("INSERT INTO review (writer_id, content_code, review_contents, star, photo) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $writer_id, $content_code, $review_contents, $star, $photo_paths_json);

    if ($stmt->execute()) {
        // 저장 성공 시 reviews.php로 이동
        header("Location: reviews.php");
        exit();
    } else {
        die("리뷰 저장 실패: " . $stmt->error);
    }

    $stmt->close();
}

$conn->close();
?>
