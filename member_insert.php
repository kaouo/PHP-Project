<?php
$id = $_POST["id"];
$pass = $_POST["pass"];
$name = $_POST["name"];
$bday = $_POST["bday"];
$email1 = $_POST["email1"];
$email2 = $_POST["email2"];

$email = $email1 . "@" . $email2;
$regist_day = date("Y-m-d (H:i)"); // 현재의 '년-월-일-시-분'을 저장


$con = mysqli_connect("localhost", "root", "", "project");

$sql = "insert into members(id, pass, name, bday, email, regist_day, point) ";
$sql .= "values('$id', '$pass', '$name', '$bday', '$email', '$regist_day', 0)";

mysqli_query($con, $sql); // $sql 에 저장된 명령 실행
mysqli_close($con);

echo "
	      <script>
	          location.href = 'index.php';
	      </script>
	  ";
?>