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

$uNum  = $_SESSION['uNum'];
$uName = $_SESSION['uName'];

$sort = "recent";
if(isset($_GET['sort'])){
	$sort = $_GET['sort'];
}

$order = "iNum DESC";
if($sort == "name"){
	$order = "iName ASC";
}else if($sort == "freq"){
	$order = "view_cnt DESC, iNum DESC";
}else{
	$order = "iNum DESC";
}

$qry = "SELECT * FROM items WHERE it_mem=".$uNum." ORDER BY ".$order;
$rst = mysqli_query($conn, $qry);
?>

<html>
<head>
<title>메인</title>
<style>
body{
	margin:0;
	font-family:Arial;
}
.header{
	display:flex;
	justify-content:space-between;
	align-items:center;
	padding:20px 30px;
}
.header h1{
	margin:0;
	font-size:22px;
}
.btns button{
	margin-left:8px;
	padding:7px 12px;
	cursor:pointer;
}
hr{
	margin:0;
}
.sort-area{
	display:flex;
	justify-content:flex-end;
	padding:10px 30px;
}
.grid{
	display:grid;
	grid-template-columns:repeat(2, 1fr);
	gap:16px;
	padding:20px;
	max-width:900px;
	margin:0 auto;
}
.card{
	border:1px solid #333;
	padding:10px;
}
.thumb{
	width:100%;
	height:220px;
	border:1px solid #ccc;
	display:flex;
	align-items:center;
	justify-content:center;
	overflow:hidden;
	background:#fafafa;
}
.thumb img{
	width:100%;
	height:100%;
	object-fit:cover;
	display:block;
}
.itemName{
	margin-top:10px;
	font-weight:bold;
	text-align:left;
}
.empty{
	padding:30px;
	text-align:center;
}
#cap11{
	background:#feb658;
}
</style>
</head>
<body>

<div id="cap11" class="header">
	<h1>어서오세요, <?=htmlspecialchars($uName, ENT_QUOTES, 'UTF-8')?> 님</h1>
	<div class="btns">
		<button onclick="location.href='editMember.php'">회원정보 수정</button>
		<button onclick="location.href='out.php'">로그아웃</button>
		<button onclick="location.href='add_item.php'">물건 등록</button>
	</div>
</div>

<hr>

<div class="sort-area">
	<form method="get">
		<select name="sort">
			<option value="recent" <?=($sort=="recent" ? "selected" : "")?>>물건 등록순</option>
			<option value="freq" <?=($sort=="freq" ? "selected" : "")?>>자주찾는 순</option>
			<option value="name" <?=($sort=="name" ? "selected" : "")?>>이름 가나다순</option>
		</select>
		<button type="submit">정렬</button>
	</form>
</div>

<?php if(!$rst || mysqli_num_rows($rst) == 0){ ?>
	<div class="empty">등록된 물건이 없습니다.</div>
<?php }else{ ?>
	<div class="grid">
	<?php while($row = mysqli_fetch_assoc($rst)){ ?>
		<div class="card">
			<a href="editItem.php?iNum=<?=$row['iNum']?>" style="text-decoration:none;color:inherit;">
				<div class="thumb">
					<?php if($row['iPhoto']){ ?>
						<img src="<?=htmlspecialchars($row['iPhoto'], ENT_QUOTES, 'UTF-8')?>">
					<?php }else{ ?>
						<div>이미지 없음</div>
					<?php } ?>
				</div>
				<div class="itemName"><?=htmlspecialchars($row['iName'], ENT_QUOTES, 'UTF-8')?></div>
			</a>
		</div>
	<?php } ?>
	</div>
<?php } ?>

</body>
</html>
<?php
mysqli_close($conn);
?>
