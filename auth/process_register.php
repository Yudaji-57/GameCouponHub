<?php
// /auth/process_register.php
session_start();
// database.php 경로 확인 후 올바르게 수정하세요
require_once "/volume1/web/GameCouponHub/backend/config/database.php"; // 올바른 경로


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 입력값 받기
    $username = trim($_POST['username']);
    $nickname = trim($_POST['nickname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // 비밀번호 확인
    if ($password !== $confirmPassword) {
        $_SESSION['error_message'] = "비밀번호가 일치하지 않습니다.";
        header("Location: ../auth/register.php");
        exit;
    }

    // 비밀번호 해싱
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        // 사용자 존재 여부 확인
        $stmt = $pdo->prepare("SELECT user_id, email FROM users WHERE user_id = :username OR email = :email");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch();

        if ($user) {
            $_SESSION['error_message'] = "이미 존재하는 아이디나 이메일입니다.";
            header("Location: ../auth/register.php");
            exit;
        }

        // 사용자 정보 삽입
        $stmt = $pdo->prepare("INSERT INTO users (user_id, password, nickname, email) VALUES (:username, :password, :nickname, :email)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':nickname', $nickname);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // 회원가입 성공 후 로그인 페이지로 리디렉션
        $_SESSION['success_message'] = "회원가입이 완료되었습니다. 로그인 해주세요.";
        header("Location: ../auth/login.php");
        exit;

    } catch (PDOException $e) {
        $_SESSION['error_message'] = "회원가입 처리 중 오류가 발생했습니다.";
        header("Location: ../auth/register.php");
        exit;
    }
} else {
    $_SESSION['error_message'] = "잘못된 접근입니다.";
    header("Location: ../auth/register.php");
    exit;
}
