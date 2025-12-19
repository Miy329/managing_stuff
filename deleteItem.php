<?php
// deleteItem.php
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

// POST로 pNum 안 넘어오면 차단
if(!isset($_POST['pNum'])){
	echo "<script>alert('잘못된 접근'); location.href='purchase_list.php';</script>";
	exit;
}

$uNum = $_SESSION['uNum'];
$pNum = intval($_POST['pNum']);

// 1) 내 물건인지 먼저 확인 + 사진 경로 가져오기
$qry = "SELECT photoPath FROM purchase_tbl WHERE pNum=$pNum AND uNum=$uNum";
$rst = mysqli_query($conn, $qry);

if(mysqli_num_rows($rst) != 1){
	echo "<script>alert('삭제 권한이 없습니다'); location.href='purchase_list.php';</script>";
	exit;
}

$row = mysqli_fetch_assoc($rst);
$photoPath = $row['photoPath'];

// 2) 사진 파일 삭제
if($photoPath != "" && file_exists($photoPath)){
	unlink($photoPath);
}

// 3) DB 레코드 삭제
$qry = "DELETE FROM purchase_tbl WHERE pNum=$pNum AND uNum=$uNum";
mysqli_query($conn, $qry);

// 4) 목록으로 복귀
header("Location: purchase_list.php");
exit;
?>
