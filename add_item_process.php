<?php
session_start();

if(!isset($_SESSION['uNum'])){
    header("Location: login.php");
    exit;
}

$uNum = $_SESSION['uNum'];

$iName          = NULL;
$warranty       = NULL;
$purchasedPlace = NULL;
$storageLoc     = NULL;
$purchaseDate   = NULL;
$memo           = NULL;
// 폼에서 받아서 변수에 넣기
$iName          = $_POST['iName'];
$warranty       = $_POST['iasP'];
$purchasedPlace = $_POST['ibuyPlace'];
$storageLoc     = $_POST['istoragePlace'];
$purchaseDate   = $_POST['buyDate'];
$memo           = $_POST['imemo'];

$iPhoto = NULL;

if(isset($_FILES['itemImg']) && $_FILES['itemImg']['error'] == 0){

    $uploadDir = "uploads/";
    if(!is_dir($uploadDir)){
        mkdir($uploadDir);
    }

    $oriName = $_FILES['itemImg']['name'];
    $tmpName = $_FILES['itemImg']['tmp_name'];

    $pos = strrpos($oriName, ".");
    $ext = substr($oriName, $pos + 1);

    $newName = $uNum . "_" . time() . "." . $ext;
    $savePath = $uploadDir . $newName;

    if(move_uploaded_file($tmpName, $savePath)){
        $iPhoto = $savePath;
    }
}

$conn = mysqli_connect("localhost", "root", "", "project01_db");
if(!$conn){
    die("DB 연결 실패");
}
//mysqli_set_charset($conn, "utf8mb4");

$qry  = "INSERT INTO items (it_mem, iPhoto, iName, warranty, purchasedPlace, storage_location, purchase_date, memo) VALUES (";

$qry .= "'$uNum', ";
$qry .= ($iPhoto === NULL ? "NULL, " : "'$iPhoto', ");
$qry .= ($iName === NULL || $iName === '' ? "NULL, " : "'$iName', ");
$qry .= ($warranty === NULL || $warranty === '' ? "NULL, " : "'$warranty', ");
$qry .= ($purchasedPlace === NULL || $purchasedPlace === '' ? "NULL, " : "'$purchasedPlace', ");
$qry .= ($storageLoc === NULL || $storageLoc === '' ? "NULL, " : "'$storageLoc', ");
$qry .= ($purchaseDate === NULL || $purchaseDate === '' ? "NULL, " : "'$purchaseDate', ");
$qry .= ($memo === NULL || $memo === '' ? "NULL" : "'$memo'");
$qry .= ")";
// 값 + 자료형 둘 다 비교->===

$result = mysqli_query($conn, $qry);

if($result){
    echo "<script>
        alert('물건이 등록되었습니다.');
        location.href='main.php';
    </script>";
}else{
    echo "<script>
        alert('물건 등록 실패');
        history.back();
    </script>";
}

mysqli_close($conn);
exit;
?>
