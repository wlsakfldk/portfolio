<?php
	//#1. 체크한 항목의 개수를 파악
	if(isset($_POST["unit"])){  //몇개를 선택했는가
		$num_unit = count($_POST["unit"]);  //배열화된 데이터를 지목

		//var arr = ["a", "z"];
		//arr.length
		//$_POST["unit"] = [1?, 2?, 3?, 4?]
		//$_POST["unit"][3] = value값


	}else{
		echo ("
			<script>
				alert('삭제할 게시글을 선택하세요.');
				history.go(-1);
			</script>
		");
	}
	var_dump($num_unit);  //int(정수)
	include "./db_con.php";
	for($i=0; $i<$num_unit; $i++){
		$num1 = $_POST["unit"][$i];  //반복하는 과정상 각 value 값을 받아서 저장
		var_dump($num1);  //14는 checkbox가 갖고 있던 value 값

		$sql = "select * from board where num='$num1'";
		$result = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($result);

		//#1. data라는 폴더 내부의 첨부파일을 삭제
		$file_copied = $row["file_copied"];

		if($file_copied){  //첨부파일이 존재한다면
			$file_path = "./data/".$file_copied;
			unlink($file_path);
		}

		//#2. board 테이블 내부의 선택한 항목 행 삭제
		$sql = "delete from board where num='$num1'";
		mysqli_query($con, $sql);
	}
	mysqli_close($con);
/*
	echo("
		<script>
			location.href='./admin.php';
		</script>
	");
*/
?>