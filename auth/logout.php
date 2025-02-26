<!-- /auth/logout.php -->
<?php
session_start();
session_unset(); // 모든 세션 변수 해제
session_destroy(); // 세션 종료

header("Location: /auth/login.php"); // 로그인 페이지로 리다이렉트
exit();
?>
