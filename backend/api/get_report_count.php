<?php
// /backend/api/get_report_count.php

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
    $stmt = $pdo->prepare("SELECT COUNT(*) AS report_count FROM coupons_report WHERE user_id = :userId");
    $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
    $stmt->execute();
    $reportData = $stmt->fetch();

    echo json_encode(["report_count" => $reportData ? $reportData['report_count'] : 0]);
} catch (PDOException $e) {
    echo json_encode(["error" => "데이터베이스 오류 발생: " . $e->getMessage()]);
}
?>
