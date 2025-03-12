<?php
session_start();

// 로그인 상태 확인
$isLoggedIn = isset($_SESSION['user_id']);

// 관리자 권한 확인 (예시: $_SESSION['role']이 'admin'일 때 관리자)
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

// 로그인 상태와 관리자 권한을 JSON으로 반환
echo json_encode([
    'isLoggedIn' => $isLoggedIn,
    'isAdmin' => $isAdmin
]);
?>
