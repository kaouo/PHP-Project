<?php
session_start();
if (isset($_SESSION["userid"]))
    $userid = $_SESSION["userid"];
else
    $userid = "";
if (isset($_SESSION["username"]))
    $username = $_SESSION["username"];
else
    $username = "";
if (isset($_SESSION["userlevel"]))
    $userlevel = $_SESSION["userlevel"];
else
    $userlevel = "";
if (isset($_SESSION["userpoint"]))
    $userpoint = $_SESSION["userpoint"];
else
    $userpoint = "";
?>
<div id="top">
    <h3>
        <!-- 홈페이지 제목 -->
        <a href="index.php">Voyage Network<br></a>
    </h3>
    <h4>
        <!-- 홈페이지 부제목 -->
        여행자들을 연결시키다
    </h4>
    <ul id="top_menu">
        <?php
        if (!$userid) {
            ?>
            <li><a href="member_form.php">회원 가입</a> </li>
            <li> 　|　 </li>
            <li><a href="login_form.php">로그인</a></li>
            <?php
        } else {
            $logged = "<b>" . $username . "(" . $userid . ")</b>님 환영합니다! [Point:" . $userpoint . "]";
            ?>
            <li>
                <?= $logged ?>
            </li>
            <br>
            <li><a href="logout.php">로그아웃</a></li>
            <li> | </li>
            <li><a href="member_modify_form.php">회원 정보 수정</a></li>
            <?php
        }
        ?>
        <?php
        if ($userlevel == 1) {
            ?>
            <li> | </li>
            <li><a href="admin.php">관리자 모드</a></li>
            <?php
        }
        ?>
    </ul>
</div>
<div id="menu_bar">
    <ul>
        <li><a href="index.php">HOME</a></li>
        <li><a href="message_form.php">MESSAGE</a></li>
        <li><a href="gallery_list.php">GALLERY</a></li>
        <li><a href="board_list.php">BOARD</a></li>
    </ul>
</div>