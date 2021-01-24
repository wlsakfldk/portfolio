
//"저장하기"라는 버튼을 클릭시
function check_input(){
    //아이디의 작성여부를 확인
    //form 태그로 접근하기 위해서는 각 요소들의 name의 속성값을 지정함으로써 요소를 선택한 것과 동일
    if(!document.member_form.id.value){  //"저장하기" 버튼을 클릭시 아이디 상자에 입력값이 존재하지 않는다면
        alert("아이디를 입력하세요.");
        document.member_form.id.focus();
        //focus() : 네이버에서 로그인 박스에 접근시 아이디 박스에 먼저 초점이 맞춰지도록 포커스를 잡는다.
        return;  //함수문에서 탈출 -> 아이디 상자에만 포커스가 잡힐 수 있도록 구성
    }

    //비밀번호 작성여부 확인
    if(!document.member_form.pass.value){
        alert("비밀번호를 입력하세요.");
        document.member_form.pass.focus();
        return;
    }
    //비밀번호확인 작성여부 확인
    if(!document.member_form.pass_confirm.value){
        alert("비밀번호 확인을 입력하세요.");
        document.member_form.pass_confirm.focus();
        return;
    }
    //이름 작성여부 확인
    if(!document.member_form.name.value){
        alert("이름을 입력하세요.");
        document.member_form.name.focus();
        return;
    }
    //이메일 첫번째 작성여부 확인
    if(!document.member_form.email1.value){
        alert("이메일을 입력하세요.");
        document.member_form.email1.focus();
        return;
    }
    //이메일 두번째 작성여부 확인
    if(!document.member_form.email2.value){
        alert("이메일을 입력하세요.");
        document.member_form.email2.focus();
        return;
    }

    //비밀번호와 비밀번호 확인 입력값의 일치여부를 확인
    if(document.member_form.pass.value != document.member_form.pass_confirm.value){
        alert("비밀번호와 비밀번호 확인이 일치하지 않습니다.");
        document.member_form.pass.focus();
        return;
    }
    //모든 조건이 문제가 발생하지 않았다면 비로소 전송을 시켜라
    //submit() : 전송을 진행하는 이벤트
    document.member_form.submit();
}

//<input type="reset" value="초기화 또는 취소하기"> -> 작성했던 모든 내용물(value)을 공란으로 처리하겠다는 의미
function reset_form(){
    document.member_form.id.value = "";  //현재 존재하는 value값을 제거
    document.member_form.pass.value = "";
    document.member_form.pass_confirm.value = "";
    document.member_form.name.value = "";
    document.member_form.email1.value = "";
    document.member_form.email2.value = "";
    document.member_form.id.focus();
    return;
}

//사용 가능한 아이디인지? 또는 중복으로 인하여 사용불가능한 아이디인지를 찾음
function check_id(){
    window.open("member_check_id.php?id="+document.member_form.id.value, "checkID", "width=400, height=250");

    //document.member_form.id.value : 아이디와 관련한 인풋박스의 값
}
//윈도우 팝업창
//window.open("불러올 화면의 주소", "새로운 페이지의 타이틀", "새로운 페이지의 환경설정(가로, 세로, 스크린의 위치정보(top, left), 스크롤바, url 정보창)")
//url주소#red
