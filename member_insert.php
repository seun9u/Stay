<?php
// 데이터 검증 함수
function validateInput($input) {
    return isset($input) && trim($input) !== '';
}

// POST 요청 데이터 가져오기
$id           = $_POST["id"];
$pass         = $_POST["pass"];
$name         = $_POST["name"];
$phone        = $_POST["phone"];
$birth        = $_POST["birth"];
$email1       = $_POST["email1"];
$email2       = $_POST["email2"];
$sns_receive  = isset($_POST["sns_receive"]) ? $_POST["sns_receive"] : 'no'; // 기본값 'no'
$email_receive = isset($_POST["email_receive"]) ? $_POST["email_receive"] : 'no'; // 기본값 'no'

// 이메일 주소 조합
$email = $email1 . "@" . $email2;

// 데이터 검증
if (!validateInput($id) || !validateInput($pass) || !validateInput($name) || !validateInput($phone) || !validateInput($birth) || !validateInput($email1) || !validateInput($email2)) {
    echo "
        <script>
            alert('모든 필수 입력값을 채워주세요.');
            history.back();
        </script>
    ";
    exit;
}

// 데이터베이스 연결
$con = mysqli_connect("localhost", "root", "", "stay");

if (!$con) {
    echo "
        <script>
            alert('데이터베이스 연결 실패: " . mysqli_connect_error() . "');
            history.back();
        </script>
    ";
    exit;
}

// 중복 ID 확인
$id = mysqli_real_escape_string($con, $id); // SQL 인젝션 방지
$sql = "SELECT id FROM members WHERE id = '$id'";
$result = mysqli_query($con, $sql);

// ID 중복 시 경고 메시지 표시
if (mysqli_num_rows($result) > 0) {
    echo "
        <script>
            alert('이미 사용 중인 아이디입니다. 다른 아이디를 입력해주세요.');
            history.back();
        </script>
    ";
    mysqli_close($con);
    exit;
}

// 비밀번호 암호화
$bcrypt_pw = password_hash($pass, PASSWORD_BCRYPT);

// 나머지 데이터 SQL 인젝션 방지
$name = mysqli_real_escape_string($con, $name);
$phone = mysqli_real_escape_string($con, $phone);
$birth = mysqli_real_escape_string($con, $birth);
$email = mysqli_real_escape_string($con, $email);
$sns_receive = mysqli_real_escape_string($con, $sns_receive);
$email_receive = mysqli_real_escape_string($con, $email_receive);

// 회원 정보 삽입 쿼리 작성
$sql = "INSERT INTO members (id, pass, name, phone, birth, email, sns_receive, email_receive) ";
$sql .= "VALUES ('$id', '$bcrypt_pw', '$name', '$phone', '$birth', '$email', '$sns_receive', '$email_receive')";

// 쿼리 실행 및 에러 처리
if (!mysqli_query($con, $sql)) {
    echo "
        <script>
            alert('회원가입 실패: " . mysqli_error($con) . "');
            history.back();
        </script>
    ";
    mysqli_close($con);
    exit;
}

// 데이터베이스 연결 닫기
mysqli_close($con);

// 성공 메시지와 리디렉션
echo "
    <script>
        alert('회원가입이 성공적으로 완료되었습니다!');
        location.href = 'login2.php';
    </script>
";
?>
