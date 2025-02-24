<?php
// /backend/admin/edit_user.php
require_once "/volume1/web/GameCouponHub/backend/config/database.php"; // 데이터베이스 연결

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $userId = $_GET['user_id'] ?? '';

    if (!$userId) {
        echo json_encode(["status" => "error", "message" => "유효한 유저 ID가 아닙니다."]);
        exit;
    }

    try {
        // 유저 정보 가져오기
        $stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user) {
            echo json_encode(["status" => "success", "user" => $user]);
        } else {
            echo json_encode(["status" => "error", "message" => "유저를 찾을 수 없습니다."]);
        }
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    // 유저 정보 업데이트 처리
    $data = json_decode(file_get_contents("php://input"), true);
    
    $userId = $data['user_id'] ?? '';
    $nickname = $data['nickname'] ?? '';
    $email = $data['email'] ?? '';
    $userRole = $data['user_role'] ?? '';
    $blocked = $data['blocked'] ?? '0';

    if (!$userId || !$nickname || !$email || !$userRole) {
        echo json_encode(["status" => "error", "message" => "필수 필드가 누락되었습니다."]);
        exit;
    }

    try {
        $stmt = $pdo->prepare("UPDATE users SET nickname = :nickname, email = :email, user_role = :user_role, blocked = :blocked WHERE user_id = :user_id");
        $stmt->bindParam(':nickname', $nickname, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':user_role', $userRole, PDO::PARAM_STR);
        $stmt->bindParam(':blocked', $blocked, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $stmt->execute();

        echo json_encode(["status" => "success", "message" => "유저 정보가 수정되었습니다."]);
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
}
?>
