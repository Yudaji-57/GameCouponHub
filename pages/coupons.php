<!-- /GameCouponHub/pages/coupons.php -->
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameCouponHub - 쿠폰 리스트</title>
    <link rel="stylesheet" href="../assets/css/common.css"> <!-- 공통 CSS 파일 -->
    <link rel="stylesheet" href="../assets/css/main.css"> <!-- main.css: 쿠폰 리스트 스타일 -->
    <script src="../assets/js/main.js" defer></script> <!-- main.js: 쿠폰 리스트 JS -->
</head>

<body>
    <?php
    $rootPath = "/volume1/web/GameCouponHub"; // 현재 파일 기준 상위 디렉토리 경로

    // 헤더
    include $rootPath . "/includes/header.php";
    ?>

    <main>
        <section>
            <h1>쿠폰 리스트</h1>
            <ul>
                <li>쿠폰 1</li>
                <li>쿠폰 2</li>
                <li>쿠폰 3</li>
            </ul>
        </section>
    </main>

    <?php
    // 푸터
    include $rootPath . "/includes/footer.php";
    ?>
</body>

</html>