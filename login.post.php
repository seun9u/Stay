<?php
require_once("inc/db.php");
session_start();

// 입력값 검증
$login_id = $_POST['id'] ?? null;
$login_pw = $_POST['password'] ?? null;

if (!$login_id || !$login_pw) {
    echo "<script>alert('아이디와 비밀번호를 모두 입력해주세요.'); window.location.href='login2.php';</script>";
    exit();
}

// 회원 정보 조회
$member_data = db_select("SELECT * FROM members WHERE id = ?", array($login_id));

if (!$member_data || count($member_data) === 0) {
    echo "<script>alert('회원 정보를 찾을 수 없습니다.'); window.location.href='login2.php';</script>";
    exit();
}

// 비밀번호 검증
if (!password_verify($login_pw, $member_data[0]['pass'])) {
    echo "<script>alert('비밀번호가 잘못되었습니다.'); window.location.href='login2.php';</script>";
    exit();
}

// 세션 설정
$_SESSION['id'] = $member_data[0]['id'];
$_SESSION['user_name'] = $member_data[0]['name']; // 추가: 사용자 이름 저장

// 로그인 성공 후 메인 페이지로 리다이렉트
header("Location: index.php");
exit();
?>
