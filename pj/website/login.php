<?php
    $id = $_POST["id"];
    $pass = $_POST["pass"];

    include "./db_con.php";

    $sql = "select * from members where id='$id'";
    //members 테이블에서 로그인 페이지로부터 입력받은 아이디가 id 필드명에서 일치하는 내용 전부를 가져옴
    $result = mysqli_query($con, $sql);
    //var_dump($result);
    //테이블의 어떤 행으로 접근을 한다.

    $num_match = mysqli_num_rows($result);
    //var_dump($num_match);  //몇개의 데이터가 일치하는지 확인 

    //history.go(-1);  => 이전 페이지로 이동해라. (login_form.php로 이동)
    if(!$num_match){
        echo ("
            <script>
                alert('등록되지 않은 아이디입니다.');
                history.go(-1);
            </script>
        ");
    }else{
        $row = mysqli_fetch_array($result);
        //mysqli_fetch_array($result) : 선택된 데이터들을 배열방식으로 가져와서 저장
        //var_dump($row);
        $db_pass = $row['pass'];
        //배열 데이터로 저장된 항목(필드명) 중에서 pass라는 항목만 저장
        mysqli_close($con);  //mysql 종료

        if($pass != $db_pass){  //로그인 페이지로부터 입력한 패스워드와 아이디로부터 추적하여 데이터 베이스에 저장된 패스워드 값이 일치하지 않는다면
            echo ("
                <script>
                    alert('입력하신 비밀번호가 다릅니다.');
                    history.go(-1);
                </script>
            ");
            exit;  //탈출(모든 것을 종료시켜라)..함수문과 비교했을 때 return과 유사한 존재
        }else{  //두개의 패스워드가 동일할 때
            session_start();  //세션에 등록 진행
            //세션 스토리지에 key값과 데이터베이스로부터 받아온 value값을 저장
            $_SESSION["userid"] = $row["id"];
            $_SESSION["username"] = $row["name"];
            $_SESSION["userlevel"] = $row["level"];
            $_SESSION["userpoint"] = $row["point"];

            echo ("
                <script>
                    location.href= 'index.php';
                </script>
            ");
        }
    }






?>