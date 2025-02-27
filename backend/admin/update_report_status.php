<?php
// /backend/admin/update_report_status.php

require_once "/volume1/web/GameCouponHub/backend/config/database.php"; // 데이터베이스 연결

// 헤더 설정
header('Content-Type: application/json');

try {
    // POST 요청에서 전달받은 JSON 데이터 가져오기
    $data = json_decode(file_get_contents("php://input"), true);

    // JSON 데이터에서 index와 approval_status 값 가져오기
    $index = isset($data['index']) ? (int)$data['index'] : null;
    $approvalStatus = isset($data['approval_status']) ? (int)$data['approval_status'] : null;

    // index와 승인 상태 값이 유효한지 확인
    if ($index === null || $approvalStatus === null || !in_array($approvalStatus, [0, 1, 2])) {
        echo json_encode([
            "status" => "error",
            "message" => "유효하지 않은 요청입니다."
        ]);
        exit;
    }

    // 쿠폰 제보 상태 업데이트 쿼리 (index 컬럼 사용)
    $updateQuery = "
        UPDATE coupons_report 
        SET approval_status = :approval_status 
        WHERE `index` = :index
    ";

    // 준비된 쿼리 실행
    $stmt = $pdo->prepare($updateQuery);
    $stmt->bindParam(':approval_status', $approvalStatus, PDO::PARAM_INT);
    $stmt->bindParam(':index', $index, PDO::PARAM_INT);
    $stmt->execute();

    // 성공적인 응답
    echo json_encode([
        "status" => "success",
        "message" => "제보 상태가 업데이트되었습니다."
    ]);
} catch (PDOException $e) {
    // 예외 처리: DB 오류 시
    echo json_encode([
        "status" => "error",
        "message" => "데이터베이스 오류: " . $e->getMessage()
    ]);
}
?>
