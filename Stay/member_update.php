<?php
// 세션 시작
session_start();

// 세션 확인
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// 데이터베이스 연결
$conn = new mysqli('localhost', 'root', '', 'stay');
if ($conn->connect_error) {
    die("데이터베이스 연결 실패: " . $conn->connect_error);
}

// 세션에서 사용자 ID 가져오기
$user_id = $_SESSION['id'];

// POST 데이터 가져오기
$name = $_POST['name'] ?? null;
$phone = $_POST['phone'] ?? null;
$birth = $_POST['birth'] ?? null;
$email = $_POST['email'] ?? null;
$sns_receive = ($_POST['sns'] ?? '') === 'yes' ? 'yes' : 'no';
$email_receive = ($_POST['email_receive'] ?? '') === 'yes' ? 'yes' : 'no';
$new_password = $_POST['new_password'] ?? null;
$confirm_password = $_POST['confirm_password'] ?? null;

// 입력값 검증
if (empty($name) || empty($phone) || empty($birth) || empty($email)) {
    echo "<script>alert('모든 필드를 입력해주세요.'); history.back();</script>";
    exit();
}

// 새 비밀번호 확인 및 업데이트
$updated_password = false; // 비밀번호 업데이트 여부를 확인하는 플래그

if (!empty($new_password) || !empty($confirm_password)) {
    if ($new_password !== $confirm_password) {
        echo "<script>alert('변경하려는 비밀번호가 일치하지 않습니다.'); history.back();</script>";
        exit();
    }

    // 기존 비밀번호 가져오기
    $password_check_query = "SELECT pass FROM members WHERE id = ?";
    $stmt = $conn->prepare($password_check_query);
    if (!$stmt) {
        die("비밀번호 확인 쿼리 준비 실패: " . $conn->error);
    }

    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $stmt->bind_result($stored_password);
    $stmt->fetch();
    $stmt->close();

    // 기존 비밀번호와 새 비밀번호 비교
    if (password_verify($new_password, $stored_password)) {
        echo "<script>alert('이전 비밀번호로 변경할 수 없습니다.'); history.back();</script>";
        exit();
    }

    // 새 비밀번호 암호화 및 업데이트
    $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
    $password_update_query = "UPDATE members SET pass = ? WHERE id = ?";
    $stmt = $conn->prepare($password_update_query);

    if (!$stmt) {
        die("비밀번호 쿼리 준비 실패: " . $conn->error);
    }

    $stmt->bind_param("ss", $hashed_new_password, $user_id);

    if ($stmt->execute()) {
        $updated_password = true; // 비밀번호 업데이트 성공 플래그 설정
    } else {
        die("비밀번호 업데이트 실패: " . $stmt->error);
    }

    $stmt->close();
}

// 회원 정보 업데이트 쿼리
$sql = "UPDATE members SET name = ?, phone = ?, birth = ?, email = ?, sns_receive = ?, email_receive = ? WHERE id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("회원 정보 쿼리 준비 실패: " . $conn->error);
}

$stmt->bind_param("sssssss", $name, $phone, $birth, $email, $sns_receive, $email_receive, $user_id);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0 || $updated_password) {
        // 회원정보 수정 알림만 출력
        echo "<script>alert('회원 정보가 성공적으로 업데이트되었습니다.'); window.location.href='my-page_member_pwd.php';</script>";
    } else {
        echo "<script>alert('변경된 내용이 없습니다.'); history.back();</script>";
    }
} else {
    die("회원 정보 업데이트 실패: " . $stmt->error);
}

$stmt->close();
$conn->close();
?>
