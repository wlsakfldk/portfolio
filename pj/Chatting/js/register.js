//"회원가입" 버튼 클릭시
function check_input(){
	if(!document.register_form.id.value){
		alert("아이디를 입력하세요");
		document.register_form.id.focus();
		return;
	}
	if(!document.register_form.pass.value){
		alert("패스워드를 입력하세요");
		document.register_form.pass.focus();
		return;
	}
	if(!document.register_form.pass_confirm.value){
		alert("패스워드 확인을 입력하세요");
		document.register_form.pass_confirm.focus();
		return;
	}
	if(!document.register_form.name.value){
		alert("이름을 입력하세요");
		document.register_form.name.focus();
		return;
	}
	if(!document.register_form.email.value){
		alert("이메일을 입력하세요");
		document.register_form.email.focus();
		return;
	}

	if(document.register_form.pass.value != document.register_form.pass_confirm.value){
		alert("패스워드와 패스워드 확인이 일치하지 않습니다.");
		document.register_form.pass.focus();
		return;
	}

	document.register_form.submit();
}


$(document).ready(function(){
	$(".register_input").keydown(function(e){
		console.log(e);
		console.log(e.keyCode);
		if(e.keyCode == 13){  //회원가입 박스 내부에서 엔터를 눌렀을 때
			$("#register_excute").attr("action", "register_ok.php").submit();
			//$("폼 요소의 아이디 또는 기타 선택자들").attr("action", "url 경로").submit();
		}
	});
});