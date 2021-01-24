<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>website-회원정보수정</title>
	<link rel="stylesheet" href="./css/common.css">
	<link rel="stylesheet" href="./css/member.css">
</head>
<body>
		<header>
        <?php include "./header.php"; ?>
    </header>
    <section>
        <div id="main_img_bar" class="subpage">
            <div class="main_img_cont">
                <div class="frame">
                    <div class="main_img_txt">
                        <div class="main_img_title">
                            <h3>100% Free <span>Online Courses</span></h3>
                            <h1>Get Future's Skills Today!</h1>

                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
	//var_dump($userid);  header.php 내부의 세션 값을 가져옴
	include "./db_con.php";

	$sql = "select * from members where id='$userid'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);

	$pass = $row["pass"];
	$name = $row["name"];

	//ajw1079@naver.com
	//좌측 박스에는 "ajw1079", 우측 박스에는 "naver.com"
	//explode("특정문자", 문자열을 갖고 있는 변수명 또는 대상) : 특정 문자를 기준으로 분리시켜서 배열로 저장
	$email = explode("@", $row["email"]);  //["ajw1079", "naver.com"]
	$email1 = $email[0];
	$email2 = $email[1];

	mysqli_close($con);
?>

        <div id="main_content">
            <div id="join_box">
                <form name="member_form" action="member_modify.php?id=<?=$userid?>" method="post">
                    <h2>회원정보수정</h2>
                    <div class="form id">
                        <div class="label">
                            <label for="id">아이디</label>
                        </div>
                        <div class="input">
                            <input type="text" name="id" id="username" value="<?=$userid?>" readonly>
                        </div>
                    </div>

                    <div class="form">
                        <div class="label">
                            <label for="pass">비밀번호</label>
                        </div>
                        <div class="input">
                            <input type="password" name="pass" value="<?=$pass?>">
                        </div>
                    </div>

                    <div class="form">
                        <div class="label">
                            <label for="pass_confirm">비밀번호 확인</label>
                        </div>
                        <div class="input">
                            <input type="password" name="pass_confirm" value="<?=$pass?>">
                        </div>
                    </div>

                    <div class="form">
                        <div class="label">
                            <label for="name">이름</label>
                        </div>
                        <div class="input">
                            <input type="text" name="name"  value="<?=$name?>">
                        </div>
                    </div>

                    <div class="form email">
                        <div class="label">
                            <label for="email1">이메일</label>
                        </div>
                        <div class="input">
                            <input type="text" name="email1" value="<?=$email1?>">@<input type="text" name="email2" value="<?=$email2?>">
                        </div>
                    </div>

                    <hr>

                    <div class="buttons">
                        <button type="button" onclick="check_input();">수정하기</button>
                        <button type="button" onclick="reset_form();">취소하기</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <footer>
        <?php include "./footer.php"; ?>
    </footer>


    <script src="./js/member_form.js"></script>
</body>
</html>