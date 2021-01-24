function check_input(){
	if(!document.product_form.title.value){
		alert("프로그램 타이틀을 작성하세요");
		document.product_form.title.focus();
		return;
	}
	if(!document.product_form.sub.value){
		alert("프로그램 부제를 작성하세요");
		document.product_form.sub.focus();
		return;
	}
	if(!document.product_form.content.value){
		alert("프로그램 상세 내용을 작성하세요");
		document.product_form.content.focus();
		return;
	}
	if(!document.product_form.price.value){
		alert("프로그램 가격을 작성하세요");
		document.product_form.price.focus();
		return;
	}
	//첨부파일은 사용자의 선택에 의해서 존재할 수도 있고 없을 수도 있음(필수사항 아님)

	document.product_form.submit();
}