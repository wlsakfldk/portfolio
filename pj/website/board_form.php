<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>게시판 작성</title>
	<link rel="stylesheet" href="./css/common.css">
	<link rel="stylesheet" href="./css/board.css">
</head>
<body>
	<header>
		<?php include "./header.php"?>
	</header>
<?php
	//유입경로 : 메뉴 "게시판"을 클릭 -> 게시판 리스트("게시글 작성"의 버튼 유무 조건은 로그인 상태에서 보여준다.) -> 게시판 작성하기
	/*
	if(!$userid){
		echo ("
			<script>
				alert('로그인 후 이용 바랍니다.');
				location.href='./login_form.php';
			</script>
		");
	}
	*/
	//위의 경로를 타고 들어온다는 조건이 성립된다면 현재 구문을 삭제한다.
?>
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
				<h2 id="board_title">게시판 > 작성</h2>
				<!--
						데이터를 전송하는 방식(method)에는 get 방식과 post 방식 + enctype 속성의 multipart/form-data
						get 방식은 URL 창에 폼의 데이터가 노출되는 방식. 입력내용에 대한 길이 제한이 존재 (256~4096byte 데이터를 전송 가능)
						post 방식은 URL 창에 폼의 데이터가 노출되지 않는 방식. 입력내용에 대한 길이 제한은 없음. 보낼 수있는 데이터의 양은 한계가 반드시 존재. 이를 보완하고자 큰 용량의 파일이나 데이터 전송간 문제점이 발생하지 않도록 폼 태그 내부에 enctype="multipart/form-data" 추가하면 문제점이 발생하지 않음. (이미지 파일은 1x1 Pixel 4byte의 데이터 값을 갖고 있음.  4byte/pixel)
				-->

				<form name="board_form" action="board_insert.php" method="post" enctype="multipart/form-data">
					<ul id="board_form">
						<li>
							<div class="label">
								<label>이름 : </label>
							</div>
							<div class="input">
								<p><?=$userid?></p>
							</div>
						</li>
						<li>
							<div class="label">
								<label for="subject">제목 : </label>
							</div>
							<div class="input">
								<input type="text" name="subject">
							</div>
						</li>
						<li>
							<div class="label">
								<label for="content">내용 : </label>
							</div>
							<div class="input">
								<textarea name="content"></textarea>
							</div>
						</li>
						<li>
							<div class="label">
								<label for="upfile">첨부파일 : </label>
							</div>
							<div class="input">
								<input type="file" class="upload" name="upfile">
							</div>
						</li>
					</ul>

					<ul class="buttons">
						<li><button type="button" onclick="check_input();">작성 완료</button></li>
						<li><button type="button" onclick="location.href='board_list.php'">목록 보기</button></li>
					</ul>
				</form>
			</div>
	</section>

	<footer>
			<?php include "./footer.php"; ?>
	</footer>



	<script src="./js/board.js"></script>
</body>
</html>