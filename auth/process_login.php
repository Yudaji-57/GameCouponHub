<?php
// /auth/process_login.php
session_start(); // 세션 시작

// database.php 경로 확인 후 올바르게 수정하세요
require_once "/volume1/web/GameCouponHub/backend/config/database.php"; // 올바른 경로

// POST 요청이 들어왔을 때
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 입력 받은 아이디와 비밀번호
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL 쿼리로 사용자의 아이디와 비밀번호를 확인
    $sql = "SELECT * FROM users WHERE user_id = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    // 사용자 존재 여부 확인
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch();

        // 비밀번호 확인 (비밀번호는 해시값으로 저장됨)
        if (password_verify($password, $user['password'])) {
            // 로그인 성공
            // 동적으로 세션에 사용자 정보를 저장
            foreach ($user as $key => $value) {
                $_SESSION[$key] = $value;
            }

            // 로그인 시간을 업데이트
            $updateSql = "UPDATE users SET last_login = NOW() WHERE user_id = :username";
            $updateStmt = $pdo->prepare($updateSql);
            $updateStmt->bindParam(':username', $username);
            $updateStmt->execute();

            // 로그인 성공 후 리다이렉트
            header("Location: ../pages/index.php"); // 로그인 후 홈으로 이동
            exit();
        } else {
            // 비밀번호 불일치
            $_SESSION['error_message'] = "아이디나 비밀번호가 잘못되었습니다.";
            header("Location: ../auth/login.php"); // 로그인 페이지로 돌아가기
            exit();
        }
    } else {
        // 사용자 없음
        $_SESSION['error_message'] = "아이디나 비밀번호가 잘못되었습니다.";
        header("Location: ../auth/login.php"); // 로그인 페이지로 돌아가기
        exit();
    }
} else {
    // POST 요청이 아닌 경우 로그인 페이지로 리다이렉트
    header("Location: ../auth/login.php");
    exit();
}
?>
