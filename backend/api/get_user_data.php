<?php
// /backend/api/get_user_data.php

session_start(); // 세션 시작
require_once "../config/database.php"; // 상대 경로로 변경

header("Content-Type: application/json");

// 로그인 상태 체크
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "로그인이 필요합니다."]);
    exit();
}

$userId = $_SESSION['user_id'];

try {
    // 사용자 정보와 포인트 정보 가져오기
    $stmt = $pdo->prepare("
        SELECT u.user_id, u.nickname, 
               IFNULL(p.available_points, 0) AS available_points, 
               IFNULL(p.expiring_points, 0) AS expiring_points
        FROM users u
        LEFT JOIN user_points p ON u.user_id = p.user_id
        WHERE u.user_id = :userId
    ");
    $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
    $stmt->execute();
    $userData = $stmt->fetch();

    if ($userData) {
        echo json_encode($userData);
    } else {
        echo json_encode(["error" => "유효하지 않은 사용자입니다."]);
    }
} catch (PDOException $e) {
    // 에러 메시지를 노출하기보다는 로깅 시스템을 사용하는 것이 좋습니다.
    error_log("Database error: " . $e->getMessage()); 
    echo json_encode(["error" => "데이터베이스 오류 발생"]);
}
?>
