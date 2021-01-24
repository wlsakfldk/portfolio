<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>메시지 답장 보내기</title>
	<link rel="stylesheet" href="./css/common.css">
	<link rel="stylesheet" href="./css/message.css">
</head>
<body>
	<header>
		<?php include "./header.php";?>
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

		<div id="message_box">
			<h2>메시지 답장 보내기</h2>
<?php
	//http://localhost/website/message_response_form.php?num=16
	$num = $_GET["num"];

	include "./db_con.php";
	$sql = "select * from message where num='$num'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	$send_id = $row["send_id"];
	$rv_id = $row["rv_id"];
	$subject = $row["subject"];
	$content = $row["content"];

	//답글 제목의 좌측에 "RE: " 표기
	//내용 "-----Original Message------" 표기
	$subject = "RE : ".$subject;
	$content = "\n\n\n  -----Original Message-----  \n".$content;

	$result2 = mysqli_query($con, "select name from members where id='$send_id'");
	$record = mysqli_fetch_array($result2);
	$send_name = $record["name"];
?>
			<form name="message_form" action="message_insert.php?send_id=<?=$userid?>" method="post">
						<div id="write_msg">
								<ul>
										<li>
												<div class="label">
														<label for="id">보내는 사람</label>
												</div>
												<div class="input">
														<p><?=$userid?></p>
												</div>
										</li>
										<li>
												<div class="label">
														<label for="rv_id">받는 사람(아이디)</label>
												</div>
												<div class="input">
														<p><?=$send_name?>(<?=$send_id?>)</p><!--나의 입장에서 수신함으로부터 진입했기 때문에 보낸 사람은 상대방-->
														<input type="hidden" name="rv_id" value="<?=$send_id?>">
														<!--message.js(값의 유무를 체크)와 message_insert.php(값을 POST 방식으로 받아오라고 명령이 되어있음)에서 현재 입력상자를 체크 중임. value 값을 넣어 놓고, 사용자에게는 보이지 않도록 물리적 UI를 감춘다.-->
												</div>
										</li>
										<li>
												<div class="label">
														<label for="subject">제목</label>
												</div>
												<div class="input">
														<input type="text" name="subject" value="<?=$subject?>">
												</div>
										</li>
										<li>
												<div class="label">
														<label for="content">내용</label>
												</div>
												<div class="input">
														<textarea name="content" cols="" rows=""><?=$content?></textarea>
												</div>
										</li>
								</ul>
								<button class="send_btn" type="button" onclick="check_input();">답장 보내기</button>
						</div>
				</form>


		</div>
	
	</section>
	<footer>
			<?php include "./footer.php"; ?>
	</footer>

	<script src="./js/message.js"></script>
</body>
</html>