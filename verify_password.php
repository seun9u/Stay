<?php
session_start();
require_once("inc/db.php");

// 세션에서 로그인된 사용자 ID 확인
if (!isset($_SESSION['id'])) {
    echo "<script>alert('로그인이 필요합니다.'); window.location.href='login.php';</script>";
    exit();
}

$login_id = $_SESSION['id'];
$login_pw = $_POST['pass_member'] ?? null;

if (!$login_pw) {
    echo "<script>alert('비밀번호를 입력해주세요.'); window.location.href='my-page_member_pwd.php';</script>";
    exit();
}

$member_data = db_select("SELECT * FROM members WHERE id = ?", array($login_id));

if (!$member_data) {
    echo "<script>alert('회원 정보를 찾을 수 없습니다. 다시 로그인하세요.'); window.location.href='login.php';</script>";
    exit();
}

if (!password_verify($login_pw, $member_data[0]['pass'])) {
    echo "<script>alert('비밀번호가 잘못되었습니다.'); window.location.href='my-page_member_pwd.php';</script>";
    exit();
}

// 비밀번호가 일치하면 회원 정보 수정 페이지로 이동
header("Location: my-page_mem_info.php");
exit();
?>
