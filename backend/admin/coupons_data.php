<?php
// /backend/admin/coupons_data.php
require_once "/volume1/web/GameCouponHub/backend/config/database.php"; // 데이터베이스 연결

header('Content-Type: application/json'); // 응답이 JSON임을 명시

// 쿠폰 데이터 가져오기 및 만료된 쿠폰 처리
try {
    // 만료된 쿠폰의 isExpired 값을 true로 업데이트 (PHP 내에서 실행)
    $updateSql = "UPDATE coupons SET isExpired = 1 WHERE expiry_date < CURDATE() AND isExpired = 0";
    $pdo->prepare($updateSql)->execute();

    // SQL 쿼리에서 DATE() 함수로 날짜만 추출하고, 만약 만료일이 없으면 NULL 처리
    $sql = "SELECT 
                game_name, 
                coupon_code, 
                reward_details, 
                DATE(issue_date) AS issue_date,  -- issue_date에서 날짜만 추출
                CASE WHEN expiry_date IS NULL THEN NULL ELSE DATE(expiry_date) END AS expiry_date,  -- expiry_date가 NULL이면 NULL로 반환
                DATE(coupon_created_at) AS coupon_created_at,  -- coupon_created_at에서 날짜만 추출
                coupon_type, 
                isExpired 
            FROM coupons";
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
