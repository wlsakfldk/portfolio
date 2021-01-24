<?php
	//현재 이 주소까지 들어온 상태는 로그인이 된 상태
	session_start();
	if(isset($_SESSION["userid"])){
		$userid = $_SESSION["userid"];
	}else{
		$userid = "";  //네트워크가 중단된 상태
	}
	if(isset($_SESSION["username"])){
		$username = $_SESSION["username"];
	}else{
		$username = "";
	}

	$subject = str_replace("'", "&#39;", $_POST["subject"]);
	$content = str_replace("'", "&#39;", $_POST["content"]);
	$regist_day = date("Y-m-d (H:i)");

	//첨부파일 저장하는 구성
	//첨부파일을 저장하는 공간
	$upload_dir = "./data/";  //디렉토리 정의  //src="img/파일이름.파일형식"
	$upfile_name = $_FILES["upfile"]["name"];  //업로드한 최초의 이름
	$upfile_tmp_name = $_FILES["upfile"]["tmp_name"];  //첨부파일에 부여된 다른 임시 이름
	$upfile_type = $_FILES["upfile"]["type"];  //파일의 형식 또는 형태
	$upfile_size = $_FILES["upfile"]["size"];  //파일의 크기
	$upfile_error = $_FILES["upfile"]["error"];  //에러사항

	//var_dump($upfile_name);  //string(12) "img001-2.jpg"
	//var_dump($upfile_tmp_name);  //string(48) "C:\Bitnami\wampstack-8.0.0-0\php\tmp\php4F79.tmp"
	//var_dump($upfile_type);  //string(10) "image/jpeg" 
	//var_dump($upfile_size);  //int(119787) - 단위는 바이트
	//var_dump($upfile_error);  //int(0)  ->  에러 없음

	if($upfile_name && !$upfile_error){  //첨부파일 이름이 존재하고 에러가 없다면
		$file = explode(".", $upfile_name);  //지정한 문자(.)를 기준으로 문자열을 분리하여 배열화 시킨다.
		$file_name = $file[0];  
		$file_ext = $file[1];
		//동일한 이름의 이미지 파일이 존재하지 않도록 네이밍을 부여(업데이트 된 날짜를 기준으로 네이밍을 진행)
		$new_file_name = date("Y_m_d_H_i_s");
		$copied_file_name = $new_file_name.".".$file_ext;  //2020_12_10_16_18_50.jpg
		$uploaded_file = $upload_dir.$copied_file_name;   //  "./data/2020_12_10_16_18_50.jpg"


		//var_dump($file_name);  //string(8) "img001-2"
		//var_dump($file_ext);  //string(3) "jpg"
		//var_dump($uploaded_file);  //"./data/2020_12_10_16_18_50.jpg"

		if($upfile_size > 3000000){
			echo ("
				<script>
					alert('업로드한 파일의 크기가 3MB를 초과하였습니다. \n파일 사이즈를 조정하여 다시 업로드 하시기 바랍니다.');
					history.go(-1);
				</script>
			");
		}

		//실제 데이터 베이스를 기반으로 지정된 장소에 파일을 저장
		//move_uploaded_file() 함수로 서버에 임시저장된 $upfile_tmp_name을 $uploaded_file의 값인 경로/ 파일명 형태로 저장. 업로드된 파일명이 중복된 상태를 피할 수 있음.
		//move_uploaded_file(file, newlocation) : 업로드된 파일을 새로운 위치의 파일(경로 포함)로 이동한다.
		//file - 업로드된 파일의 임시파일 / newlocation : 경로를 포함한 파일명 + 확장자명

		if(!move_uploaded_file($upfile_tmp_name, $uploaded_file)){
			echo("
				<script>
					alert('파일을 지정한 디렉토리에 옮기는 것을 실패했습니다.');
					history.go(-1);
				</script>
			");
			exit;
		}
	}else{  //파일 이름이 존재하지 않거나 또는 에러가 발생했다면
		$upfile_name = "";
		$upfile_type = "";
		$copied_file_name = "";
	}
	
	//데이터 베이스에 접근하여 실제 데이터를 전송
	include "./db_con.php";
	$sql = "insert into board (id, name, subject, content, regist_day, hit, file_name, file_type, file_copied) ";
	$sql .= "values('$userid', '$username', '$subject', '$content', '$regist_day', 0, '$upfile_name', '$upfile_type', '$copied_file_name')";

	mysqli_query($con, $sql);

	//게시글을 작성한 회원에게 포인트를 부여(게시글 1개당 100 point를 부여)
	//활동에 대한 포인트 점수
	$point_up = 100;
	//각 회원별 포인트는 members라는 테이블에 있음
	$sql = "select * from members where id='$userid'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	$new_point = $row["point"] + $point_up;  //0+100 = 100 ==>  100+100=200  //누적

	//변경된 포인트의 값을 members 라는 테이블의 포인트 항목(field)에 업데이트를 진행
	$sql = "update members set point=$new_point where id='$userid'";
	mysqli_query($con, $sql);
	mysqli_close($con);

	$_SESSION["userpoint"] = $new_point;  //새로운 포인트를 세션의 userpoint에 저장(변경)

	//모든 업로드 작업이 종료되면 게시판 리스트로 이동시킴
	echo ("
		<script>
			location.href='./board_list.php';
		</script>
	");
?>