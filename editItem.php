<?php
session_start();

if(!isset($_SESSION['uNum'])){
	header("Location: login.php");
	exit;
}

if(!isset($_GET['iNum'])){
	header("Location: main.php");
	exit;
}

$conn = mysqli_connect("localhost", "root", "", "project01_db");
if(!$conn){
	die("DB 연결 실패");
}
mysqli_set_charset($conn, "utf8mb4");

$uNum = $_SESSION['uNum'];
$iNum = (int)$_GET['iNum'];

$upQry = "UPDATE items SET view_cnt = view_cnt + 1 WHERE iNum=".$iNum." AND it_mem=".$uNum;
mysqli_query($conn, $upQry);

$qry = "SELECT * FROM items WHERE iNum=".$iNum." AND it_mem=".$uNum;
$rst = mysqli_query($conn, $qry);

if(!$rst || mysqli_num_rows($rst) != 1){
	mysqli_close($conn);
	echo "<script>alert('접근할 수 없습니다.'); location.href='main.php';</script>";
	exit;
}

$row = mysqli_fetch_assoc($rst);

$iPhoto = $row['iPhoto'];
$iName = $row['iName'];
$warranty = $row['warranty'];
$purchasedPlace = $row['purchasedPlace'];
$storageLoc = $row['storage_location'];
$purchaseDate = $row['purchase_date'];
$memo = $row['memo'];

mysqli_close($conn);
?>

<html>
<head>
<title>물건 수정</title>
<style>
body{
	text-align:center;
	margin-top:60px;
	font-family:Arial;
}
table{
	border-collapse:collapse;
	margin:0 auto;
	width:600px;
}
td{
	border:1px solid #333;
	padding:10px;
}
td.ttl{
	width:160px;
	background:#e6e6e6;
	font-weight:bold;
	text-align:right;
}
input[type=text], input[type=date], textarea{
	width:95%;
	padding:6px;
}
textarea{
	resize:none;
}
.preview{
	width:200px;
	height:200px;
	border:1px solid #ccc;
	margin:10px auto 0 auto;
	display:flex;
	align-items:center;
	justify-content:center;
	overflow:hidden;
	background:#fafafa;
}
.preview img{
	width:100%;
	height:100%;
	object-fit:cover;
	display:block;
}
.btn-area{
	text-align:right;
	padding-top:15px;
	width:600px;
	margin:0 auto;
}
.btn-area input, .btn-area button{
	padding:7px 12px;
	margin-left:6px;
	cursor:pointer;
}
</style>
</head>
<body>

<h1>물건 수정</h1>

<form action="editItem_process.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="iNum" value="<?=$iNum?>">
<input type="hidden" name="oldPhoto" value="<?=htmlspecialchars($iPhoto, ENT_QUOTES, 'UTF-8')?>">

<table>

<tr>
	<td class="ttl">현재 사진</td>
	<td>
		<div class="preview">
			<?php if($iPhoto != NULL && $iPhoto != ""){ ?>
				<img src="<?=htmlspecialchars($iPhoto, ENT_QUOTES, 'UTF-8')?>">
			<?php }else{ ?>
				<div>이미지 없음</div>
			<?php } ?>
		</div>
	</td>
</tr>

<tr>
	<td class="ttl">새 사진 업로드</td>
	<td>
		<input type="file" name="itemImg" accept="image/*">
	</td>
</tr>

<tr>
	<td class="ttl">물건 이름</td>
	<td>
		<input type="text" name="iName" value="<?=htmlspecialchars($iName, ENT_QUOTES, 'UTF-8')?>" required>
	</td>
</tr>

<tr>
	<td class="ttl">AS 기간</td>
	<td>
		<input type="text" name="iasP" value="<?=htmlspecialchars($warranty, ENT_QUOTES, 'UTF-8')?>" placeholder="예: 1년 / 무상 2년">
	</td>
</tr>

<tr>
	<td class="ttl">구매처</td>
	<td>
		<input type="text" name="ibuyPlace" value="<?=htmlspecialchars($purchasedPlace, ENT_QUOTES, 'UTF-8')?>" placeholder="예: 쿠팡, 매장 구매">
	</td>
</tr>

<tr>
	<td class="ttl">보관 위치</td>
	<td>
		<input type="text" name="istoragePlace" value="<?=htmlspecialchars($storageLoc, ENT_QUOTES, 'UTF-8')?>" placeholder="예: 옷장 위, 서랍">
	</td>
</tr>

<tr>
	<td class="ttl">구매일</td>
	<td>
		<input type="date" name="buyDate" value="<?=htmlspecialchars($purchaseDate, ENT_QUOTES, 'UTF-8')?>">
	</td>
</tr>

<tr>
	<td class="ttl">메모</td>
	<td>
		<textarea name="imemo" rows="5" placeholder="물건 관련 메모를 입력하세요"><?=htmlspecialchars($memo, ENT_QUOTES, 'UTF-8')?></textarea>
	</td>
</tr>

</table>

<div class="btn-area">
	<input type="button" value="뒤로" onclick="location.href='main.php'">
	<button type="submit">수정 저장</button>
</div>

</form>

</body>
</html>
