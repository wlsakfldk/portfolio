<?php
	//http://localhost/website/board_download.php?num=6&real_name=2020_12_11_11_09_56.png&file_name=close.png&file_type=image/png

	$real_name = $_GET["real_name"];
	$file_name = $_GET["file_name"];
	$file_type = $_GET["file_type"];
	$file_path = "./data/".$real_name;

	//file_exists() 함수 : 지정한 경로에 파링의 존재 유무를 판단. 있으면 true, 없으면 false
	//var_dump(file_exists($file_path));
	if(file_exists($file_path)){
		//fopen() 함수 : 파일을 열어주겠다는 선언(현재 문서 입장에서 외부파일을 열어주겠다)
		//fopen(파일명 또는 파일에 대한 변수명, 파일모드, include path-파일 경로)
		/*
		fopen()의 파일모드 정의
				w : 파일 쓰기 전용
				r : 파일을 읽고 쓰기 전용
				b : 바이너리 데이터(컴퓨터 상에서 원시 데이터 -> 컴퓨터 코딩 상에서 구조화된 상태의 데이터 값을 지칭 - 예시, 매트리스 영화의 녹색글자들)
		*/
		//fclose() 함수 : 파일을 닫아주겠다는 명령
		$fp = fopen($file_path, "rb");
		
		//Header() 함수 : HTTP 헤더를 전송하기 위해 사용
		//HTML 문서 상에서 <meta Content-type="equiv">
		Header("Content-type:application/x-msdownload");  //강제로 다운로드 시켜주게끔 만들어주는 정의문
		//application : "앱"은 DB와 연동되면서 하나 이상의 동작을 수행시켜주는 형태를 모두 지칭. 이미지, 문서형태, 비디오, 오디오
		//이미지 파일을 다운로드시 => Header("Content-type:image/gif/x-msdownload");
		Header("Content-Length:".filesize($file_path));  //파일 용량 사이즈를 전송
		Header("Content-Disposition:attachment; filename=".$file_name);  //파일의 오리지널 이름을 전송
		Header("Content-Transfer-Encoding:binary");  //컴퓨터 언어로 인코딩 방식을 전송
		Header("Content-Description:File Transfer");  //파일에 대한 개요를 변형된 형태로 전송
		Header("Expires:0");  //만료일에 대한 전송. "0"이라는 의미는 이미 만료가 되었음을 의미 -> 캐시 메모리(캐싱)에 만료일을 존재하지 않게끔 하겠다는 의미 -> http 로 전송간에 캐시메모리(캐싱)에 저장하지 않겠다는 의미
		
		//캐시 메모리 : 브라우저에서 화면을 여는 과정에서 이미지, 스타일 등을 다운 받아서 잠시 저장하는 공간 넣음. 만약 서버에 (이미지 또는 스타일 또는 스크립트) 파일을 저장했다가 내부에서 변경하는 파일을 다시 던졌을 때, 로딩을 거쳐야하는데, 캐시메모리 상에서 기존 파일이 존재한다면 화면변경이 없음. 이때 서버 자체를 재부팅 하게되면 캐시메모리는 사라짐.

	}
	//fpassthru(변수명) : 외부파일 전체를 읽을 수 있는 함수
	if(!fpassthru($fp)){  //읽을 수 있는 파일이 없다면
		fclose($fp);        //파일을 닫아주겠다는 의미
	}

	//외부파일 다운로드 단계
	/*
	fopen(변수명) -> fread(변수명) -> fclose(변수명) : 약간의 시간이 소요
	fopen(변수명) -> fpassthru(변수명) : "fread(변수명) -> fclose(변수명)"를 무시하고 바로 진행을 시킴으로써 read에 대한 시간을 단축할 수 있음
	*/

?>