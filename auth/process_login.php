<?php
// /auth/process_login.php
session_start(); // 세션 시작

// database.php 경로 확인 후 올바르게 수정하세요
require_once "/volume1/web/GameCouponHub/backend/config/database.php"; // 올바른 경로

// 한국 표준시(KST, UTC+9)로 시간대 설정
date_default_timezone_set('Asia/Seoul');

// POST 요청이 들어왔을 때
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 입력 받은 아이디와 비밀번호
    $userId = $_POST['userId']; // user_id로 변경
    $password = $_POST['password'];

    // SQL 쿼리로 사용자의 아이디와 비밀번호를 확인
    $sql = "SELECT * FROM users WHERE user_id = :userId"; // user_id로 변경
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':userId', $userId); // user_id로 변경
    $stmt->execute();

    // 사용자 존재 여부 확인
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch();

        // 사용자가 블록된 상태인지 확인
        if ($user['blocked'] == 1) {
            // 블록된 사용자
            $_SESSION['error_message'] = "이 계정은 차단된 상태입니다. 관리자에게 문의하세요.";
            header("Location: ../auth/login.php"); // 로그인 페이지로 돌아가기
            exit();
        }

        // 비밀번호 확인 (비밀번호는 해시값으로 저장됨)
        if (password_verify($password, $user['password'])) {
            // 로그인 성공
            // 동적으로 세션에 사용자 정보를 저장
            foreach ($user as $key => $value) {
                $_SESSION[$key] = $value;
            }

            // 로그인 시간을 업데이트
            $updateSql = "UPDATE users SET last_login = NOW() WHERE user_id = :userId"; // user_id로 변경
            $updateStmt = $pdo->prepare($updateSql);
            $updateStmt->bindParam(':userId', $userId); // user_id로 변경
            $updateStmt->execute();

            // 오늘 날짜와 마지막 로그인 날짜 비교
            $lastLoginDate = $user['last_login']; // 마지막 로그인 날짜
            $currentDate = date('Y-m-d'); // 오늘 날짜

            // 마지막 로그인 날짜가 오늘과 다른 경우 포인트 추가
            if (date('Y-m-d', strtotime($lastLoginDate)) != $currentDate) {
                // 포인트 정보 가져오기
                $pointsSql = "SELECT available_points FROM user_points WHERE user_id = :userId";
                $pointsStmt = $pdo->prepare($pointsSql);
                $pointsStmt->bindParam(':userId', $userId);
                $pointsStmt->execute();
                $points = $pointsStmt->fetch();

                // 포인트가 존재하면 20 추가
                if ($points) {
                    $newPoints = $points['available_points'] + 20;
                    $updatePointsSql = "UPDATE user_points SET available_points = :newPoints WHERE user_id = :userId";
                    $updatePointsStmt = $pdo->prepare($updatePointsSql);
                    $updatePointsStmt->bindParam(':newPoints', $newPoints);
                    $updatePointsStmt->bindParam(':userId', $userId);
                    $updatePointsStmt->execute();
                } else {
                    // 포인트 정보가 없으면 새로 추가
                    $insertPointsSql = "INSERT INTO user_points (user_id, available_points) VALUES (:userId, 20)";
                    $insertPointsStmt = $pdo->prepare($insertPointsSql);
                    $insertPointsStmt->bindParam(':userId', $userId);
                    $insertPointsStmt->execute();
                }

                // 마지막 로그인 날짜를 오늘로 업데이트
                $updateLastLoginSql = "UPDATE users SET last_login = NOW() WHERE user_id = :userId";
                $updateLastLoginStmt = $pdo->prepare($updateLastLoginSql);
                $updateLastLoginStmt->bindParam(':userId', $userId);
                $updateLastLoginStmt->execute();
            }

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
