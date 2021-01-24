<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>website-로그인</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/login.css">
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

        <div id="main_content">
            <div id="login_box">
                <div id="login_title">
                    <span>로그인</span>
                </div>
                <div id="login_form">
                    <form name="login_form" action="login.php" method="post">
                        <ul>
                            <li><input type="text" name="id" placeholder="아이디 입력"></li>
                            <li><input type="password" name="pass" placeholder="비밀번호 입력"></li>
                        </ul>
                        <div id="login_btn">
                            <button onclick="check_input();">로그인</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
    




    <footer>
        <?php include "./footer.php"; ?>
    </footer>

    <script src="./js/login.js"></script>

</body>
</html>