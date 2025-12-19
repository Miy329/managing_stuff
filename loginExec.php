<?php
// loginExec.php
session_start();

// DB 연결
$conn = mysqli_connect("localhost", "root", "", "project01_db");
if(!$conn){
	die("DB 연결 실패: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8mb4");

// 잘못된 접근 차단 (주소창 직접 접근 방지)
if(!isset($_POST['ID']) || !isset($_POST['PW'])){
	echo "<script>alert('잘못된 접근입니다.'); location.href='login.php';</script>";
	exit;
}

$inID = mysqli_real_escape_string($conn, $_POST['ID']);
$inPW = $_POST['PW'];

// 아이디로 사용자 조회
$qry = "SELECT * FROM users_tbl WHERE uID='".$inID."'";
$rst = mysqli_query($conn, $qry);

if($rst && mysqli_num_rows($rst) == 1){
	$row = mysqli_fetch_assoc($rst);

	// 비밀번호 확인
	if(password_verify($inPW, $row['uPw'])){
		// 로그인 성공 → 세션 저장
		$_SESSION['uNum']  = $row['uNum'];
		$_SESSION['uID']   = $row['uID'];
		$_SESSION['uName'] = $row['uName'];

		header("Location: purchase_list.php");
		exit;
	}
}

// 로그인 실패
echo "<script>alert('아이디 또는 비밀번호가 틀렸습니다.'); history.back();</script>";
exit;
?>
