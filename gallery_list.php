<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title> Voyage Network : 여행 커뮤니티</title>
	<link rel="icon" href="./img/favicon.png">
	<link rel="stylesheet" type="text/css" href="./css/common.css">
	<link rel="stylesheet" type="text/css" href="./css/board.css">
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
			<h3>
				여행 갤러리 > 목록보기
			</h3>
			<ul id="board_list">
				<li>
					<form action="gallery_list.php" method="get">
						<select name="sort" class="sort1">
							<option value="01">시간순</option>
							<option value="02">조회수순</option>
						</select>
						<input type="submit" class="sort2" value="정렬">
					</form>
					<!-- select 태그를 이용해서 시간순, 조회수순 중 하나를 선택하고 submit 이벤트가 발생하면 -->
					<!-- select의 value 값을 sort라는 이름을 이용해 GET 방식으로 넘겨주면서 PHP 파일을 다시 호출 -->
				</li>
				<?php
				if (isset($_GET["sort"])) // GET 방식으로 sort라는 값을 받았는지 확인
					$sort = $_GET["sort"]; // 있으면 $sort라는 변수에 저장
				else
					$sort = "01"; // 없으면 "01" 부여
				
				if (isset($_GET["page"]))
					$page = $_GET["page"];
				else
					$page = 1;

				$con = mysqli_connect("localhost", "root", "", "project");
				if ($sort == "01") // $sort 값이 "01"일 경우
					$sql = "select * from gallery order by num desc"; // 만들어진 시간을 기준으로 내림차순 정렬
				else // $sort 값이 "01"이 아닐 경우
					$sql = "select * from gallery order by hit desc"; // 조회수를 기준으로 내림차순 정렬
				
				$result = mysqli_query($con, $sql);
				$total_record = mysqli_num_rows($result); // 전체 글 수
				
				$scale = 9; // 게시판 목록보기
				
				// 전체 페이지 수($total_page) 계산 
				if ($total_record % $scale == 0)
					$total_page = floor($total_record / $scale);
				else
					$total_page = floor($total_record / $scale) + 1;

				// 표시할 페이지($page)에 따라 $start 계산  
				$start = ($page - 1) * $scale;

				$number = $total_record - $start;

				for ($i = $start; $i < $start + $scale && $i < $total_record; $i++) {
					mysqli_data_seek($result, $i);

					// 가져올 레코드로 위치(포인터) 이동
					$row = mysqli_fetch_array($result);

					// 하나의 레코드 가져오기
					$num = $row["num"];
					$id = $row["id"];
					$username = $row["name"];
					$subject = $row["subject"];
					$regist_day = $row["regist_day"];
					$hit = $row["hit"];

					// 시작
					// gallery 테이블에서 추가적으로 file_copied 칼럼도 가져오기
					$file_copied = $row["file_copied"];
					// data가 있는 경로를 지정해서 $location이라는 변수로 받음
					$location = "./data/$file_copied";
					// 끝
				
					if ($row["file_name"])
						$file_image = "<img src='./img/file.gif'>";
					else
						$file_image = " ";
					?>
					<span class="image_span">
						<!-- 사진 출력 부분 -->
						<a href="gallery_view.php?num=<?= $num ?>&page=<?= $page ?>">
							<img class="image_file" src="<?= $location ?>" alt="<?= $location ?>">
						</a>
						<!-- a 태그 안에 img 태그를 넣어서 이미지를 클릭하면 이동할 수 있게 만들었고 -->
						<!-- img의 src 속성으로는 db에서 읽어온 값을 기반으로 한 $location을 넣어서 사진을 출력함 -->
						<span class="image_info">
							제목 :
							<?= $subject ?>
							<br>
							작성자 :
							<?= $username ?>
							<br>
							작성일 :
							<?= $regist_day ?>
							<br>
							조회수 :
							<?= $hit ?>
							<br>
						</span>
					</span>
					<?php
					$number--;
				}
				mysqli_close($con);
				?>
			</ul>
			<ul id="page_num">
				<?php
				if ($total_page >= 2 && $page >= 2) {
					$new_page = $page - 1;
					echo "<li><a href='gallery_list.php?page=$new_page'> ◀ 이전 </a> </li>";
				} else
					echo "<li>&nbsp;</li>";

				// 게시판 목록 하단에 페이지 링크 번호 출력
				for ($i = 1; $i <= $total_page; $i++) {
					if ($page == $i) // 현재 페이지 번호 링크 X
					{
						echo "<li><b> $i </b></li>";
					} else {
						echo "<li><a href='gallery_list.php?page=$i'> $i </a><li>";
					}
				}
				if ($total_page >= 2 && $page != $total_page) {
					$new_page = $page + 1;
					echo "<li> <a href='gallery_list.php?page=$new_page'> 다음 ▶</a> </li>";
				} else
					echo "<li>&nbsp;</li>";
				?>
			</ul>
			<ul class="buttons">
				<li><button onclick="location.href='gallery_list.php'">목록</button></li>
				<li>
					<?php
					if ($userid) {
						?>
						<button onclick="location.href='gallery_form.php'">글쓰기</button>
						<?php
					} else {
						?>
						<a href="javascript:alert('로그인 후 이용해 주세요!')"><button>글쓰기</button></a>
						<?php
					}
					?>
				</li>
			</ul>
		</div>
	</section>
	<footer>
		<?php include "footer.php"; ?>
	</footer>
</body>

</html>