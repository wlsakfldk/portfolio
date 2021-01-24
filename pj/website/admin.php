<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>관리자 페이지</title>
	<link rel="stylesheet" href="./css/common.css">
	<link rel="stylesheet" href="./css/admin.css">
</head>
<body>
		<header>
        <?php include "./header.php"; ?>
    </header>
<?php
		//만약 해커들의 입장이 가능하지 못하도록 구성
		if($userid != "admin"){
			echo("
				<script>
					alert('입장 가능한 관리자가 아닙니다.');
					history.go(-1);
				</script>
			");
		}

		if($userlevel > 1){
			echo("
				<script>
					alert('입장 가능한 관리자가 아닙니다.');
					history.go(-1);
				</script>
			");
		}
		include "./db_con.php";
		$sql = "select * from members order by num desc";
		$result = mysqli_query($con, $sql);
		$total_record = mysqli_num_rows($result);  //행 데이터의 개수

		$number = $total_record;   //전체 회원수
?>

		<section>
				<div id="admin_box">
						<h2>관리자 페이지 (회원관리)</h2>
						<ul id="member_list">
							<li>
								<span class="field1">번호</span>
								<span class="field2">아이디</span>
								<span class="field3">이름</span>
								<span class="field4">레벨</span>
								<span class="field5">포인트</span>
								<span class="field6">가입일</span>
								<span class="field7">수정</span>
								<span class="field8">삭제</span>
							</li>

<?php
	while($row = mysqli_fetch_array($result)){
		$num = $row["num"];
		$id = $row["id"];
		$name = $row["name"];
		$level = $row["level"];
		$point = $row["point"];
		$regist_day = $row["regist_day"];
?>
							<li>
								<form name="member_list" action="./admin_member_modify.php?num=<?=$num?>" method="post">
									<span class="field1"><?=$number?></span>
									<span class="field2"><?=$id?></span>
									<span class="field3"><?=$name?></span>
									<span class="field4"><input type="text" name="level" value="<?=$level?>"></span><!--레벨(수정 가능)-->
									<span class="field5"><input type="text" name="point" value="<?=$point?>"></span><!--포인트(수정 가능)-->
									<span class="field6"><?=$regist_day?></span>
									<span class="field7"><button type="submit">수정</button></span>
									<span class="field8"><button type="button" onclick="location.href='admin_member_delete.php?num=<?=$num?>'">삭제</button></span>

								</form>
							</li>
<?php
		$number--;
	}
?>
						</ul>


						<h2>관리자 페이지 (게시글 관리)</h2>
						<form action="./admin_board_delete.php" method="post">
							<ul id="board_list">
								<li>
									<span class="board1">선택</span>
									<span class="board2">번호</span>
									<span class="board3">이름</span>
									<span class="board4">제목</span>
									<span class="board5">첨부파일</span>
									<span class="board6">작성일</span>
								</li>
<?php
	$sql = "select * from board order by num desc";
	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result);

	$number = $total_record;  //게시판 리스트에 표시하기 위한 연속된 숫자(내림차순)

	while($row = mysqli_fetch_array($result)){
		$num = $row["num"];  //게시글의 고유 번호
		$name = $row["name"];
		$subject = $row["subject"];
		$file_name = $row["file_name"];
		$regist_day = substr($row["regist_day"], 0, 10);
?>
								<li>
									<span class="board1"><input type="checkbox" name="unit[]" value="<?=$num?>"></span>
									<span class="board2"><?=$number?></span>
									<span class="board3"><?=$name?></span>
									<span class="board4"><?=$subject?></span>
									<span class="board5"><?=$file_name?></span>
									<span class="board6"><?=$regist_day?></span>
								</li>
<?php
		$number--;
	}
	mysqli_close($con);
?>
							</ul>
							<button class="sel_del" type="submit">선택 항목 삭제</button>
									
						</form>


				</div>
		</section>



    <footer>
        <?php include "./footer.php"; ?>
    </footer>
</body>
</html>