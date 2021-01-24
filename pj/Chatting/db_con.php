<?php
	//DB 접속("host" 또는 "url 주소", "id", "password", "databaseName", "DB로 연결된 port 번호(3307)")
	$con = mysqli_connect("localhost", "ajwooks", "rnaqpddl#3369", "ajwooks");
	mysqli_query($con, "SET NAMES utf8");
?>