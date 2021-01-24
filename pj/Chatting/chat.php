<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Chatting App</title>
	<link rel="stylesheet" href="./css/common.css">
	<link rel="stylesheet" href="./css/chat.css">
</head>
<body>
	<?php
		session_start();
		if(isset($_SESSION["userid"])){
			$userid = $_SESSION["userid"];
		}else{
			$userid = "";
		}
		if(isset($_SESSION["username"])){
			$username = $_SESSION["username"];
		}else{
			$username = "";
		}
	?>

	<span class="hide" id="user_id"><?=$userid?></span>
	<span class="hide" id="user_name"><?=$username?></span>



	<!-- The core Firebase JS SDK is always required and must be listed first // firebase app 연동-->
	<script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-app.js"></script>

	<!--firebase database와 연동(Realtime Database를 선택했기 때문에 실시간으로 데이터 베이스의 자료를 가져옴)-->
	<script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-database.js"></script>

	<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->

	<script>
  // Your web app's Firebase configuration
		var firebaseConfig = {
			apiKey: "AIzaSyCGZHimkylBI5XV1c76mbFSUaFJKz83CVs",
			authDomain: "mychatting-8bd9f.firebaseapp.com",
			projectId: "mychatting-8bd9f",
			storageBucket: "mychatting-8bd9f.appspot.com",
			messagingSenderId: "710607630274",
			appId: "1:710607630274:web:609004b61b8ba7262d305b"
		};
		// Initialize Firebase
		firebase.initializeApp(firebaseConfig);

		//const myName = prompt("이름을 작성해 주세요", "");
		const myName = document.getElementById("user_name").innerText;
		function sendMessage(){
			//메시지 보내기
			const message = document.getElementById("message").value;

			firebase.database().ref("messages").push().set({
				"sender":myName,
				"message":message
			});

			document.getElementById("message").value = "";  //전송버튼 클릭후 입력상자의 내용은 초기화시킨다. 
			return false; //form 태그에서 전송했기 때문에 action=""의해서 새로고침이 발생되는 것을 막는다.
		}

		//메시지 리스트 가져오기
		firebase.database().ref("messages").on("child_added", function(snapshot){
			console.log(snapshot);  //개별 메시지의 덩어리 파일
			console.log(snapshot.key);
			console.log(snapshot.val().sender);
			console.log(snapshot.val().message);

			if(snapshot.val().sender == myName){  //내가 작성한 것과 prompt 창으로부터 입력한 사람이 이름이 동일하다면
				let html = "";
				html += "<li class='mine' id='message-"+snapshot.key+"' ><p>"+snapshot.val().sender+"</p><span>";
				html += snapshot.val().message+ "&nbsp;";
				//#2-1. 작성자에 의한 삭제버튼 추가
//				if(snapshot.val().sender == myName){
					html += "<button data-id='"+snapshot.key+"' onclick='deleteMessage(this);'>";
					html += "×";
					html += "</button>";
//				}
				html += "</span></li>";
				document.getElementById("messages").innerHTML += html;
			}else{  //타인이 작성한 메시지
				let html = "";
				html += "<li class='others' id='message-"+snapshot.key+"' ><p>"+snapshot.val().sender+"</p><span>";
				html += snapshot.val().message+ "&nbsp;";
				html += "</span></li>";
				document.getElementById("messages").innerHTML += html;
			}

			//<li> 태그가 호출이 되거나 또는 신규로 작성이 된 시점 
			const chatscroll = document.getElementById("messages");
			chatscroll.scrollTop = chatscroll.scrollHeight;
		});

		//#2-2. 삭제 기능 함수문("×" 버튼 클릭시)
		function deleteMessage(self){
			let messageId = self.getAttribute("data-id");

			firebase.database().ref("messages").child(messageId).remove();
		}

		//#2-3. 삭제된 메시지에 대한 표현("삭제된 메시지입니다")
		firebase.database().ref("messages").on("child_removed", function(snapshot){
			//문서상에서 삭제된 항목을 대체문구로 변경
			console.log("진행여부");
			
			if(snapshot.val().sender == myName){
				document.getElementById("message-"+snapshot.key).innerHTML = "<li class='mine'><span>삭제된 메시지 입니다</span></li>";
			}else{
				document.getElementById("message-"+snapshot.key).innerHTML = "<li class='others'><span>삭제된 메시지 입니다</span></li>";
			}
		});

	</script>


	<header>
		<div class="logo">
			<a href="">My Chat</a>
		</div>
	</header>
	<section id="chat_box">
		<!--채팅한 내용을 담을 곳-->
		<article>
			<ul id="messages">

			</ul>
		</article>
		<!--채팅을 입력할 공간-->
		<form id="chat_msg" onsubmit="return sendMessage();">
			<textarea type="text" id="message" placeholder="메시지를 입력하세요" autocomplete="off"></textarea>
			<input type="submit" value="전송">
		</form>
	</section>

	

</body>
</html>