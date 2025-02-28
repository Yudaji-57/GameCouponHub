<?php
// /backend/user/notification_settings.php
// 알림 설정을 처리하는 백엔드 PHP 코드

require_once "/volume1/web/GameCouponHub/backend/config/database.php"; // DB 연결

// JSON 형식으로 받은 요청 처리
$data = json_decode(file_get_contents("php://input"), true);
$user_id = $_SESSION['user_id'];
$email_notifications = $data['email_notifications'];
$push_notifications = $data['push_notifications'];

// 알림 설정 업데이트
$stmt = $pdo->prepare("UPDATE users SET email_notifications = :email_notifications, push_notifications = :push_notifications WHERE user_id = :user_id");
$stmt->execute([
    'email_notifications' => $email_notifications,
    'push_notifications' => $push_notifications,
    'user_id' => $user_id
]);

// 성공 응답
echo json_encode(['success' => true, 'message' => '알림 설정이 성공적으로 업데이트되었습니다.']);
?>
