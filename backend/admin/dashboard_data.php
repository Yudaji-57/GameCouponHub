<?php
// /backend/admin/dashboard_data.php

require_once "/volume1/web/GameCouponHub/backend/config/database.php"; // 데이터베이스 연결

header('Content-Type: application/json');

ob_clean(); // 출력 버퍼를 클리어

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
        SELECT user_id, game_name, coupon_code, reward_details AS reward, 
               DATE_FORMAT(created_at, '%Y-%m-%d') AS created_at, 
               issue_date, expiration_date, approval_status
        FROM coupons_report 
        ORDER BY created_at DESC 
        LIMIT 10
    ";
    $recentReports = $pdo->query($reportsQuery)->fetchAll(PDO::FETCH_ASSOC);

    // 승인 여부 (0: 대기, 1: 승인, 2: 거절)
    foreach ($recentReports as &$report) {
        switch ($report['approval_status']) {
            case 0:
                $report['approval_status_label'] = '대기';
                break;
            case 1:
                $report['approval_status_label'] = '승인';
                break;
            case 2:
                $report['approval_status_label'] = '거절';
                break;
            default:
                $report['approval_status_label'] = '알 수 없음';
                break;
        }
    }

    // JSON 응답 반환
    echo json_encode([ 
        "status" => "success",
        "data" => [
            "totalUsers" => $stats['totalUsers'],
            "totalReports" => $stats['totalReports'],
            "totalCoupons" => $stats['totalCoupons'],
            "todayReports" => $stats['todayReports'],
            "months" => $months,
            "monthlyReports" => $monthlyReports,
            "recentReports" => $recentReports // approval_status_label이 포함된 배열 반환
        ]
    ]);
} catch (PDOException $e) {
    // 예외 처리: DB 오류 시 JSON 응답 반환
    echo json_encode([
        "status" => "error",
        "message" => "데이터베이스 오류: " . $e->getMessage()
    ]);
}
?>
