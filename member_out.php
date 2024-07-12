<?php
session_start();

// 세션 시작 후 세션에 userid가 있는지 검사
if (isset($_SESSION["userid"])) {
    $userid = $_SESSION["userid"]; // 있으면 $userid에 넣기
} else { // 없으면 로그인 안 한 거니까 돌아가기
    echo ("
    <script>
    window.alert('잘못된 접근입니다!'); 
    history.go(-1);
    </script>
");
    exit;
}

/*  DB 접속 */
$con = mysqli_connect("localhost", "root", "", "project");

/* 쿼리 작성 */
// members 테이블에서 세션에 등록된 userid와 같은 행이 있으면 그 행 삭제하는 sql문 작성
$sql = "delete from members where id='$userid'";

/* 데이터베이스에 쿼리 전송 */
mysqli_query($con, $sql);


/* 세션 삭제 */
unset($_SESSION["userid"]);
unset($_SESSION["username"]);
unset($_SESSION["userpoint"]);


/* DB(연결) 종료 */
mysqli_close($con);


/* 리디렉션 */
echo "<script> history.go(-1); </script>";
?>