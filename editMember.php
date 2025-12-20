<?php
session_start();

if(!isset($_SESSION['uNum'])){
	header("Location: login.php");
	exit;
}

$conn = mysqli_connect("localhost", "root", "", "project01_db");
if(!$conn){
	die("DB 연결 실패");
}
mysqli_set_charset($conn, "utf8mb4");

$uNum = $_SESSION['uNum'];

$qry = "SELECT * FROM member WHERE uNum=".$uNum;
$rst = mysqli_query($conn, $qry);

if(!$rst || mysqli_num_rows($rst) != 1){
	mysqli_close($conn);
	echo "<script>alert('회원 정보를 불러오지 못했습니다.'); location.href='main.php';</script>";
	exit;
}

$row = mysqli_fetch_assoc($rst);

$uID = $row['uID'];
$uName = $row['uName'];
$gender = $row['gender'];
$phone = $row['phone'];
$joinPath = $row['joinPath'];

$phone1 = "010";
$phone2 = "";
$phone3 = "";

if($phone != NULL && $phone != ""){
	$pos0 = strpos($phone, "-");
	$pos1 = strpos($phone, "-", $pos0+1);
	if($pos0 !== false && $pos1 !== false){
		$phone1 = substr($phone, 0, $pos0);
		$phone2 = substr($phone, $pos0+1, $pos1-$pos0-1);
		$phone3 = substr($phone, $pos1+1, strlen($phone)-$pos1-1);
	}
}

mysqli_close($conn);
?>
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
	font-weight:bold;
}
body{
	text-align:center;
	margin-top:80px;
}
#cap{
	background:#feb658;
}
</style>

<div id="cap"><h1>구매 물품 관리 서비스</h1></div>
<hr>
<h2>회원정보 수정</h2>

<form action="editMember_process.php" method="post">
<table>

<tr>
	<td class="ttl">아이디</td>
	<td><input type="text" name="uID" value="<?=htmlspecialchars($uID)?>" readonly></td>
</tr>

<tr>
	<td class="ttl">이름</td>
	<td><input type="text" name="uName" value="<?=htmlspecialchars($uName)?>" required></td>
</tr>

<tr>
	<td class="ttl">비밀번호</td>
	<td>
		<input type="password" name="uPw" pattern="[A-Za-z0-9!@#$%^&*]+"
		title="알파벳, 숫자, 특수문자만 입력 가능 (미입력 시 변경 안 함)"
		placeholder="미입력 시 비밀번호 변경 안 함">
	</td>
</tr>

<tr>
	<td class="ttl">비밀번호 확인</td>
	<td>
		<input type="password" name="uPw2" placeholder="비밀번호 변경 시만 입력">
	</td>
</tr>

<tr>
	<td class="ttl">성별</td>
	<td>
		<input type="radio" name="gender" value="M" <?=($gender=="M"?"checked":"")?>> 남
		<input type="radio" name="gender" value="F" <?=($gender=="F"?"checked":"")?>> 여
	</td>
</tr>

<tr>
	<td class="ttl">핸드폰</td>
	<td>
		<select name="phone1">
			<option value="010" <?=($phone1=="010"?"selected":"")?>>010</option>
			<option value="011" <?=($phone1=="011"?"selected":"")?>>011</option>
			<option value="017" <?=($phone1=="017"?"selected":"")?>>017</option>
			<option value="019" <?=($phone1=="019"?"selected":"")?>>019</option>
		</select> -
		<input type="text" name="phone2" style="width:80px;" maxlength="4" value="<?=htmlspecialchars($phone2)?>"> -
		<input type="text" name="phone3" style="width:80px;" maxlength="4" value="<?=htmlspecialchars($phone3)?>">
	</td>
</tr>

<tr>
	<td class="ttl">가입 경로</td>
	<td>
		<textarea name="joinPath" rows="4" placeholder="지인 추천, 검색 등등"><?=htmlspecialchars($joinPath)?></textarea>
	</td>
</tr>

</table>
<br>
<input type="submit" value="수정 저장">
<br><br>
<input type="button" value="뒤로" onclick="location.href='main.php'">
</form>

</html>
