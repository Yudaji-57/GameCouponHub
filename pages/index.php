<!-- /GameCouponHub/index.php -->
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameCouponHub</title>
    <link rel="stylesheet" href="../assets/css/common.css"> <!-- 공통 CSS 파일 -->
</head>
<body>
    <?php
    $rootPath = "/volume1/web/GameCouponHub"; // 현재 파일 기준 상위 디렉토리 경로

    // 헤더
    include $rootPath . "/includes/header.php";

    // 사이드바
    include $rootPath . "/includes/sidebar.php";
    ?>
    <!-- 메인 콘텐츠 -->
    <div class="main-content">
        <h2>환영합니다!</h2>
        <p>게임 쿠폰을 찾고 정리하세요.</p>
    </div>

    <?php
    // 푸터
    include $rootPath . "/includes/footer.php";
    ?>
</body>
</html>
