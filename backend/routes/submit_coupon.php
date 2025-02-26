<?php
// 경로/파일명: /backend/routes/submit_coupon.php
// 설명: 쿠폰 제보 데이터를 처리하고 DB에 저장합니다. 
// 사용자가 로그인하지 않으면 로그인 페이지로 리디렉션하고, 입력된 데이터가 유효하지 않으면 오류 메시지를 반환합니다. 
// 성공 시 쿠폰 제보를 저장하고, 성공 메시지와 함께 리디렉션 URL을 반환합니다.

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

session_start(); // 세션 시작

require_once "/volume1/web/GameCouponHub/backend/config/database.php"; // DB 연결

header('Content-Type: application/json');

// 유저가 로그인되어 있는지 확인
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => '로그인이 필요합니다.', 'redirect' => '/auth/login.php']);
    exit();
}

// 입력값 받기
$game = $_POST['game'] ?? '';
$coupon = $_POST['coupon'] ?? '';
$reward = $_POST['reward'] ?? '';
$user_id = $_POST['user_id'] ?? '';

// 유효성 검사
if (empty($game) || empty($coupon) || empty($reward) || empty($user_id)) {
    echo json_encode(['success' => false, 'message' => '모든 필드를 입력해주세요.']);
    exit();
}

try {
    // 현재 시간 (created_at)
    $createdAt = date('Y-m-d H:i:s');

    // 쿠폰 제보 데이터를 테이블에 삽입
    $query = "INSERT INTO coupons_report (user_id, game_name, coupon_code, reward_details, created_at) 
              VALUES (:user_id, :game, :coupon, :reward, :created_at)";
    
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
    $stmt->bindParam(':game', $game, PDO::PARAM_STR);
    $stmt->bindParam(':coupon', $coupon, PDO::PARAM_STR);
    $stmt->bindParam(':reward', $reward, PDO::PARAM_STR);
    $stmt->bindParam(':created_at', $createdAt, PDO::PARAM_STR);
    $stmt->execute();

    // 성공 응답 + 리디렉션 경로 포함
    echo json_encode([
        'success' => true,
        'message' => '쿠폰이 성공적으로 제보되었습니다!',
        'redirect' => '../pages/index.php' // 절대 경로 사용
    ]);    
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => '데이터 저장 실패: ' . $e->getMessage()]);
}
?>
