<?php
session_start();  // 세션 시작

require_once("inc/db.php");

// 현재 로그인된 사용자 ID 가져오기
$login_id = isset($_SESSION['member_id']) ? $_SESSION['member_id'] : null;
$login_pw = isset($_POST['pass_member']) ? $_POST['pass_member'] : null;

if ($login_id == null || $login_pw == null) {
    echo "<script>alert('아이디와 비밀번호를 모두 입력해주세요.'); window.location.href='my-page_member_pwd.php';</script>";
    exit();
}

// 현재 로그인된 사용자의 비밀번호를 데이터베이스에서 가져오기
$member_data = db_select("SELECT * FROM members WHERE id = ?", array($login_id));

// 비밀번호가 일치하지 않으면
if ($member_data == null || count($member_data) == 0) {
    echo "<script>alert('회원 정보를 찾을 수 없습니다.'); window.location.href='my-page_member_pwd.php';</script>";
    exit();
}

// 입력한 비밀번호와 저장된 비밀번호 비교
$is_match_password = password_verify($login_pw, $member_data[0]['pass']);

if ($is_match_password === false) {
    echo "<script>alert('비밀번호가 틀렸습니다.'); window.location.href='my-page_member_pwd.php';</script>";
    exit();
}

// 비밀번호가 맞으면, 다음 페이지로 이동 (예: 정보 수정 페이지)
echo "<script>alert('비밀번호가 확인되었습니다.'); window.location.href='my-page_mem_info.php';</script>";
exit();
?>
