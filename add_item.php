<?php
// add_item.php
session_start();

if(!isset($_SESSION['uNum'])){
    header("Location: login.php");
    exit;
}

?>

<html>
<head>
<title>물건 등록</title>

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

.btn-area{
    text-align:right;
    padding-top:15px;
}
</style>

</head>
<body>

<h1>물건 등록</h1>

<form action="add_item_process.php" method="post" enctype="multipart/form-data">

<!-- 등록일-< db에 저장 -->
<input type="hidden" name="iDate" value="<?=$today?>">

<table>

<tr>
    <td class="ttl">물건 사진</td>
    <td>
        <input type="file" name="itemImg" accept="image/*">
    </td>
</tr>

<tr>
    <td class="ttl">물건 이름</td>
    <td>
        <input type="text" name="iName" required>
    </td>
</tr>

<tr>
    <td class="ttl">AS 기간</td>
    <td>
        <input type="text" name="iasP" placeholder="예: 1년 / 무상 2년">
    </td>
</tr>

<tr>
    <td class="ttl">구매처</td>
    <td>
        <input type="text" name="ibuyPlace" placeholder="예: 쿠팡, 매장 구매">
    </td>
</tr>


<tr>
    <td class="ttl">보관 위치</td>
    <td>
        <input type="text" name="istoragePlace" placeholder="예: 옷장 위, 서랍">
    </td>
</tr>

<tr>
    <td class="ttl">구매일</td>
    <td>
        <input type="date" name="buyDate">
    </td>
</tr>

<tr>
    <td class="ttl">메모</td>
    <td>
        <textarea name="imemo" rows="5"
        placeholder="물건 관련 메모를 입력하세요"></textarea>
    </td>
</tr>

</table>

<div class="btn-area">
    <input type="button" value="뒤로" onclick="location.href='main.php'">
<button type="submit"  value='LogIn' >물건 등록</button>
</div>

</form>

</body>
</html>
