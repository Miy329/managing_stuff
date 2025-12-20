<?php
// out.php
session_start();
?>
<html >
<head>
<title>로그아웃 확인</title>
<style>
body{
  margin:0;
  height:100vh;
  display:flex;
  justify-content:center;
  align-items:center;
  background:#f5f5f5;
  font-family:Arial, sans-serif;
}

.box{
  background:white;
  padding:40px;
  border-radius:10px;
  text-align:center;
  box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

.btnWrap{
  margin-top:30px;
  display:flex;
  gap:20px;
  justify-content:center;
}

button{
  width:120px;
  padding:10px;
  font-size:16px;
  border:none;
  border-radius:6px;
  cursor:pointer;
}

.btn-no{
  background:#ccc;
}

.btn-yes{
  background:#334;
  color:white;
}
</style>
</head>
<body>

<div class="box">
  <h2>로그아웃 하시겠습니까?</h2>

  <div class="btnWrap">
    <button class="btn-no" onclick="location.href='main.php'">아니오</button>
    <button class="btn-yes" onclick="location.href='logout.php'">네</button>
  </div>
</div>

</body>
</html>
