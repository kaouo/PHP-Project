<?php
$num = $_GET["num"];
$page = $_GET["page"];

$subject = $_POST["subject"];
$content = $_POST["content"];

$con = mysqli_connect("localhost", "root", "", "project");
$sql = "update gallery set subject='$subject', content='$content' ";
$sql .= " where num=$num";
mysqli_query($con, $sql);

mysqli_close($con);

echo "
	      <script>
	          location.href = 'gallery_list.php?page=$page';
	      </script>
	  ";
?>