<?php

// /backend/admin/get_user.php
require_once "/volume1/web/GameCouponHub/backend/config/database.php"; // 데이터베이스 연결

header('Content-Type: application/json'); // 응답이 JSON임을 명시

$userId = isset($_GET['user_id']) ? $_GET['user_id'] : '';

if (!$userId) {
    echo json_encode(['status' => 'error', 'message' => '유효한 유저 ID가 아닙니다.']);
    exit;
}

try {
    // 유저 정보 가져오기
    $stmt = $pdo->prepare("SELECT user_id, nickname, email, user_role, blocked FROM users WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_STR);
    $stmt->execute();
    
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo json_encode([
            'status' => 'success',
            'user' => $user
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => '유저를 찾을 수 없습니다.']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

?>