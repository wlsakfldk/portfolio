function check_input(){
	if(!document.board_form.subject.value){
		alert("게시판 제목을 작성하세요");
		document.board_form.subject.focus();
		return;
	}
	if(!document.board_form.content.value){
		alert("게시판 내용을 작성하세요");
		document.board_form.content.focus();
		return;
	}
	//첨부파일은 사용자의 선택에 의해서 존재할 수도 있고 없을 수도 있음(필수사항 아님)

	document.board_form.submit();
}