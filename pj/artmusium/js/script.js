$(document).ready(function(){

    function logoChange(){
        var cur_width = $(window).width();
        if(cur_width <= 420){
            $(".logo img").attr("src", "img/logo1.png");
        }else{
            $(".logo img").attr("src", "img/logo.png");
        }
    }
    logoChange();  //브라우저 로딩시 함수문을 호출하여 현재 화면의 사이즈를 기준으로 로고 변경여부를 결정

    $(window).resize(function(){
        logoChange();  //화면의 가로 사이즈 변경시 함수문 호출
    });
})