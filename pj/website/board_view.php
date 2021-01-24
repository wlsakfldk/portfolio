<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>게시판 상세보기</title>
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
				<h2>게시판 > 상세 페이지</h2>

<?php
	//http://localhost/website/board_view.php?num=2&page=2

	//만약, 메인 화면으로부터 직접 접근했다면 http://localhost/website/board_view.php?num=2
	/*
	if(isset$_GET["page"]){
		$page=_GET["page"];
	}else{
		$page="";
	}
	*/
	$num = $_GET["num"];
	$page = $_GET["page"];



	include "./db_con.php";
	$sql = "select * from board where num='$num'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);

	$id = $row["id"];
	$name = $row["name"];
	$subject = $row["subject"];
	$content = $row["content"];
	$regist_day = $row["regist_day"];
	$hit = $row["hit"];
	$file_name = $row["file_name"];
	$file_type = $row["file_type"];
	$file_copied = $row["file_copied"];

	$new_hit = $hit + 1;
	$sql = "update board set hit=$new_hit where num='$num'";
	mysqli_query($con, $sql);
?>

				<ul id="view_content">
					<li>
						<span><b>제목 : </b><?=$subject?></span>
						<span><?=$name?> ｜ <?=$regist_day?></span>
					</li>
					<li>
<?php
						if($file_name){
							$real_name = $file_copied;  //데이터 베이스 상에 저장된 진짜 이름(원본 파일명과는 다름)
							$file_path = "./data/".$real_name;  //파일의 위치를 원본 URL(.../website/)로부터 상태 경로를 설정   //localhost/website/data/2020_12_11_12_54.jpg
							$file_size = filesize($file_path);
							//var_dump($file_size);
							
							echo "<div>첨부파일 : $file_name ($file_size Byte) <a class='down' href='board_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>다운로드</a></div>";
						}
?>
						<p><?=$content?></p>
					</li>
				</ul>
				<ul class="buttons">
					<li><button type="button" onclick="location.href='./board_list.php?page=<?=$page?>'">목록</button></li>
<?php
		//세션의 $userid 존재 -> 로그인 상태
		//세션의 $userid와 게시글의 고유번호를 통해 받아온 DB 내의 id가 동일하다면 게시글의 작성자는 로그인 한 사람과 동일인물
		if($userid == $id){
?>
					<li><button type="button" onclick="location.href='./board_modify_form.php?num=<?=$num?>&page=<?=$page?>'">수정</button></li>
					<li><button type="button" onclick="location.href='./board_delete.php?num=<?=$num?>&page=<?=$page?>'">삭제</button></li>
<?php
		}
		//세션의 $userid 존재 -> 로그인 상태
		if($userid){
?>
					<li><button type="button" onclick="location.href='./board_form.php'">작성하기</button></li>
<?php
		}
?>

				</ul>


			</div>




	</section>

	<footer>
			<?php include "./footer.php"; ?>
	</footer>
	
	

</body>
</html>