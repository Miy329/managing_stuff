<?php
session_start();
session_unset();
session_destroy(); // 세션 강제 삭제

header("Location: login.php"); //로그인 페이지로 이동
exit;
?>