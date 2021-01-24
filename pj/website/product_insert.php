<?php
	//로그인 된 상태
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

	$title = str_replace("'", "&#39;", $_POST["title"]);
	$sub = str_replace("'", "&#39;", $_POST["sub"]);
	//$content = $_POST["content"];
	$content = str_replace("'", "&#39;", $_POST["content"]);
	$price = $_POST["price"];
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

		if($upfile_size > 5000000){
			echo ("
				<script>
					alert('업로드한 파일의 크기가 5MB를 초과하였습니다. \n파일 사이즈를 조정하여 다시 업로드 하시기 바랍니다.');
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

	//DB 전송
	include "./db_con.php";
	$sql = "insert into products (id, name, title, sub, content, price, fav, hit, regist_day, file_name, file_type, file_copied)";
	$sql .= "values('$userid', '$username', '$title', '$sub', '$content', '$price', 0, 0, '$regist_day', '$upfile_name', '$upfile_type', '$copied_file_name')";

	//'$content'  =>  '`보깅댄스` '

	mysqli_query($con, $sql);
	mysqli_close($con);

	echo ("
		<script>
			location.href='./product_list.php';
		</script>
	");


?>