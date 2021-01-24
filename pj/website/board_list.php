<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>게시판 리스트</title>
	<link rel="stylesheet" href="./css/common.css">
	<link rel="stylesheet" href="./css/board.css">
</head>
<body>
	<header>
		<?php include "./header.php"?>
	</header>

	<section>
			<div id="main_img_bar" class="subpage">
					<div class="main_img_cont">
							<div class="frame">
									<div class="main_img_txt">
											<div class="main_img_title">
													<h3>100% Free <span>Online Courses</span></h3>
													<h1>Get Future's Skills Today!</h1>

											</div>
									</div>
							</div>
					</div>
			</div>

			<div id="board_box">
				<h2 id="board_title">게시판 > 리스트</h2>
				<ul id="board_list">
					<li>
						<span class="field_1">번호</span>
						<span class="field_2">제목</span>
						<span class="field_3">작성자</span>
						<span class="field_4">첨부</span>
						<span class="field_5">작성일</span>
						<span class="field_6">조회수</span>
					</li>

<?php
	if(isset($_GET["page"])){  //하단의 페이지 넘버 또는 이전/다음을 클릭시
		$page = $_GET["page"];
	}else{  //메뉴로부터 접근시
		$page = 1;
	}

	include "./db_con.php";
	$sql = "select * from board order by num desc";  //최근 게시물을 가장 상단에서부터 가져오기 위한 조건을 형성
	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result);  //게시글의 행이 몇 개인지를 체크

	$scale = 10;  //각 페이지별로 10개씩만 보여준다.

	//전체 페이지 수를 계산
	if($total_record % $scale == 0){  //10의 배수일 경우
		$total_page = $total_record / $scale;
	}else{  //10의 배수가 아닐 경우
		$total_page = floor($total_record / $scale) + 1;
	}
	//floor() : 내림, ceil() : 올림, round() : 반올림

	//표시할 페이지에 첫번째 보여줄 리스트의 시작 번호
	$start = ($page - 1) * $scale;
	//1번 페이지일 경우, (1 - 1) * 10 = 0~
	//2번 페이지일 경우, (2 - 1) * 10 = 10~
	//3번 페이지일 경우, (3 - 1) * 10 = 20~
	$number = $total_record - $start;  
	//첫번째 페이지의 시작 번호는 전체 데이터의 개수와 동일


	for($i = $start; $i < $start + $scale && $i < $total_record; $i++){
		mysqli_data_seek($result, $i);  //가져올 레코드의 위치로 이동(pager를 클릭시 해당하는 결과값을 가져오는데, 각 인덱스번호로 접근하여 가져오기 위함)
		$row = mysqli_fetch_array($result);
		$num = $row["num"];  //상세페이지에서 각 해당하는 데이터 값들을 가져오게할 수 있는 게시물의 고유 번호
		$id = $row["id"];
		$name = $row["name"];
		$subject = $row["subject"];
		$regist_day = $row["regist_day"];
		$hit = $row["hit"];
		if($row["file_name"]){  //DB에 첨부파일이 존재한다면 이미지를 보여준다.
			$file_name = "<img src='./img/file.gif'>";
		}else{  //DB에 첨부파일이 존재하지 않다면 이미지 보여주지 않는다.
			$file_name = "";
		}
		//var_dump($row);
?>
					<li>
						<span class="field_1"><?=$number?></span>
						<span class="field_2"><a href="./board_view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></span>
						<span class="field_3"><?=$name?></span>
						<span class="field_4"><?=$file_name?></span>
						<span class="field_5"><?=$regist_day?></span>
						<span class="field_6"><?=$hit?></span>
					</li>
<?php
		$number--;
	}
	mysqli_close($con);
?>


				</ul>
				<ul id="page_num">
<?php
	if($total_page >= 2 && $page >= 2){
		$new_page = $page - 1;
		echo "<li><a href='board_list.php?page=$new_page'>◀ 이전</a></li>";
	}else{  //현재 페이지가 1번인 경우, 전체 페이지가 하나 밖에 없는 경우
		echo "<li>&nbsp;</li>";
	}

	for($i=1; $i<=$total_page; $i++){
		if($page == $i){
			echo "<li><span class='cur_page'> $i </span></li>";
		}else{
			echo "<li><a href='board_list.php?page=$i'> $i </a></li>";
		}
	}

	if($total_page >= 2 && $page != $total_page){
		$new_page = $page + 1;
		echo "<li><a href='board_list.php?page=$new_page'>다음 ▶</a></li>";
	}else{
		echo "<li>&nbsp;</li>";
	}
?>
				</ul>
<?php
	if($userid){
?>
				<ul class="buttons">
					<li><button type="button" onclick="location.href='./board_form.php'">작성하기</button></li>
				</ul>
				<!--만약 로그인 상태라면 작성하기 버튼을 보여준다.-->
<?php
	}
?>

			</div>


	</section>

	<footer>
			<?php include "./footer.php"; ?>
	</footer>

</body>
</html>