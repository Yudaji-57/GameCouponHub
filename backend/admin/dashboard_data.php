<?php
// /backend/admin/dashboard_data.php

require_once "/volume1/web/GameCouponHub/backend/config/database.php"; // 데이터베이스 연결

header('Content-Type: application/json');

try {
    // 대시보드 통계 조회
    $statsQuery = "
        SELECT 
            (SELECT COUNT(*) FROM users) AS totalUsers,
            (SELECT COUNT(*) FROM coupons_report) AS totalReports,
            (SELECT COUNT(*) FROM coupons) AS totalCoupons,
            (SELECT COUNT(*) FROM coupons_report WHERE DATE(created_at) = CURDATE()) AS todayReports,
            (SELECT COUNT(*) FROM coupons_report) + (SELECT COUNT(*) FROM coupons) AS totalCouponsAndReports
    ";
    // PDO 실행
    $statsResult = $pdo->query($statsQuery);
    $stats = $statsResult->fetch(PDO::FETCH_ASSOC) ?? [
        'totalUsers' => 0,
        'totalReports' => 0,
        'totalCoupons' => 0,
        'todayReports' => 0,
        'totalCouponsAndReports' => 0
    ];

    // 월별 쿠폰 제보 통계 조회
    $monthlyQuery = "
    SELECT DATE_FORMAT(created_at, '%Y-%m') AS month, COUNT(*) AS count 
    FROM coupons_report 
    GROUP BY month 
    ORDER BY month
";
    $monthlyResult = $pdo->query($monthlyQuery);
    $months = [];
    $monthlyReports = [];
    while ($row = $monthlyResult->fetch(PDO::FETCH_ASSOC)) {
        $months[] = $row['month'];
        $monthlyReports[] = $row['count'];
    }

    // 최근 쿠폰 제보 리스트
    $reportsQuery = "
    SELECT user_id, game_name, coupon_code, reward_details, DATE_FORMAT(created_at, '%Y-%m-%d') AS created_at 
    FROM coupons_report 
    ORDER BY created_at DESC 
    LIMIT 10
";
    $reportsResult = $pdo->query($reportsQuery);
    $recentReports = [];
    while ($row = $reportsResult->fetch(PDO::FETCH_ASSOC)) {
        $recentReports[] = $row;
    }

    // 응답 반환
    echo json_encode([
        "status" => "success",
        "totalUsers" => $stats['totalUsers'],
        "totalReports" => $stats['totalReports'],
        "totalCoupons" => $stats['totalCoupons'],
        "totalCouponsAndReports" => $stats['totalCouponsAndReports'],
        "todayReports" => $stats['todayReports'],
        "months" => $months,
        "monthlyReports" => $monthlyReports,
        "recentReports" => $recentReports
    ]);
} catch (PDOException $e) {
    // 예외 처리: DB 오류 시 JSON 응답 반환
    echo json_encode([
        "status" => "error",
        "message" => "데이터베이스 오류: " . $e->getMessage()
    ]);
}
?>
