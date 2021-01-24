//"로그인" 버튼 클릭시
function check_input(){
	if(!document.login_form.id.value){
		alert("아이디를 입력하세요");
		document.login_form.id.focus();
		return;
	}
	if(!document.login_form.pass.value){
		alert("패스워드를 입력하세요");
		document.login_form.pass.focus();
		return;
	}

	document.login_form.submit();

}

$(document).ready(function(){
	$(".login_input").keydown(function(e){
		console.log(e);
		console.log(e.keyCode);
		if(e.keyCode == 13){  //로그인 박스 내부에서 엔터를 눌렀을 때
			$("#login_excute").attr("action", "login_ok.php").submit();
			//$("폼 요소의 아이디 또는 기타 선택자들").attr("action", "url 경로").submit();
		}
	});
});


