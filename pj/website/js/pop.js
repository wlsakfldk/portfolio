$(document).ready(function(){
	//우상단의 "x"버튼 클릭 & 암막 클릭시 쿠키 설정을 없음
	$("#dark, #popup .close").click(function(){
		$("#popup").removeClass("active");
		$("#dark").removeClass("active");
	});
});




//쿠키 설정하기
function setCookie(name, value, expirehours){
	var todayDate = new Date();
	todayDate.setHours(todayDate.getHours() + expirehours);  //버튼을 클릭하는 현재시각으로부터 24시간을 세팅함
	document.cookie = name + "=" + escape(value) + "; path=/; expires=" + todayDate.toGMTString() + ";"
	//문서의 쿠키 설정이 쿠키 설정 key와 16진수에 의한 쿠키 설정 value값과 동일하고 경로설정이 현재 위치이며 설정 제한 시간이 쿠키의 설정시간과 동일한 값으로 설정
	//escape() 내장함수는 알파벳과 숫자 및 *, @, -, _, +, ., / 를 제외한 문자를 모두 16진수 문자로 바꾸어 준다. 이 함수는 쉼표와 세미콜론과 같은 문자가 쿠키의 문자열과 충돌을 피하기 위해 사용됨
	//toGMTString() : 표준시(GMT)를 사용하여 문자열로 변환된 일자를 반환
}


//"하루동안 열리지 않기" 버튼 클릭시
function todayClosePop(){
	setCookie("ncookie", "done", 1);   //쿠키 설정 : setCookie(쿠키설정 key, 쿠키설정 value, 쿠키설정 시간)
	document.getElementById("popup").setAttribute("class", "");  //비활성화
	document.getElementById("dark").setAttribute("class", "");  //비활성화
}

//화면이 열리면서 브라우저 내의 쿠키 상태를 체크
cookiedata = document.cookie;
if(cookiedata.indexOf("ncookie=done") < 0){  //"하루동안 열리지 않기" 버튼 클릭 전. 현재 쿠키의 값이 존재한다면 인덱스번호를 반환(최소 0), 없다면 -1을 반환
	document.getElementById("popup").setAttribute("class", "active");  //활성화
	document.getElementById("dark").setAttribute("class", "active");  //활성화
}else{  //"하루동안 열리지 않기" 버튼 클릭한 다음
	document.getElementById("popup").setAttribute("class", "");  //비활성화
	document.getElementById("dark").setAttribute("class", "");  //비활성화
}