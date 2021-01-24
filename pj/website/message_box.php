<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>메시지 리스트</title>
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
			<h2>
<?php
				//message_box.php?mode=$mode&page=$i
				if(isset($_GET["page"])){  //사용자가 하단의 페이저 버튼을 클릭했을 때
					$page = $_GET["page"];
				}else{  ////메시지 보내기를 클릭한 후 리스트 페이지로 진입했을 때
					$page = 1;
				}

				$mode = $_GET["mode"]; //url 창으로부터 mode의 value값을 가져와서 저장
				if($mode == "send"){
					echo "송신함 > 목록보기";
				}else{
					echo "수신함 > 목록보기";
				}
?>
			</h2>
			<div id="message_list">
				<ul id="message">
					<li>
						<span class="field_1">번호</span>
						<span class="field_2">제목</span>
						<span class="field_3">
<?php
//송신함이 열린 상태라면 "받은 사람"
//수신함이 열린 상태라면 "보낸 사람"
								if($mode == "send"){  //송신함
									echo "받은 사람";
								}else{  //수신함
									echo "보낸 사람";
								}
?>
						</span>
						<span class="field_4">등록일</span>
					</li>
<?php
	//여러가지 항목의 데이터 값을 넣을 수 있는 조건이 필요. 반복문을 적용하여 그 내부에 각 데이터 값들을 넣어줌
	include "./db_con.php";
	if($mode == "send"){  //송신함에서 DB로 접근
		$sql = "select * from message where send_id='$userid' order by num desc";  
		//order by num desc : num의 값을 역순으로 가져와라
	}else{
		$sql = "select * from message where rv_id='$userid' order by num desc";
	}
	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result);  //조건에 일치하는 행의 개수
	//var_dump($total_record);  //13


	$scale = 10;
	//만약, $total_record = 20  하단부의 페이저 표시는 1, 2로 표기됨  
	//만약, $total_record = 22  하단부의 페이저 표시는 1,2,3으로 표기됨
	if($total_record % $scale == 0){  //$total_record은 $scale의 배수값
		$total_page = $total_record / $scale;   //100 / 10  ==>  10번 페이지까지 필요
	}else{
		$total_page = floor($total_record / $scale) + 1; 
		//101 / 10  ==>  floor(10.1)  ==> 10  (+1)  ==>  11
	}


	//첫번째 페이지($page = 1)에서 100개의 데이터가 존재한다 가정하면
	//0번 데이터로부터 9번까지 데이터를 가져옴

	//표시할 페이지마다 시작하는 데이터의 번호를 가져옴
	$start = ($page - 1) * $scale;  
	//1번 페이지일 경우, (1-1) * 10 = 0~
	//2번 페이지일 경우, (2-1) * 10 = 10~
	//3번 페이지일 경우, (3-1) * 10 = 20~

	//$number를 구축
	$number = $total_record - $start;  //1번 페이지에서 100 - 0 = 100~91, 2번 페이지 100 - 10 = 90~81, 3번 페이지 100 - 20 = 80~71

	//만약, 13개의 데이터를 받아온 상태라면, 두번째 페이지에서 3개만 보여주면 됨.  $i < $start+$scale  ==>  $i < 10 + 10 = 20    ====>  10~20  ==> 7개의 공간에는 데이터가 존재하지 않음.  그래서 제한을 한번 더 걸어줌  $i < 13($total_record 값)
	for($i = $start; $i < $start+$scale && $i < $total_record; $i++){
		
		mysqli_data_seek($result, $i);
		//mysqli_data_seek(최종 데이터 값들, 레코딩 순번) : 다량의 데이터(행 데이터들)에서 순번(인덱스 번호)을 찾아서 각각의 메모리 값을 구성

		//$result의 전체의 데이터가 아닐까?
		$row = mysqli_fetch_array($result);
		//var_dump($row);  //전체 행으로부터 하나의 행 데이터들을 가져온 상태라고 보임 
		
		$num = $row["num"];
		$subject = $row["subject"];
		
		if($mode == "send"){  //송신함이기 때문에 리스트에 보여줄 항목은 받은 사람이 필요
			$msg_id = $row["rv_id"];
		}else{  //수신함이기 때문에 리스트에 보여줄 항목은 보낸 사람 필요
			$msg_id = $row["send_id"];
		}
		$regist_day = $row["regist_day"];

?>
					<li>
						<span class="field_1"><?=$number?></span>
						<span class="field_2"><a href="message_view.php?mode=<?=$mode?>&num=<?=$num?>"><?=$subject?></a></span>
						<span class="field_3"><?=$msg_id?></span>
						<span class="field_4"><?=$regist_day?></span>
					</li>

<?php
		$number--;
	}
?>
				</ul>

				<ul id="page_num">
<?php
					//게시글 양이 두번째 존재해야할 경우
					//현재 페이저의 위치가 2번째 페이지 이상일 때
					//이전 페이지로 이동 파트
					if($total_page>=2 && $page>=2){
						$new_page = $page - 1;
						echo "<li><a href='message_box.php?mode=$mode&page=$new_page'>◀ 이전</a></li>";
					}else{
						echo "<li>&nbsp;</li>";
					}

					//게시글에 대한 페이지 넘버를 부여
					for($i = 1; $i <= $total_page; $i++){
						if($page == $i){  //현재 보여지는 페이지에 대한 표기(링크 불필요)
							echo "<li><span class='cur_page'> $i </span></li>";
						}else{
							echo "<li><a href='message_box.php?mode=$mode&page=$i'> $i </a></li>";
						}
					}

					//다음 페이지로 이동 파트
					//만약, 현재 페이지의 번호가 2번인데, 전체 페이저의 개수가 2개 밖에 없다면 다음버튼은 의미가 없음.
					//현재 모든 페이지의 수가 1이 아닐 때, 이전 버튼과 다음 버튼은 보여주면 안 됨.
					if($total_page >= 2 && $page != $total_page){
						$new_page = $page + 1;
						echo "<li><a href='message_box.php?mode=$mode&page=$new_page'>다음 ▶</a></li>";
					}else{
						echo "<li>&nbsp;</li>";
					}
?>
				</ul>

				<ul class="msg_link">
					<li><button type="button" onclick="location.href='message_box.php?mode=rv'">수신함</button></li>
					<li><button type="button" onclick="location.href='message_box.php?mode=send'">송신함</button></li>
					<li><button type="button" onclick="location.href='message_form.php'">메시지 보내기</button></li>
				</ul>

			</div>

		</div>






	</section>
	<footer>
			<?php include "./footer.php"; ?>
	</footer>
</body>
</html>