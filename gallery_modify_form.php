<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Voyage Network : 여행 커뮤니티</title>
	<link rel="icon" href="./img/favicon.png">
	<link rel="stylesheet" type="text/css" href="./css/common.css">
	<link rel="stylesheet" type="text/css" href="./css/board.css">
	<script>
		function check_input() {
			if (!document.board_form.subject.value) {
				alert("제목을 입력하세요!");
				document.board_form.subject.focus();
				return;
			}
			if (!document.board_form.content.value) {
				alert("내용을 입력하세요!");
				document.board_form.content.focus();
				return;
			}
			document.board_form.submit();
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
		<div id="board_box">
			<h3 id="board_title">
				게시판 > 글 쓰기
			</h3>
			<?php
			$num = $_GET["num"];
			$page = $_GET["page"];

			$con = mysqli_connect("localhost", "root", "", "project");

			$sql = "select id from gallery where num=$num";
			$result = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($result);

			// 체크용 쿼리 후 board에 있는 id랑 세션에 등록되어있는 userid가 같으면 수정 작업 수행
			if ($row["id"] == $_SESSION["userid"]) {
				$sql = "select * from gallery where num=$num";
				$result = mysqli_query($con, $sql);
				$row = mysqli_fetch_array($result);

				$name = $row["name"];
				$subject = $row["subject"];
				$content = $row["content"];
				$file_name = $row["file_name"];

				?>

				<form name="board_form" method="post" action="gallery_modify.php?num=<?= $num ?>&page=<?= $page ?>"
					enctype="multipart/form-data">
					<ul id="board_form">
						<li>
							<span class="col1">이름 : </span>
							<span class="col2">
								<?= $name ?>
							</span>
						</li>
						<li>
							<span class="col1">제목 : </span>
							<span class="col2"><input name="subject" type="text" value="<?= $subject ?>"></span>
						</li>
						<li id="text_area">
							<span class="col1">내용 : </span>
							<span class="col2">
								<textarea name="content"><?= $content ?></textarea>
							</span>
						</li>
						<li>
							<span class="col1"> 첨부 파일 : </span>
							<span class="col2">
								<?= $file_name ?>
							</span>
						</li>
					</ul>
					<ul class="buttons">
						<li><button type="button" onclick="check_input()">수정하기</button></li>
						<li><button type="button" onclick="location.href='gallery_list.php'">목록</button></li>
					</ul>
				</form>
			</div> <!-- board_box -->
		</section>
		<footer>
			<?php include "footer.php"; ?>
		</footer>
		<?php
			} else {
				echo "
				<script>
					alert('권한이 없습니다.');
					location.href = 'board_list.php?page=$page';
				</script>
			";
			}
			?>
</body>

</html>