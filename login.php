<?php
// login.php
session_start();
// 로그인 상태 알기 위해 세션 만들기

$conn = mysqli_connect("localhost", "root", "", "project01_db");
if(!$conn){
	die("DB 연결 실패: " . mysqli_connect_error());
}

if(isset($_SESSION['uNum'])){   // 이미 로그인되어 있을 경우 
	header("Location: purchase_list.php");
	exit;
}
?>

<html>
<head><title>구매 물품 관리-로그인</title>
<style>
		body {
			text-align: center; 
			margin-top: 200px;   
			background-color: #fee0be;

		}
		button {
			padding: 5px 10px;
		}
		label{
			background-color: ;
		}
	</style>
</head>
<body><h1>나의 물품 관리 서비스에 오신 것을 환영합니다</h1>
	<h2>로그인</h2>
	
 <form method='post' action='login_process.php'>
		<div>
			<label>아이디</label><br>
			<input type="text" name="logId" required> 
		</div>
		<br>
		<div>
			<label>비밀번호</label><br>
			<input type="password" name="logPw" required>
		</div>
	<br>
		<button type="submit"  value='LogIn' >로그인</button>
	</form>
	<br>
	<div>
		<span>회원이 아니라면</span> <br>
		<button type="button" onclick="location.href='registForm.php'">회원가입하기</button>
	</div>
	 </body>
</html>

