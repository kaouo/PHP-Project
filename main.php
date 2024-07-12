<div id="main_img_bar">
    <img src="./img/main_img.png">
</div>
<div id="main_content">
    <div id="gallery_latest">
        <h4><a href="gallery_list.php">여행 갤러리</a></h4>
        <ul>
            <!-- 최근 게시 글 DB에서 불러오기 -->
            <?php
            $con = mysqli_connect("localhost", "root", "", "project");
            $sql = "select * from gallery order by num desc limit 3";
            $result = mysqli_query($con, $sql);

            if (!$result)
                echo "게시판 DB 테이블(board)이 생성 전이거나 아직 게시글이 없습니다!";
            else {
                while ($row = mysqli_fetch_array($result)) {
                    $num = $row["num"];
                    $subject = $row["subject"];
                    $username = $row["name"];
                    $hit = $row["hit"];
                    $file_copied = $row["file_copied"];
                    $location = "./data/$file_copied";
                    $regist_day = substr($row["regist_day"], 0, 10);
                    ?>
                    <span class="image_span">
                        <a href="gallery_view.php?num=<?= $num ?>">
                            <img class="image_file" src="<?= $location ?>" alt="<?= $location ?>">
                        </a>
                        <span class="image_info">
                            제목 :
                            <?= $subject ?>
                            <br>
                            작성자 :
                            <?= $username ?>
                            <br>
                        </span>
                    </span>
                    <?php
                }
            }
            ?>
    </div>

    <div id="free_latest">
        <h4><a href="board_list.php">자유 게시판</a></h4>
        <ul>
            <!-- 최근 게시 글 DB에서 불러오기 -->
            <?php
            $con = mysqli_connect("localhost", "root", "", "project");
            $sql = "select * from board order by num desc limit 5";
            $result = mysqli_query($con, $sql);

            if (!$result)
                echo "게시판 DB 테이블(board)이 생성 전이거나 아직 게시글이 없습니다!";
            else {
                while ($row = mysqli_fetch_array($result)) {
                    $num = $row["num"];
                    $regist_day = substr($row["regist_day"], 0, 10);
                    ?>
                    <li>
                        <span>
                            <a href="board_view.php?num=<?= $num ?>">
                                <?= $row["subject"] ?>
                            </a>
                        </span>
                        <span>
                            <?= $row["name"] ?>
                        </span>
                        <span>
                            <?= $regist_day ?>
                        </span>
                    </li>
                    <?php
                }
            }
            ?>
    </div>

</div>