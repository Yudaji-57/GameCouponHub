<?php
// /backend/admin/users_data.php
require_once "/volume1/web/GameCouponHub/backend/config/database.php"; // 데이터베이스 연결

header('Content-Type: application/json'); // 응답이 JSON임을 명시

// 사용자 데이터 가져오기
try {
    $sql = "SELECT user_id, email, last_login, user_role FROM users ORDER BY last_login DESC"; // 사용자 정보 불러오기
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // 결과 가져오기
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // JSON 형식으로 응답 반환
    echo json_encode(['users' => $users]);
} catch (Exception $e) {
    // 예외 처리: 오류 발생 시
    echo json_encode(['error' => '사용자 데이터를 불러오는 중 오류가 발생했습니다.']);
}
?>
