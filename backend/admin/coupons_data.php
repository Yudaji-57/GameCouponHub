<?php
// /backend/admin/dashboard_data.php
require_once "/volume1/web/GameCouponHub/backend/config/database.php"; // 데이터베이스 연결

header('Content-Type: application/json'); // 응답이 JSON임을 명시

try {
    // 전체 사용자 수
    $sqlUsers = "SELECT COUNT(*) AS total_users FROM users";
    $stmtUsers = $pdo->prepare($sqlUsers);
    $stmtUsers->execute();
    $totalUsers = $stmtUsers->fetch(PDO::FETCH_ASSOC)['total_users'];

    // 쿠폰 제보 수
    $sqlReports = "SELECT COUNT(*) AS total_reports FROM coupons_report";
    $stmtReports = $pdo->prepare($sqlReports);
    $stmtReports->execute();
    $totalReports = $stmtReports->fetch(PDO::FETCH_ASSOC)['total_reports'];

    // 총 쿠폰 수
    $sqlCoupons = "SELECT COUNT(*) AS total_coupons FROM coupons";
    $stmtCoupons = $pdo->prepare($sqlCoupons);
    $stmtCoupons->execute();
    $totalCoupons = $stmtCoupons->fetch(PDO::FETCH_ASSOC)['total_coupons'];

    // 오늘의 신규 제보 수
    $today = date('Y-m-d');
    $sqlTodayReports = "SELECT COUNT(*) AS today_reports FROM coupons_report WHERE DATE(created_at) = :today";
    $stmtTodayReports = $pdo->prepare($sqlTodayReports);
    $stmtTodayReports->bindParam(':today', $today);
    $stmtTodayReports->execute();
    $todayReports = $stmtTodayReports->fetch(PDO::FETCH_ASSOC)['today_reports'];

    // 월별 쿠폰 제보 통계
    $sqlMonthlyReports = "
        SELECT 
            MONTH(created_at) AS month,
            COUNT(*) AS report_count
        FROM coupons_report
        WHERE YEAR(created_at) = YEAR(CURRENT_DATE)
        GROUP BY MONTH(created_at)
        ORDER BY month ASC
    ";
    $stmtMonthlyReports = $pdo->prepare($sqlMonthlyReports);
    $stmtMonthlyReports->execute();
    $monthlyReports = $stmtMonthlyReports->fetchAll(PDO::FETCH_ASSOC);

    // 데이터 포맷팅
    $months = [];
    $monthlyData = [];
    foreach ($monthlyReports as $report) {
        $months[] = $report['month'] . '월';
        $monthlyData[] = (int) $report['report_count'];
    }

    // JSON 형식으로 응답 반환
    echo json_encode([
        'totalUsers' => $totalUsers,
        'totalReports' => $totalReports,
        'totalCoupons' => $totalCoupons,
        'todayReports' => $todayReports,
        'months' => $months,
        'monthlyReports' => $monthlyData
    ]);
} catch (Exception $e) {
    // 예외 처리: 오류 발생 시
    echo json_encode(['error' => '대시보드 데이터를 불러오는 중 오류가 발생했습니다.']);
}
?>


<?php
// /backend/admin/coupons_data.php
require_once "/volume1/web/GameCouponHub/backend/config/database.php"; // 데이터베이스 연결

header('Content-Type: application/json'); // 응답이 JSON임을 명시

// 쿠폰 데이터 가져오기
try {
    $sql = "SELECT game_name, coupon_code, reward_details, issue_date, expiration_date, created_at FROM coupons";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // 결과 가져오기
    $coupons = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // JSON 형식으로 응답 반환
    echo json_encode(['coupons' => $coupons]);
} catch (Exception $e) {
    // 예외 처리: 오류 발생 시
    echo json_encode(['error' => '데이터를 불러오는 중 오류가 발생했습니다.']);
}
?>
