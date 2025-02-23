<?php
// /backend/admin/block_user.php
require_once "/volume1/web/GameCouponHub/backend/config/database.php"; // 데이터베이스 연결

header('Content-Type: application/json'); // 응답이 JSON임을 명시

$userId = isset($_GET['user_id']) ? (int)$_GET['user_id'] : 0;

if ($userId <= 0) {
    echo json_encode(['status' => 'error', 'message' => '유효한 유저 ID가 아닙니다.']);
    exit;
}

try {
    // 유저 차단
    $stmt = $pdo->prepare("UPDATE users SET blocked = 1 WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();

    echo json_encode([
        'status' => 'success',
        'message' => '유저가 차단되었습니다.'
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>
