<?php
// /GameCouponHub/config/db.php
$host = "localhost";
$dbname = "game_coupon_db";
$username = "root"; // DB 사용자 이름
$password = ""; // DB 비밀번호 (변경 필요)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("데이터베이스 연결 실패: " . $e->getMessage());
}
?>
