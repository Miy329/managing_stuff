<?php
// addItemExec.php
session_start();

// 로그인 체크
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

// 필수값 체크
if(!isset($_POST['itemName'])){
	echo "<script>alert('잘못된 접근'); location.href='purchase_list.php';</script>";
	exit;
}

$uNum     = $_SESSION['uNum'];
$itemName= mysqli_real_escape_string($conn, $_POST['itemName']);
$location= mysqli_real_escape_string($conn, $_POST['location']);
$buyDate = ($_POST['buyDate'] != "") ? $_POST['buyDate'] : NULL;
$memo    = mysqli_real_escape_string($conn, $_POST['memo']);

// ---------- 파일 업로드 처리 ----------
$photoPath = "";

if(isset($_FILES['photo']) && $_FILES['photo']['name'] != ""){
	$upDir = "upload/";
	if(!is_dir($upDir)){
		mkdir($upDir, 0777, true);
	}

	$oriName = $_FILES['photo']['name'];
	$tmpName = $_FILES['photo']['tmp_name'];

	$pos = strrpos($oriName, ".");
	$ext = strtolower(substr($oriName, $pos+1));

	$allow = array("jpg","jpeg","png","gif");
	if(!in_array($ext, $allow)){
		echo "<script>alert('이미지 파일만 업로드 가능합니다'); history.back();</script>";
		exit;
	}

	$newName = time()."_".rand(1000,9999).".".$ext;
	$photoPath = $upDir.$newName;

	move_uploaded_file($tmpName, $photoPath);
}

// ---------- DB 저장 ----------
$qry = "
INSERT INTO purchase_tbl
(uNum, itemName, location, buyDate, memo, photoPath, last_viewed)
VALUES (
	$uNum,
	'$itemName',
	'$location',
	".($buyDate ? "'$buyDate'" : "NULL").",
	'$memo',
	'$photoPath',
	NOW()
)
";

$rst = mysqli_query($conn, $qry);
if(!$rst){
	die("저장 실패: " . mysqli_error($conn));
}

// 완료 → 목록으로
header("Location: purchase_list.php");
exit;
?>
