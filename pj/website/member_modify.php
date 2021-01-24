<?php
	$id = $_GET["id"];  //URL 창으로부터 id의 값을 가져와서 저장
	$pass = $_POST["pass"];  //입력상자로부터 수정된 내용의 값을 가져온다
	$name = $_POST["name"];
	$email1 = $_POST["email1"];
	$email2 = $_POST["email2"];
	$email = $email1."@".$email2;

	var_dump($id);


	include "./db_con.php";

	$sql = "update members set pass='$pass', name='$name', email='$email'";
	$sql .= "where id='$id'";
	//members라는 테이블의 아이디가 일치하는 곳의 다른 필드값들을 업데이트 처리
	mysqli_query($con, $sql);

	//수정을 했음에도 불구하고, 기존 session['username']에서는 예전 값이 저장되어 있는 상태
	//세션을 재등록 -> index.php로 진행되었을 때, header.php에 session 정보를 받아와서 등록시키는 기능을 데이터 베이스에 전달
	$sql2 = "select * from members where id='$id'";
	$result = mysqli_query($con, $sql2);
	$row = mysqli_fetch_array($result);  //id, name, pass, email, level, point

	var_dump($row["name"]);  //위에서 업데이트가 종료된 값을 가져옴

	session_start();
	$_SESSION["username"] = $row["name"];
	$_SESSION["userlevel"] = $row["level"];
	$_SESSION["userpoint"] = $row["point"];

	mysqli_close($con);

	echo ("
		<script>
			location.href='index.php';
		</script>
	");





?>