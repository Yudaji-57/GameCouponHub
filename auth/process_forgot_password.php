<?php
// /auth/process_forgot_password.php
session_start();
// database.php 경로 확인 후 올바르게 수정하세요
require_once "/volume1/web/GameCouponHub/backend/config/database.php"; // 올바른 경로

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 이메일 받기
    $email = trim($_POST['email']);

    // 이메일 존재 여부 확인
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch();

        if (!$user) {
            $_SESSION['error_message'] = "이메일 주소가 등록되지 않았습니다.";
            header("Location: ../auth/forgot_password.php");
            exit;
        }

        // 비밀번호 초기화 링크 생성 (간단한 예: 토큰을 통한 비밀번호 리셋)
        $resetToken = bin2hex(random_bytes(16)); // 토큰 생성
        $resetLink = "https://yudaji.synology.me:88/auth/reset_password.php?token=" . $resetToken;

        // 토큰을 DB에 저장
        $stmt = $pdo->prepare("UPDATE users SET reset_token = :resetToken WHERE email = :email");
        $stmt->bindParam(':resetToken', $resetToken);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // 이메일로 비밀번호 리셋 링크 보내기
        $subject = "비밀번호 찾기 요청";
        $message = "안녕하세요, 비밀번호를 재설정하려면 아래 링크를 클릭하세요.\n\n" . $resetLink;
        $headers = "From: no-reply@yourdomain.com";

        if (mail($email, $subject, $message, $headers)) {
            $_SESSION['success_message'] = "비밀번호 재설정 링크가 이메일로 전송되었습니다.";
            header("Location: ../auth/forgot_password.php");
            exit;
        } else {
            $_SESSION['error_message'] = "이메일 전송에 실패했습니다.";
            header("Location: ../auth/forgot_password.php");
            exit;
        }

    } catch (PDOException $e) {
        $_SESSION['error_message'] = "비밀번호 찾기 처리 중 오류가 발생했습니다.";
        header("Location: ../auth/forgot_password.php");
        exit;
    }
} else {
    $_SESSION['error_message'] = "잘못된 접근입니다.";
    header("Location: ../auth/forgot_password.php");
    exit;
}
