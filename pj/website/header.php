<script src="https://kit.fontawesome.com/09743b710b.js" crossorigin="anonymous"></script>

<?php
    session_start();  //로그인을 거친 상태에서만 세션 스토리지로 접근
    //isset($_SESSION['key값']) : key값이라는 세션 항목에 등록 여부를 판단(true/false)
    if(isset($_SESSION['userid'])){
        $userid = $_SESSION['userid'];  //세션에 저장된 항목중에서 userid라는 곳의 값을 $userid라는 변수에 저장
    }else{
        $userid = "";  //없다면 값을 비우겠다. => 로그인이 안된 상태, 로그아웃이 된 상태
    }
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
    }else{
        $username = "";
    }
    if(isset($_SESSION['userlevel'])){
        $userlevel = $_SESSION['userlevel'];
    }else{
        $userlevel = "";
    }
    if(isset($_SESSION['userpoint'])){
        $userpoint = $_SESSION['userpoint'];
    }else{
        $userpoint = "";
    }

    /*
    var_dump($userid);
    var_dump($username);
    var_dump($userlevel);
    var_dump($userpoint);
    */
?>




<div id="top">
    <div class="frame">
        <div class="top_info">
            <p><i class="fas fa-phone-alt"></i> 24/7 support: +011 322 44 56</p>
        </div>
        <ul id="top_menu">
<?php
    //로그인이 되지 않은 상태(세션 등록 없는 상태)
    if(!$userid){  //$userid 값이 존재하지 않는다면
?>
            <li><a href="./member_form.php">회원가입</a></li>
            <li><a href="./login_form.php">로그인</a></li>
<?php
    //로그인이 된 상태(세션 등록 완료 상태)
    }else{
        $logged = $username."(".$userid.") 님[Lv:".$userlevel.", P:".$userpoint."]";
?>
            <li><?php echo $logged ?></li>
            <li><a href="./member_modify_form.php">정보수정</a></li>
            <li><a href="./logout.php">로그아웃</a></li>
<?php
    }
    //레벨이 1인 경우만 관리자로 인식하여 웹사이트 통제 페이지로 입장이 가능하도록 구성
    if($userlevel == 1){
?>
        <li><a href="./admin.php">관리자</a></li>
<?php
    }
?>

        </ul>
    </div>
</div>
<nav>
    <div class="frame">
        <div class="logo">
            <a href="./index.php"><img src="./img/lm-s.png" alt="로고"></a>
        </div>
        <div id="menu_bar">
            <ul>
                <li><a href="./product_list.php">프로그램</a></li>
                <li><a href="./message_form.php">메시지 보내기</a></li>
                <li><a href="./board_list.php">게시판</a></li>
            </ul>
        </div>
    </div>
</nav>
