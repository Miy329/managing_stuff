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

$uName = NULL;
$uPw = NULL;
$uPw2 = NULL;
$gender = NULL;
$phone1 = NULL;
$phone2 = NULL;
$phone3 = NULL;
$joinPath = NULL;

$uName = $_POST['uName'];
$uPw = $_POST['uPw'];
$uPw2 = $_POST['uPw2'];
$gender = $_POST['gender'];
$phone1 = $_POST['phone1'];
$phone2 = $_POST['phone2'];
$phone3 = $_POST['phone3'];
$joinPath = $_POST['joinPath'];

$uName = mysqli_real_escape_string($conn, $uName);
$gender = mysqli_real_escape_string($conn, $gender);
$joinPath = mysqli_real_escape_string($conn, $joinPath);

$phone = $phone1 . "-" . $phone2 . "-" . $phone3;
$phone = mysqli_real_escape_string($conn, $phone);

if($uPw != "" || $uPw2 != ""){
	if($uPw != $uPw2){
		mysqli_close($conn);
		echo "<script>alert('비밀번호가 일치하지 않습니다.'); history.back();</script>";
		exit;
	}

	$hashed = password_hash($uPw, PASSWORD_DEFAULT);
	$hashed = mysqli_real_escape_string($conn, $hashed);

	$qry  = "UPDATE member SET ";
	$qry .= "uName='$uName', ";
	$qry .= "uPw='$hashed', ";
	$qry .= "gender='$gender', ";
	$qry .= "phone='$phone', ";
	$qry .= "joinPath='$joinPath' ";
	$qry .= "WHERE uNum=".$uNum;

}else{
	$qry  = "UPDATE member SET ";
	$qry .= "uName='$uName', ";
	$qry .= "gender='$gender', ";
	$qry .= "phone='$phone', ";
	$qry .= "joinPath='$joinPath' ";
	$qry .= "WHERE uNum=".$uNum;
}

$result = mysqli_query($conn, $qry);

mysqli_close($conn);

if($result){
	$_SESSION['uName'] = $uName;
	echo "<script>alert('회원정보가 수정되었습니다.'); location.href='main.php';</script>";
}else{
	echo "<script>alert('회원정보 수정 실패'); history.back();</script>";
}
exit;
?>
