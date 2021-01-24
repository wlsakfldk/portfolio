<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>아이디 중복체크</title>
	<link rel="stylesheet" href="./css/idChk_pop.css">
</head>
<body>
	<h2>아이디 중복체크</h2>
	<div id="idChk_txt">
<?php
		//url 창에 표시되어 있는 member_check_id.php?id=www
		$id = $_GET["id"];
		//var_dump($id);
		if(!$id){  
			//아이디 입력란에 아무것도 입력하지 않은 상태에서 "중복체크"라는 버튼을 클릭시. member_check_id.php?id=
			echo ("<p>아이디를 입력해주세요.</p>");
		}else{
			include "./db_con.php";
			$sql = "select * from members where id='$id'";
			//id가 동일한 것이 있는지를 찾아야함 -> 만약 존재한다면 -> 중복되었습니다. 문구를 띄우고 다시 작성하도록 진행을 유도해 함
			$result = mysqli_query($con, $sql);
			$num_record = mysqli_num_rows($result);
			//var_dump($num_record);  //int(1) : 하나라도 존재한다. - true / int(0) : 데이터 베이스에 존재하는 아이디가 아님 - false

			if($num_record){  //기존의 동일한 아이디가 있는 상태
				echo "<p><b>".$id."</b> 아이디는 중복된 아이디입니다.</p><p>다른 아이디를 사용해 주세요.</p>";
			}else{  //동일한 아이디가 없는 상태
				echo "<p><b>".$id."</b> 아이디는 사용가능합니다.</p>";
			}
			mysqli_close($con);
		}
?>			
	</div>
	<div id="close">
		<button type="button" onclick="self.close();">닫기</button>
	</div>

	
</body>
</html>