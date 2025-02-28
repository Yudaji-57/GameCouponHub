<?php
// /backend/user/profile_settings.php
// 프로필 설정을 처리하는 백엔드 PHP 코드

require_once "/volume1/web/GameCouponHub/backend/config/database.php"; // DB 연결
session_start(); // 세션 시작 (사용자 로그인 상태 확인을 위해)

// 로그인된 사용자 ID 가져오기
$user_id = $_SESSION['user_id'];

// JSON 형식으로 받은 요청 처리
$data = json_decode(file_get_contents("php://input"), true);

// 닉네임 조회 처리 (프로필 정보를 불러옴)
if ($data['type'] == 'get_nickname') {
    // 사용자 닉네임 가져오기
    $stmt = $pdo->prepare("SELECT nickname FROM users WHERE user_id = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // 닉네임이 존재하면 반환
        echo json_encode(['success' => true, 'nickname' => $user['nickname']]);
    } else {
        // 사용자 정보가 없는 경우
        echo json_encode(['success' => false, 'message' => '사용자 정보를 찾을 수 없습니다.']);
    }
    exit;
}

if (isset($data['type'])) {
    // 이메일 변경 처리
    if ($data['type'] == 'email') {
        $new_email = $data['newEmail'];

        // 이메일 유효성 검사
        if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => '유효한 이메일을 입력해주세요.']);
            exit;
        }

        // 이메일 업데이트 쿼리
        $stmt = $pdo->prepare("UPDATE users SET email = :email WHERE user_id = :user_id");
        $stmt->execute([
            'email' => $new_email,
            'user_id' => $user_id
        ]);

        echo json_encode(['success' => true, 'message' => '이메일이 성공적으로 업데이트되었습니다.']);

    // 비밀번호 변경 처리
    } elseif ($data['type'] == 'password') {
        $current_password = $data['currentPassword'];
        $new_password = $data['newPassword'];
        
        // 비밀번호가 유효한지 검사
        if (strlen($new_password) < 8) {
            echo json_encode(['success' => false, 'message' => '비밀번호는 최소 8자 이상이어야 합니다.']);
            exit;
        }

        // 기존 비밀번호와 비교하는 로직
        $stmt = $pdo->prepare("SELECT password FROM users WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($current_password, $user['password'])) {
            // 새로운 비밀번호 해싱
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // 비밀번호 업데이트 쿼리
            $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE user_id = :user_id");
            $stmt->execute([
                'password' => $hashed_password,
                'user_id' => $user_id
            ]);

            echo json_encode(['success' => true, 'message' => '비밀번호가 성공적으로 업데이트되었습니다.']);
        } else {
            echo json_encode(['success' => false, 'message' => '현재 비밀번호가 일치하지 않습니다.']);
        }

    // 닉네임 변경 처리
    } elseif ($data['type'] == 'nickname') {
        $new_nickname = $data['newNickname'];

        // 닉네임이 최소 3자 이상인지 확인
        if (strlen($new_nickname) < 3) {
            echo json_encode(['success' => false, 'message' => '닉네임은 최소 3자 이상이어야 합니다.']);
            exit;
        }

        // 닉네임 업데이트 쿼리
        $stmt = $pdo->prepare("UPDATE users SET nickname = :nickname WHERE user_id = :user_id");
        $stmt->execute([
            'nickname' => $new_nickname,
            'user_id' => $user_id
        ]);

        echo json_encode(['success' => true, 'message' => '닉네임이 성공적으로 업데이트되었습니다.']);
    } else {
        echo json_encode(['success' => false, 'message' => '잘못된 요청입니다.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => '요청 타입이 없습니다.']);
}
?>
