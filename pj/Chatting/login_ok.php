<?php
	$id = $_POST["id"];
	$pass = $_POST["pass"];

	include "./db_con.php";
	$sql = "select * from register where id='$id'";
	$result = mysqli_query($con, $sql);
	$num_match = mysqli_num_rows($result);

	if(!$num_match){
		echo ("
			<script>
				alert('등록되지 않은 아이디입니다');
				history.go(-1);
			</script>
		");
	}else{
		$row = mysqli_fetch_array($result);
		$db_pass = $row["pass"];
		var_dump($db_pass);
		
		mysqli_close($con);

		if($pass != $db_pass){
			echo ("
				<script>
					alert('입력한 비밀번호가 다릅니다. 재입력 바랍니다.');
					history.go(-1);
				</script>
			");
			exit;
		}else{
			session_start();
			$_SESSION["userid"] = $row["id"];
			$_SESSION["username"] = $row["name"];

			echo("
				<script>
					location.href='./chat.php';
				</script>
			");
		}
	}

?>