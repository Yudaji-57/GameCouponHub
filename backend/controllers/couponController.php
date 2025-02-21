<?php
// /backend/controllers/couponController.php
require_once __DIR__ . '/../config/database.php';

class CouponController {
    public static function submitCoupon($game, $coupon) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO coupons (game, coupon_code) VALUES (:game, :coupon)");
        return $stmt->execute(['game' => $game, 'coupon' => $coupon]);
    }
}

?>