<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>STAY</title>
</head>
<body>
<script>
function updateEmailDomain() {
    const emailDropdown = document.getElementById('email3');
    const emailInput = document.getElementById('email2');
    
    if (emailDropdown.value) {
        emailInput.value = emailDropdown.value;
        emailInput.setAttribute('readonly', true);
    } else {
        emailInput.value = '';
        emailInput.removeAttribute('readonly');
    }
}

// STAY 버튼 클릭 시 index.php로 이동
function goToIndex() {
    window.location.href = 'index.php';
}
</script>

    <main class="main_wrapper sign_up">
        <!-- STAY 버튼 클릭 시 index.php로 이동 -->
        <span class="join_us_title" onclick="goToIndex()" style="cursor: pointer;">STAY</span>
        <div class="join_box">
            <form name="member_form" method="POST" action="member_insert.php" class="member_form">
                <div class="member_form_col">
                    <div class="ref">필수입력</div>
                    <div class="member_form_row row1">
                        <div class="form id">
                            <div class="col1">아이디</div>
                            <div class="col2">
                                <input type="text" name="id" placeholder="아이디를 입력하세요.">
                            </div>
                        </div>
                        <div class="clear"></div>

                        <div class="form">
                            <div class="col1">비밀번호</div>
                            <div class="col2">
                                <input type="password" name="pass" placeholder="비밀번호를 입력하세요.">
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form">
                            <div class="col1">비밀번호 재확인</div>
                            <div class="col2">
                                <input type="password" name="pass_confirm" placeholder="비밀번호를 다시 입력하세요.">
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form">
                            <div class="col1">이름</div>
                            <div class="col2">
                                <input type="text" name="name" placeholder="이름을 입력하세요.">
                            </div>
                        </div>
                        <div class="form email">
                        <div class="col1">이메일</div>
                        <div class="col2">
                                <input type="text" name="email1" placeholder="이메일을 입력하세요"> @ 
                                <input type="text" id="email2" name="email2" placeholder="직접입력"> 
                                <select id="email3" name="email3" title="이메일 주소 선택" class="ui_select" onchange="updateEmailDomain()">
                                    <option value="">이메일주소 선택</option>
                                    <option value="naver.com">naver.com</option>
                                    <option value="nate.com">nate.com</option>
                                    <option value="gmail.com">gmail.com</option>
                                    <option value="yahoo.com">yahoo.com</option>
                                </select>
                            </div>
                        </div>

                        
                        <div class="form">
                            <div class="col1">생년월일</div>
                            <div class="col2">
                                <input type="text" name="birth" placeholder="생일을 입력하세요">
                            </div>
                        </div>
                        <div class="form">
                            <div class="col1">휴대전화</div>
                            <div class="col2">
                                <input type="text" name="phone" placeholder="-없이 휴대전화번호 입력하세요">
                            </div>
                        </div>

                        <!-- 수정: 수신 여부를 예/아니오 라디오 버튼으로 변경 -->
                        <div class="form">
                            <div class="col1">SNS 수신 여부</div>
                            <div class="col2">
                                <input type="radio" name="sns_receive" id="sns_yes" value="yes">
                                <label for="sns_yes">예</label>
                                <input type="radio" name="sns_receive" id="sns_no" value="no">
                                <label for="sns_no">아니오</label>
                            </div>
                        </div>
                        <div class="form">
                            <div class="col1">이메일 수신 여부</div>
                            <div class="col2">
                                <input type="radio" name="email_receive" id="email_yes" value="yes">
                                <label for="email_yes">예</label>
                                <input type="radio" name="email_receive" id="email_no" value="no">
                                <label for="email_no">아니오</label>
                            </div>
                        </div>
                        <!-- 수정 끝 -->

                    </div>
                </div>
            </form>
        </div>
        <section>
            <button class="button_join" onclick="check_input()">가입</button>
            <button class="button_cancel" onclick="window.location.href='login2.php'">취소</button>
        </section>

    </main>

    <script src="js/member.js"></script>
</body>
</html>
