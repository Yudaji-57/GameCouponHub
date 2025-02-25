<?php
// /backend/admin/dashboard_data.php

require_once "/volume1/web/GameCouponHub/backend/config/database.php"; // 데이터베이스 연결

header('Content-Type: application/json');

try {
    // 대시보드 통계 조회 (한 번의 쿼리로 처리)
    $statsQuery = "
        SELECT 
            (SELECT COUNT(*) FROM users) AS totalUsers,
            (SELECT COUNT(*) FROM coupons_report) AS totalReports,
            (SELECT COUNT(*) FROM coupons) AS totalCoupons,
            (SELECT COUNT(*) FROM coupons_report WHERE DATE(created_at) = CURDATE()) AS todayReports
    ";
    $stats = $pdo->query($statsQuery)->fetch(PDO::FETCH_ASSOC) ?? [
        'totalUsers' => 0,
        'totalReports' => 0,
        'totalCoupons' => 0,
        'todayReports' => 0
    ];

    // 월별 쿠폰 제보 통계 조회
    $monthlyQuery = "
        SELECT YEAR(created_at) AS year, MONTH(created_at) AS month, COUNT(*) AS count 
        FROM coupons_report 
        WHERE YEAR(created_at) = YEAR(CURDATE()) 
        GROUP BY year, month 
        ORDER BY year, month
    ";
    $monthlyResult = $pdo->query($monthlyQuery);
    $months = [];
    $monthlyReports = [];
    while ($row = $monthlyResult->fetch(PDO::FETCH_ASSOC)) {
        $months[] = sprintf("%04d-%02d", $row['year'], $row['month']); // YYYY-MM 형식
        $monthlyReports[] = (int) $row['count'];
    }

    // 데이터가 없을 경우 기본값 설정
    if (empty($months)) {
        $months[] = date("Y-m");
        $monthlyReports[] = 0;
    }

    // 최근 쿠폰 제보 리스트 (최대 10개)
    $reportsQuery = "
        SELECT user_id, game_name, coupon_code, reward_details AS reward, DATE_FORMAT(created_at, '%Y-%m-%d') AS created_at 
        FROM coupons_report 
        ORDER BY created_at DESC 
        LIMIT 10
    ";
    $recentReports = $pdo->query($reportsQuery)->fetchAll(PDO::FETCH_ASSOC);

    // JSON 응답 반환
    echo json_encode([
        "status" => "success",
        "totalUsers" => $stats['totalUsers'],
        "totalReports" => $stats['totalReports'],
        "totalCoupons" => $stats['totalCoupons'],
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
