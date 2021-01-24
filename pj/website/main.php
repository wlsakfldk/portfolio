		<div id="main_img_bar" class="mainpage">
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

		<div id="main_content">
			<div class="notice">
				<h2>공지사항</h2>
				<ul>
<?php
	include "./db_con.php";
	$sql = "select * from board order by num desc limit 5";
	//게시판으로부터 모든 데이터 베이스를 가져오되 역순으로 5개(행 데이터)만 가져온다.
	$result = mysqli_query($con, $sql);
	//$row = mysqli_fetch_array($result);
	//var_dump($row);
	//var_dump($result);

	//맨 처음 DB 내에 아무것도 없을 때
	if(!$result){
		echo "<li>현재, 등록된 게시글이 존재하지 않습니다.</li>";
	}else{  //게시글이 하나라도 존재한다면
		/*
		반복문의 종류 : while, do~while, for, for~in, forEach

		초기값;
		while(조건식){
			실행문;
			증감식;
		}
		*/
		//배열 데이터가 존재한다면 반복문을 실행해라
		while($row = mysqli_fetch_array($result)){
			//var_dump($row);
			$num = $row["num"];  //상세페이지로 접근
			$subject = $row["subject"];

			$name = $row["name"];
			//2020-12-14 (12:46)
			$regist_day = substr($row["regist_day"], 0, 10);  
			//substr(문자열을 가진 변수, 처음 시작하는 인덱스번호, 인덱스 번호로부터 몇개를 자를 것인가를 지정)
			
?>
					<li>
						<span class="field1"><a href="./board_view.php?num=<?=$num?>&page=1"><?=$subject?></a></span>
						<!--최신글 5개만을 보여주기 때문에 border_list.php에서 페이저의 위치는 1번 페이지(최근 업로드 5개만 해당)  ==>  page=1 -->
						<span class="field2"><?=$name?></span>
						<span class="field3"><?=$regist_day?></span>
					</li>
<?php
		}
	}
?>


				</ul>
			</div>

			<div class="member_rank">
				<h2>파워멤버</h2>
				<ul>
<?php
	$rank = 1;
	$sql = "select * from members order by point desc limit 5";
	$result = mysqli_query($con, $sql);

	if(!$result){  //등록된 회원이 없는 상태
		echo "<li>등록된 회원이 없습니다.</li>";
	}else{  //등록된 회원이 있는 상태
		while($row = mysqli_fetch_array($result)){
			$name = $row["name"];
			$id = $row["id"];
			$point = $row["point"];
?>
					<li>
						<span class="mem1"><?=$rank?></span>
						<span class="mem2"><?=$name?></span>
						<span class="mem3"><?=$id?></span>
						<span class="mem4"><?=$point?></span>
					</li>
<?php
			$rank++;
		}
	}
?>
				</ul>
			</div>
		</div>

