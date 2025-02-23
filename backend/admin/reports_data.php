<?php
// /admin/reports_data.php

require_once "/volume1/web/GameCouponHub/backend/config/database.php"; // 올바른 경로

// 쿠폰 제보 목록 가져오기
$sql = "SELECT user_id, game_name, coupon_code, reward_details, created_at FROM coupons_report ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$reports = $stmt->fetchAll();

// JSON 형태로 반환
echo json_encode([
    'reports' => $reports,
]);
?>
