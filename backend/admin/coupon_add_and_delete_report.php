<?php
// /backend/admin/coupon_add_and_update_report_status.php
require_once "/volume1/web/GameCouponHub/backend/config/database.php"; // 데이터베이스 연결

// POST 요청 확인
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // 필수 데이터 가져오기
        $gameName = $_POST['game_name'] ?? null;
        $couponCode = $_POST['coupon_code'] ?? null;
        $rewardDetails = $_POST['reward_details'] ?? null;
        $issueDate = $_POST['issue_date'] ?? null;
        $expirationDate = $_POST['expiration_date'] ?? null; // 선택 입력값
        $couponType = $_POST['coupon_type'] ?? null;
        $reportId = $_POST['report_id'] ?? null;

        // 입력값 유효성 검사
        if (!$gameName || !$couponCode || !$rewardDetails || !$issueDate || !$couponType || !$reportId) {
            echo json_encode(['success' => false, 'message' => '필수 입력값이 누락되었습니다.']);
            exit();
        }

        // 트랜잭션 시작
        $pdo->beginTransaction();

        // 1. 쿠폰 테이블에 데이터 삽입
        $sqlInsert = "INSERT INTO coupons (game_name, coupon_code, reward_details, issue_date, expiry_date, coupon_type) 
                      VALUES (:game_name, :coupon_code, :reward_details, :issue_date, :expiry_date, :coupon_type)";
        $stmt = $pdo->prepare($sqlInsert);
        $stmt->bindValue(':game_name', $gameName, PDO::PARAM_STR);
        $stmt->bindValue(':coupon_code', $couponCode, PDO::PARAM_STR);
        $stmt->bindValue(':reward_details', $rewardDetails, PDO::PARAM_STR);
        $stmt->bindValue(':issue_date', $issueDate, PDO::PARAM_STR);
        $stmt->bindValue(':expiry_date', $expirationDate, PDO::PARAM_STR);
        $stmt->bindValue(':coupon_type', $couponType, PDO::PARAM_STR);

        if (!$stmt->execute()) {
            throw new Exception('쿠폰 등록 실패: ' . json_encode($stmt->errorInfo()));
        }

        // 2. 쿠폰 제보 상태 업데이트 (승인 처리)
        $sqlUpdate = "UPDATE coupons_report SET approval_status = 1 WHERE `index` = :report_id";
        $stmtUpdate = $pdo->prepare($sqlUpdate);
        $stmtUpdate->bindValue(':report_id', $reportId, PDO::PARAM_INT);

        if (!$stmtUpdate->execute()) {
            throw new Exception('제보 승인 실패: ' . json_encode($stmtUpdate->errorInfo()));
        }

        // 3. 승인된 유저에게 알림 저장 (추후 이메일/푸시 연동 가능)
        $sqlNotify = "INSERT INTO notifications (user_id, message, created_at) 
                      SELECT user_id, :message, NOW() FROM coupons_report WHERE `index` = :report_id";
        $stmtNotify = $pdo->prepare($sqlNotify);
        $stmtNotify->bindValue(':message', "제보한 쿠폰이 승인되었습니다: {$gameName}", PDO::PARAM_STR);
        $stmtNotify->bindValue(':report_id', $reportId, PDO::PARAM_INT);
        $stmtNotify->execute();

        // 모든 작업 완료 후 커밋
        $pdo->commit();

        echo json_encode(['success' => true, 'message' => '쿠폰 등록 및 제보 승인 완료']);

    } catch (PDOException $e) {
        $pdo->rollBack(); // 오류 발생 시 롤백
        echo json_encode(['success' => false, 'message' => '데이터베이스 오류: ' . $e->getMessage()]);
    } catch (Exception $e) {
        $pdo->rollBack();
        echo json_encode(['success' => false, 'message' => '오류 발생: ' . $e->getMessage()]);
    }
}
?>
