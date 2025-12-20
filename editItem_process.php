<?php
session_start();

if(!isset($_SESSION['uNum'])){
	header("Location: login.php");
	exit;
}

if(!isset($_POST['iNum'])){
	echo "<script>alert('잘못된 접근입니다.'); location.href='main.php';</script>";
	exit;
}

$conn = mysqli_connect("localhost", "root", "", "project01_db");
if(!$conn){
	die("DB 연결 실패");
}
mysqli_set_charset($conn, "utf8mb4");

$uNum = $_SESSION['uNum'];

$iNum = NULL;
$oldPhoto = NULL;

$iName = NULL;
$warranty = NULL;
$purchasedPlace = NULL;
$storageLoc = NULL;
$purchaseDate = NULL;
$memo = NULL;

$iNum = (int)$_POST['iNum'];
$oldPhoto = $_POST['oldPhoto'];

$iName = $_POST['iName'];
$warranty = $_POST['iasP'];
$purchasedPlace = $_POST['ibuyPlace'];
$storageLoc = $_POST['istoragePlace'];
$purchaseDate = $_POST['buyDate'];
$memo = $_POST['imemo'];

$qryChk = "SELECT iNum FROM items WHERE iNum=".$iNum." AND it_mem=".$uNum;
$rstChk = mysqli_query($conn, $qryChk);
if(!$rstChk || mysqli_num_rows($rstChk) != 1){
	mysqli_close($conn);
	echo "<script>alert('접근할 수 없습니다.'); location.href='main.php';</script>";
	exit;
}

$iNameEsc = mysqli_real_escape_string($conn, $iName);
$warrantyEsc = mysqli_real_escape_string($conn, $warranty);
$purchasedPlaceEsc = mysqli_real_escape_string($conn, $purchasedPlace);
$storageLocEsc = mysqli_real_escape_string($conn, $storageLoc);
$purchaseDateEsc = mysqli_real_escape_string($conn, $purchaseDate);
$memoEsc = mysqli_real_escape_string($conn, $memo);

$newPhotoPath = $oldPhoto;

if(isset($_FILES['itemImg']) && $_FILES['itemImg']['error'] == 0){

	$uploadDir = "uploads/";
	if(!is_dir($uploadDir)){
		mkdir($uploadDir);
	}

	$oriName = $_FILES['itemImg']['name'];
	$tmpName = $_FILES['itemImg']['tmp_name'];

	$pos = strrpos($oriName, ".");
	$ext = "";
	if($pos !== false){
		$ext = substr($oriName, $pos + 1);
	}

	$newName = $uNum . "_" . time();
	if($ext != ""){
		$newName .= "." . $ext;
	}
	$savePath = $uploadDir . $newName;

	if(move_uploaded_file($tmpName, $savePath)){
		$newPhotoPath = $savePath;
	}
}

$newPhotoEsc = mysqli_real_escape_string($conn, $newPhotoPath);

$qry  = "UPDATE items SET ";
$qry .= "iPhoto=".(($newPhotoPath == NULL || $newPhotoPath == "") ? "NULL" : "'$newPhotoEsc'").", ";
$qry .= "iName='$iNameEsc', ";
$qry .= "warranty=".(($warranty == NULL || $warranty == "") ? "NULL" : "'$warrantyEsc'").", ";
$qry .= "purchasedPlace=".(($purchasedPlace == NULL || $purchasedPlace == "") ? "NULL" : "'$purchasedPlaceEsc'").", ";
$qry .= "storage_location=".(($storageLoc == NULL || $storageLoc == "") ? "NULL" : "'$storageLocEsc'").", ";
$qry .= "purchase_date=".(($purchaseDate == NULL || $purchaseDate == "") ? "NULL" : "'$purchaseDateEsc'").", ";
$qry .= "memo=".(($memo == NULL || $memo == "") ? "NULL" : "'$memoEsc'")." ";
$qry .= "WHERE iNum=".$iNum." AND it_mem=".$uNum;

$result = mysqli_query($conn, $qry);

mysqli_close($conn);

if($result){
	echo "<script>alert('수정되었습니다.'); location.href='main.php';</script>";
}else{
	echo "<script>alert('수정 실패'); history.back();</script>";
}
exit;
?>
