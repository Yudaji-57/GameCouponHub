<!-- /GameCouponHub/pages/coupons.php -->
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameCouponHub - 쿠폰 리스트</title>
    <!-- 부트스트랩 CSS 링크 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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

    <main class="container mt-4">
        <section>
            <h1 class="display-4">쿠폰 리스트</h1>
            <ul class="list-group">
                <li class="list-group-item">쿠폰 1</li>
                <li class="list-group-item">쿠폰 2</li>
                <li class="list-group-item">쿠폰 3</li>
                <!-- 쿠폰 리스트 추가 -->
            </ul>
        </section>
    </main>

    <?php
    // 푸터
    include $rootPath . "/includes/footer.php";
    ?>

    <!-- 부트스트랩 JS, Popper.js 링크 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
