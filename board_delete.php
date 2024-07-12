<?php

session_start();

$num = $_GET["num"];
$page = $_GET["page"];

$con = mysqli_connect("localhost", "root", "", "project");

$sql = "select id from board where num = $num";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);

// 체크용 쿼리 후 board에 있는 id랑 세션에 등록되어있는 userid가 같으면 삭제 작업 수행
if ($row["id"] == $_SESSION["userid"]) {
	$sql = "select * from board where num = $num";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);

	$copied_name = $row["file_copied"];

	if ($copied_name) {
		$file_path = "./data/" . $copied_name;
		unlink($file_path);
	}

	$sql = "delete from board where num = $num";
	mysqli_query($con, $sql);
	mysqli_close($con);

	echo "
	     <script>
	         location.href = 'board_list.php?page=$page';
	     </script>
	   ";
} else {
	echo "
			<script>
				alert('권한이 없습니다.');
				location.href = 'board_list.php?page=$page';
			</script>
		";
}