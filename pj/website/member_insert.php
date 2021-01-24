<?php
    //1차 관문(member_form.js) -> 2차 관문(member_insert.php)
    $id = $_POST["id"];
    $pass = $_POST["pass"];
    $name = $_POST["name"];
    $email1 = $_POST["email1"];
    $email2 = $_POST["email2"];
    $email = $email1."@".$email2;

    $regist_day = date("Y-m-d (H:i)");  //가입 당시의 연월일시분 저장

    include "./db_con.php";

    //기존의 아이디 존재하는 것을 아이디 입력란에 입력하고 "저장하기" 버튼 클릭시
    $sql="select * from members where id='$id'";
    $result = mysqli_query($con, $sql);
    $num_record = mysqli_num_rows($result);  //int(1) - true / int(0) - false
    if($num_record){  //데이터 베이스에 동일한 아이디가 존재. 경고창 -> 회원가입 창으로 돌려보낸다.
        echo("
            <script>
                alert('동일한 아이디가 있습니다. 아이디를 변경해 주세요.');
                history.go(-1);  
            </script>
        ");
    }else{  //데이터 베이스에 동일한 아이디가 존재 없음 -> 회원가입 가능
        $sql = "insert into members (id, pass, name, email, regist_day, level, point) values('$id', '$pass', '$name', '$email', '$regist_day', 9, 0)";  //명령문을 작성한 것 뿐임
        //level, point : 활동에 따라서 차등으로 부여되는 항목
        mysqli_query($con, $sql);  //1차 적으로 데이터 베이스와 접속을 한다. 2차적으로 각 항목에 접근하여 $sql 내부에 저장된 명령을 실행
    }
    mysqli_close($con);  //접속 종료

    echo "
        <script>
            location.href='index.php';
        </script>
    ";
    //위의 모든 것이 실행이 완료되면 현재 브라우저 화면을 index.php 화면으로 보내라.
    
?>