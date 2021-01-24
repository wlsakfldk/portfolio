<?php
	session_start();
	unset($_SESSION["userid"]);
	unset($_SESSION["username"]);
	unset($_SESSION["userlevel"]);
	unset($_SESSION["userpoint"]);
	//세션으로부터 등록 삭제(unset, destroy)

	echo ("
		<script>
			location.href='index.php';
		</script>
	");
?>