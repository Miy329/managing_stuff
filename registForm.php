<?php
session_start();
if(isset($_SESSION['uNum'])){
	header("Location: purchase_list.php");
	exit;
}
?>
<style>
table{
	border-collapse:collapse;
	margin: 0 auto;
}
table td{
	border: 1px solid black;
	padding: 8px;
}
td.ttl{
	text-align:right;
	background-color:#ccc;
	width:120px;
}
body{
	text-align:center;
	margin-top:100px;
}
</style>

<h1>구매 물품 관리 서비스</h1>
<h2>회원가입</h2>

<table>
<form action="registerExec.php" method="post">

<tr>
	<td class="ttl">아이디</td>
	<td><input type="text" name="ID" required></td>
</tr>

<tr>
	<td class="ttl">이름</td>
	<td><input type="text" name="uName" required></td>
</tr>

<tr>
	<td class="ttl">비밀번호</td>
	<td><input type="password" name="PW" required></td>
</tr>

<tr>
	<td class="ttl">비밀번호 확인</td>
	<td><input type="password" name="PW2" required></td>
</tr>

<tr>
	<td class="ttl">성별</td>
	<td>
		<input type="radio" name="gender" value="M"required> 남
		<input type="radio" name="gender" value="F"> 여
	</td>
</tr>

<tr>
	<td class="ttl">생년월일</td>
	<td>
		<input type="date" name="birth"required >
	</td>
</tr>

<tr>
	<td colspan="2" align="center">
		<input type="submit" value="회원가입" onclick="location.href='purchase_list.php'">
		<input type="button" value="로그인화면으로" onclick="location.href='login.php'">
	</td>
</tr>

</form>
</table>
