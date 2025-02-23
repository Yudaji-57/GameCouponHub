<?php
// /backend/admin/manage_users_data.php

require_once "/volume1/web/GameCouponHub/backend/config/database.php"; // 데이터베이스 연결

header('Content-Type: application/json'); // 응답이 JSON임을 명시

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;

$offset = ($page - 1) * $limit;

try {
    // 유저 목록 조회
    $stmt = $pdo->prepare("SELECT * FROM users LIMIT :limit OFFSET :offset");
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $users = $stmt->fetchAll();

    // 전체 유저 수 조회
    $countStmt = $pdo->prepare("SELECT COUNT(*) FROM users");
    $countStmt->execute();
    $totalUsers = $countStmt->fetchColumn();

    echo json_encode([
        'status' => 'success',
        'users' => $users,
        'totalUsers' => $totalUsers
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>
