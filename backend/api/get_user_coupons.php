<?php
// /backend/api/get_user_coupons.php

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
    $stmt = $pdo->prepare("
        SELECT game_name, coupon_code, expiry_date,
               CASE 
                   WHEN expiry_date < CURDATE() THEN 'expired'
                   ELSE 'valid'
               END AS status
        FROM coupons
        WHERE user_id = :userId
        ORDER BY expiry_date DESC
    ");
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $coupons = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($coupons);
} catch (PDOException $e) {
    echo json_encode(["error" => "데이터베이스 오류 발생: " . $e->getMessage()]);
}
?>
