<!-- /GameCouponHub/pages/game.php -->
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameCouponHub - 게임별 쿠폰</title>
    <link rel="stylesheet" href="../assets/css/common.css"> <!-- 공통 CSS 파일 -->
    <link rel="stylesheet" href="../assets/css/game.css"> <!-- game.css: 게임별 스타일 -->
    <script src="../assets/js/game.js" defer></script> <!-- game.js: 게임별 쿠폰 JS -->
</head>

<body>
    <?php
    $rootPath = "/volume1/web/GameCouponHub"; // 현재 파일 기준 상위 디렉토리 경로

    // 헤더
    include $rootPath . "/includes/header.php";
    ?>

    <main>
        <section>
            <h1>게임 쿠폰</h1>
            <p>이 게임의 쿠폰을 확인해보세요!</p>
            <!-- 게임별 쿠폰 내용 -->
        </section>
    </main>

    <?php
    // 푸터
    include $rootPath . "/includes/footer.php";
    ?>
</body>

</html>