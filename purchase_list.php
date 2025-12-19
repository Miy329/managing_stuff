<?php
// purchase_list.php
session_start();

// 로그인 안 했으면 튕기기
if(!isset($_SESSION['uNum'])){
	header("Location: login.php");
	exit;
}

// DB 연결
$conn = mysqli_connect("localhost", "root", "", "project01_db");
if(!$conn){
	die("DB 연결 실패: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8mb4");

$uNum = $_SESSION['uNum'];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>내 물건 목록</title>
<style>
	body{
		text-align:center;
		margin-top:80px;
	}
	table{
		border-collapse:collapse;
		margin:0 auto;
		width:80%;
	}
	th, td{
		border:1px solid #333;
		padding:8px;
	}
	th{
		background:#eee;
	}
</style>
</head>
<body>

<h1><?php echo $_SESSION['uName']; ?>님의 물건 목록</h1>

<div style="margin-bottom:20px;">
	<button onclick="location.href='addItem.php'">새로운 물건 등록하기</button>
	<button onclick="location.href='logout.php'">로그아웃</button>
</div>

<table>
<tr>
	<th>번호</th>
	<th>물건명</th>
	<th>등록일</th>
	<th>삭제</th>
</tr>

<?php
$qry = "SELECT * FROM purchase_tbl WHERE uNum=".$uNum." ORDER BY pNum DESC";
$rst = mysqli_query($conn, $qry);

if(mysqli_num_rows($rst) == 0){
	echo "<tr><td colspan='4'>등록된 물건이 없습니다.</td></tr>";
}else{
	while($row = mysqli_fetch_assoc($rst)){
		echo "<tr>";
		echo "<td>".$row['pNum']."</td>";
		echo "<td>".$row['itemName']."</td>";
		echo "<td>".$row['regDate']."</td>";
		echo "<td>
			<form method='post' action='deleteItem.php' onsubmit=\"return confirm('삭제하시겠습니까?');\">
				<input type='hidden' name='pNum' value='".$row['pNum']."'>
				<input type='submit' value='삭제'>
			</form>
		</td>";
		echo "</tr>";
	}
}
?>

</table>

</body>
</html>
