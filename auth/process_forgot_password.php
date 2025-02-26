<?php
// /auth/process_forgot_password.php
session_start();

// database.php 파일을 포함하여 $pdo 객체를 사용할 수 있게 해야 합니다.
require_once '/volume1/web/GameCouponHub/backend/config/database.php'; // 경로에 맞게 수정

// Composer autoload 파일을 포함
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
            header("Location: /auth/forgot_password.php");
            exit;
        }

        // 비밀번호 초기화 링크 생성 (간단한 예: 토큰을 통한 비밀번호 리셋)
        $resetToken = bin2hex(random_bytes(16)); // 토큰 생성
        $resetLink = "https://yudaji.synology.me:8801/auth/reset_password.php?token=" . $resetToken;

        // 토큰을 DB에 저장
        $stmt = $pdo->prepare("UPDATE users SET reset_token = :resetToken WHERE email = :email");
        $stmt->bindParam(':resetToken', $resetToken);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // PHPMailer를 사용하여 이메일 전송
        $mail = new PHPMailer(true);

        try {
            // 서버 설정
            $mail->isSMTP();
            $mail->Host = 'smtp.yudaji.synology.me';  // SMTP 서버 주소 (예: Gmail, SMTP 서버 주소 입력)
            $mail->SMTPAuth = true;
            $mail->Username = 'couponhub@yudaji.synology.me'; // SMTP 인증 사용자
            $mail->Password = 'A7a127fa5!@#'; // SMTP 비밀번호
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;  // SMTP 포트

            // 수신자 설정
            $mail->setFrom('couponhub@yudaji.synology.me', 'No Reply');
            $mail->addAddress($email);

            // 내용 설정
            $mail->isHTML(true);
            $mail->Subject = '비밀번호 찾기 요청';
            $mail->Body    = '안녕하세요, 비밀번호를 재설정하려면 아래 링크를 클릭하세요.<br><br>' . $resetLink;

            $mail->send();
            $_SESSION['success_message'] = "비밀번호 재설정 링크가 이메일로 전송되었습니다.";
            header("Location: /auth/forgot_password.php");
            exit;
        } catch (Exception $e) {
            $_SESSION['error_message'] = "이메일 전송에 실패했습니다: {$mail->ErrorInfo}";
            header("Location: /auth/forgot_password.php");
            exit;
        }

    } catch (PDOException $e) {
        $_SESSION['error_message'] = "비밀번호 찾기 처리 중 오류가 발생했습니다: " . $e->getMessage();
        header("Location: /auth/forgot_password.php");
        exit;
    }
} else {
    $_SESSION['error_message'] = "잘못된 접근입니다.";
    header("Location: /auth/forgot_password.php");
    exit;
}
?>
