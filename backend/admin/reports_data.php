<?php
// /backend/admin/reports_data.php
require_once "/volume1/web/GameCouponHub/backend/config/database.php"; // 데이터베이스 연결

header('Content-Type: application/json'); // 응답을 JSON 형식으로 반환

// 제보 데이터 가져오기
try {
    // index 컬럼 추가
    $sql = "SELECT `index`, user_id, game_name, coupon_code, reward_details, created_at FROM coupons_report";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // 결과 가져오기
    $reports = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // JSON 형식으로 응답 반환
    echo json_encode(['reports' => $reports]);
} catch (Exception $e) {
    // 오류 발생 시 JSON 형식으로 오류 메시지 반환
    echo json_encode(['error' => '제보 데이터를 불러오는 중 오류가 발생했습니다.']);
}
?>
