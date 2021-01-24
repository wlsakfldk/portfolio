<?php
    //DB 접속 조건(host, id, password, database Name)
    $con = mysqli_connect("localhost", "root", "000000", "website");

    /*닷홈에서는..*/
    //$con = mysqli_connect("localhost", "DB 아이디", "DB 패스워드", "DB 아이디");

    mysqli_query($con, "SET NAMES utf8");  //sql의 언어 설정
?>