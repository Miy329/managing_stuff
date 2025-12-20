<!-- registForm.php : 회원가입 -->
<html>
<style>
table{
	border-collapse:collapse;
	margin:0 auto;
	width:500px;
}
td{
	border:1px solid #334;
	padding:10px;
}
td.ttl{
	width:150px;
	background:#e3f3ee;
	text-align:center;
	font-weight:bold;}
	
body{
	text-align:center;
	margin-top:80px;}
	
#cap{
	background:#feb658;
}
</style>

<div id="cap"><h1>구매 물품 관리 서비스</h1></div>
<hr>
<h2>회원가입</h2>

<form action="regist_process.php" method="post">

<table>

<tr>
	<td class="ttl">아이디</td>
	<td><input type="text" name="uID" required></td>
</tr>

<tr>
	<td class="ttl">이름</td>
	<td><input type="text" name="uName" required></td>
</tr>

<tr>
	<td class="ttl">비밀번호</td>
	<td>
		<input type="password" name="uPw" required pattern="[A-Za-z0-9!@#$%^&*]+"
		title="알파벳, 숫자, 특수문자만 입력 가능">
	</td>
</tr>

<tr>
	<td class="ttl">비밀번호 확인</td>
	<td>
		<input type="password" name="uPw2" required>
	</td>
</tr>

<tr>
	<td class="ttl">성별</td>
	<td>
		<input type="radio" name="gender" value="M" required> 남
		<input type="radio" name="gender" value="F"> 여
	</td>
</tr>

<tr>
	<td class="ttl">핸드폰</td>
	<td>
		<select name="phone1">
			<option value="010">010</option>
			<option value="011">011</option>
			<option value="017">017</option>
			<option value="019">019</option>
		</select> -
		<input type="text" name="phone2" style="width:80px;" maxlength="4"> -
		<input type="text" name="phone3" style="width:80px;" maxlength="4">
	</td>
</tr>


<tr>
	<td class="ttl">가입 경로</td>
	<td>
		<textarea name="joinPath" rows="4"
		placeholder=" 지인 추천, 검색 등등"></textarea>
	</td>
</tr>
</table>
<br>
		<input type="submit" value="회원 등록">
		<br>  <br>
		<input type="button" value="로그인 화면" onclick="location.href='login.php'">
</form>
</html>