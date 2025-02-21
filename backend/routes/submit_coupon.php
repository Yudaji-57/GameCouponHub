<?php
// 오류 메시지 숨기기
error_reporting(0);
ini_set('display_errors', 0);

header('Content-Type: application/json'); // JSON 응답을 반환한다고 명시

// 데이터베이스 연결 파일 포함
require_once '../config/database.php'; // database.php 파일 경로를 맞춰 주세요

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

// 현재 시간 (created_at)
$created_at = date('Y-m-d H:i:s');

// 쿠폰 제보 데이터를 테이블에 삽입
$query = "INSERT INTO coupon_submissions (user_id, game_name, coupon_code, reward_details, created_at) 
          VALUES (?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($query);

// 유효한 파라미터 바인딩
if ($stmt) {
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
} else {
    echo json_encode([
        'success' => false,
        'message' => '쿼리 준비 중 오류가 발생했습니다.'
    ]);
}

$mysqli->close();
?>
