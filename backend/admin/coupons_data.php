<?php
// /admin/coupons_data.php

require_once "/volume1/web/GameCouponHub/backend/config/database.php"; // 올바른 경로

header('Content-Type: application/json');

// 쿠폰 데이터 가져오기
$sql = "SELECT coupon_code, game_name, reward_details FROM coupons";
$stmt = $pdo->prepare($sql);
$stmt->execute();

// 결과 가져오기
$coupons = $stmt->fetchAll(PDO::FETCH_ASSOC);

// JSON 형식으로 응답 반환
echo json_encode(['coupons' => $coupons]);
?>
