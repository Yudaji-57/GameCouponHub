<?php
// /GameCouponHub/backend/config/database.php
$host = "localhost";
$dbname = "CouponHub";
$username = "Coupon_user"; // DB 사용자 이름
$password = "A7a127fa5!!@@"; // DB 비밀번호 (변경 필요)

try {
    // 데이터베이스 연결
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("데이터베이스 연결 실패: " . $e->getMessage());
}
?>
