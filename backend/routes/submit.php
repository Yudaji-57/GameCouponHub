<?php
require_once __DIR__ . '/../controllers/couponController.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $game = $_POST['game'] ?? '';
    $coupon = $_POST['coupon'] ?? '';

    if (!empty($game) && !empty($coupon)) {
        if (CouponController::submitCoupon($game, $coupon)) {
            echo json_encode(["success" => true, "message" => "쿠폰이 성공적으로 등록되었습니다."]);
        } else {
            echo json_encode(["success" => false, "message" => "쿠폰 등록에 실패했습니다."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "모든 필드를 입력하세요."]);
    }
}
?>
