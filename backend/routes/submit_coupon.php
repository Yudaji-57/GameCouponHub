<?php
// 오류 메시지 숨기기
error_reporting(0);
ini_set('display_errors', 0);

header('Content-Type: application/json'); // JSON 응답을 반환한다고 명시

// 입력값 받기
$game = $_POST['game'] ?? '';
$coupon = $_POST['coupon'] ?? '';
$reward = $_POST['reward'] ?? '';
$user_id = $_POST['user_id'] ?? '';  // user_id 받기

// 유효성 검사
if (empty($game) || empty($coupon) || empty($reward) || empty($user_id)) {
    echo json_encode([
        'success' => false,
        'message' => '모든 필드를 입력해주세요.'
    ]);
    exit();
}

// 데이터베이스 연결 (예시)
$mysqli = new mysqli("localhost", "username", "password", "database_name");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// 현재 시간 (created_at)
$created_at = date('Y-m-d H:i:s');

// 쿠폰 제보 데이터를 테이블에 삽입
$query = "INSERT INTO coupon_submissions (user_id, game_name, coupon_code, reward_details, created_at) 
          VALUES (?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("issss", $user_id, $game, $coupon, $reward, $created_at);
$stmt->execute();

// 성공 여부 확인
if ($stmt->affected_rows > 0) {
    echo json_encode([
        'success' => true,
        'message' => '쿠폰이 성공적으로 제보되었습니다!'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => '제보 처리에 실패했습니다.'
    ]);
}

$stmt->close();
$mysqli->close();
?>
