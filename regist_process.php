<?php
// regist_process.php
$uID = NULL;
$uName = NULL;
$uPw = NULL;
$uPw2 = NULL;
$gender = NULL;
$phone1 = NULL;
$phone2 = NULL;
$phone3 = NULL;
$joinPath = NULL;

$uID    = $_POST['uID'];
$uName  = $_POST['uName'];
$uPw    = $_POST['uPw'];
$uPw2   = $_POST['uPw2'];
$gender = $_POST['gender'];
$phone1 = $_POST['phone1'];
$phone2 = $_POST['phone2'];
$phone3 = $_POST['phone3'];
$joinPath = $_POST['joinPath'];

//  비밀번호 확인
if ($uPw != $uPw2) {
    echo "<script>
        alert('비밀번호가 일치하지 않습니다.');
        history.back();
    </script>";
    exit;
}
$phone = $phone1 . "-" . $phone2 . "-" . $phone3;

//비밀번호 암호화해서 저장 
$hashPw = password_hash($uPw, PASSWORD_DEFAULT);

// DB 연결
$conn = mysqli_connect("localhost", "root", "", "project01_db");
if (!$conn) {
    die("DB 연결 실패!");
}
mysqli_set_charset($conn, "utf8mb4");

// INSERT 쿼리 
$qry  = "INSERT INTO member (uID, uName, uPw, gender, phone,  joinPath) ";
$qry .= "VALUES (";
$qry .= "'$uID', ";
$qry .= "'$uName', ";
$qry .= "'$hashPw', ";
$qry .= "'$gender', ";
$qry .= "'$phone', ";
$qry .= "'$joinPath'";
$qry .= ")";

$result = mysqli_query($conn, $qry);

if ($result) {
    echo "<script>
        alert('회원가입이 완료되었습니다.');
        location.href='login.php';
    </script>";
} else {
    echo "<script>
        alert('회원가입 실패');
        history.back();
    </script>";
}

mysqli_close($conn);
?>
