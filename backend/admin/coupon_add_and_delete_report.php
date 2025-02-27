<?php
// /backend/admin/coupon_add_and_update_report_status.php
require_once "/volume1/web/GameCouponHub/backend/config/database.php"; // 데이터베이스 연결

// POST 요청으로 받은 데이터 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 전달받은 쿠폰 데이터
    $gameName = $_POST['game_name'];
    $couponCode = $_POST['coupon_code'];
    $rewardDetails = $_POST['reward_details'];
    $issueDate = $_POST['issue_date'];
    $expirationDate = $_POST['expiration_date'];  // 만료일 처리
    $couponType = $_POST['coupon_type'];
    
    // 전달받은 report_id (제보 상태 업데이트용)
    $reportId = $_POST['report_id'];

    try {
        // 1. 데이터베이스에 쿠폰 추가
        $sql = "INSERT INTO coupons (game_name, coupon_code, reward_details, issue_date, expiry_date, coupon_type) 
                VALUES (:game_name, :coupon_code, :reward_details, :issue_date, :expiry_date, :coupon_type)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':game_name', $gameName);
        $stmt->bindParam(':coupon_code', $couponCode);
        $stmt->bindParam(':reward_details', $rewardDetails);
        $stmt->bindParam(':issue_date', $issueDate);
        $stmt->bindParam(':expiry_date', $expirationDate);  // 만료일 바인딩
        $stmt->bindParam(':coupon_type', $couponType);
        $stmt->execute();

        // 2. 제보의 승인 상태 업데이트
        // 제보 승인 상태는 1 (승인)로 설정
        $sqlUpdate = "UPDATE coupons_report SET approval_status = 1 WHERE `index` = :report_id";
        $stmtUpdate = $pdo->prepare($sqlUpdate);
        $stmtUpdate->bindParam(':report_id', $reportId, PDO::PARAM_INT);
        $stmtUpdate->execute();

        // 상태 업데이트된 행의 수 확인
        if ($stmtUpdate->rowCount() > 0) {
            echo json_encode(['success' => true, 'message' => '쿠폰 등록 및 제보 승인 완료']);
        } else {
            echo json_encode(['success' => false, 'message' => '제보 승인 실패: 해당 제보를 찾을 수 없습니다.']);
        }
    } catch (Exception $e) {
        // 오류 처리
        echo json_encode(['success' => false, 'message' => "처리 중 오류가 발생했습니다: " . $e->getMessage()]);
    }
}
?>
