<?php
// addItem.php
session_start();

// 로그인 체크
if(!isset($_SESSION['uNum'])){
	header("Location: login.php");
	exit;
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="utf-8">
<title>새 물건 등록</title>
<style>
	body{
		text-align:center;
		margin-top:80px;
	}
	table{
		border-collapse:collapse;
		margin:0 auto;
		width:70%;
	}
	td{
		border:1px solid #333;
		padding:8px;
	}
	td.ttl{
		background:#eee;
		text-align:right;
		width:150px;
	}
</style>
</head>
<body>

<h1>새로운 물건 등록</h1>

<table>
<form method="post" action="addItemExec.php" enctype="multipart/form-data">

<tr>
	<td class="ttl">물건 이름</td>
	<td><input type="text" name="itemName" required></td>
</tr>

<tr>
	<td class="ttl">보관 위치</td>
	<td><input type="text" name="location"></td>
</tr>

<tr>
	<td class="ttl">구매일</td>
	<td><input type="date" name="buyDate"></td>
</tr>

<tr>
	<td class="ttl">제품 사진</td>
	<td><input type="file" name="photo"></td>
</tr>

<tr>
	<td class="ttl">메모</td>
	<td>
		<textarea name="memo" rows="5" cols="50"
		placeholder="잊으면 안 되는 정보, AS 기간, 사용법 등"></textarea>
	</td>
</tr>

<tr>
	<td colspan="2" align="center">
		<input type="submit" value="등록 완료">
		<input type="button" value="목록으로" onclick="location.href='purchase_list.php'">
	</td>
</tr>

</form>
</table>

</body>
</html>
