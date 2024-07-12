<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Voyage Network : 여행 커뮤니티</title>
    <link rel="icon" href="./img/favicon.png">
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/member.css">
    <script>
        function check_input() {
            if (!document.getElementById("uid").value) {
                alert("아이디를 입력하세요!");
                document.getElementById("uid").focus();
                return;
            }

            if (!document.getElementById("pass").value) {
                alert("패스워드를 입력하세요!");
                document.getElementById("pass").focus();
                return;
            }

            if (!document.getElementById("pass_confirm").value) {
                alert("패스워드 확인을 입력하세요!");
                document.getElementById("pass_confirm").focus();
                return;
            }

            if (!document.getElementById("uname").value) {
                alert("이름을 입력하세요!");
                document.getElementById("uname").focus();
                return;
            }

            if (!document.getElementById("bday").value) {
                alert("생년월일을 입력하세요!");
                document.getElementById("bday").focus();
                return;
            }

            if (!document.getElementById("email1").value) {
                alert("이메일 주소를 입력하세요!");
                document.getElementById("email1").focus();
                return;
            }

            if (!document.getElementById("email2").value) {
                alert("이메일 주소를 입력하세요!");
                document.getElementById("email2").focus();
                return;
            }

            if (document.getElementById("pass").value !=
                document.getElementById("pass_confirm").value) {
                alert("패스워드가 일치하지 않습니다.\n다시 입력해 주세요!");
                document.getElementById("pass").focus();
                document.getElementById("pass").select();
                return;
            }

            document.member_form.submit();
        }

        function reset_form() {
            document.member_form.id.value = "";
            document.member_form.pass.value = "";
            document.member_form.pass_confirm.value = "";
            document.member_form.name.value = "";
            document.member_form.bday.value = "";
            document.member_form.email1.value = "";
            document.member_form.email2.value = "";
            document.member_form.id.focus();
            return;
        }

        function check_id() {
            window.open("member_check_id.php?id=" + document.member_form.id.value,
                "IDcheck",
                "left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes");
        }
    </script>
</head>

<body>
    <header>
        <?php include "header.php"; ?>
    </header>
    <section>
        <div id="main_img_bar">
            <img src="./img/main_img.png">
        </div>
        <div id="main_content">
            <div id="join_box">
                <form name="member_form" method="post" action="member_insert.php">
                    <h2>회원 가입</h2>
                    <div class="form id">
                        <div class="col1">아이디</div>
                        <div class="col2">
                            <input type="text" name="id" id="uid">
                        </div>
                        <div class="col3">
                            <a href="#"><img src="./img/check_id.gif" onclick="check_id()"></a>
                        </div>
                    </div>
                    <div class="clear"></div>

                    <div class="form">
                        <div class="col1">비밀번호</div>
                        <div class="col2">
                            <input type="password" name="pass" id="pass">
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form">
                        <div class="col1">비밀번호 확인</div>
                        <div class="col2">
                            <input type="password" name="pass_confirm" id="pass_confirm">
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form">
                        <div class="col1">이름</div>
                        <div class="col2">
                            <input type="text" name="name" id="uname">
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form">
                        <div class="col1">생년월일</div>
                        <div class="col2">
                            <input type="date" name="bday" id="bday">
                            <!-- 날짜 input -->
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form email">
                        <div class="col1">이메일</div>
                        <div class="col2">
                            <input type="text" name="email1" id="email1">@<input type="text" name="email2" id="email2">
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="bottom_line"> </div>
                    <div class="buttons">
                        <input type="button" value="가입하기" onclick="check_input()" name="join">　
                        <input type="reset" value="취소하기" onclick="history.go(-1)">

                    </div>
                </form>

            </div> <!-- join_box -->
        </div> <!-- main_content -->
    </section>
    <footer>
        <?php include "footer.php"; ?>
    </footer>
</body>

</html>