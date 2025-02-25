<!-- /pages/settings.php -->
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>설정</title>
    <link rel="stylesheet" href="../assets/css/user_common.css">
    <link rel="stylesheet" href="../assets/css/common.css">
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- 부트스트랩 CSS 링크 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    $rootPath = "/volume1/web/GameCouponHub"; // 현재 파일 기준 상위 디렉토리 경로

    // 헤더
    include $rootPath . "/includes/header.php";
    ?>

    <nav class="sidebar">
        <ul class="nav-list">
            <li class="nav-item">
                <a class="nav-link" href="/pages/index.php">메인</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/pages/games.php">게임 목록</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/pages/my_coupons.php">내 쿠폰</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">설정</a>
            </li>
        </ul>
    </nav>

    <main class="content">
        <h1>설정</h1>
        <p>계정 및 환경 설정을 관리하세요.</p>
    </main>


    <?php
    // 푸터
    include $rootPath . "/includes/footer.php";
    ?>
    <!-- 부트스트랩 JS, Popper.js 링크 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script src="/assets/js/user_common.js"></script>
    <script src="../assets/js/siteTitleAndFavicon.js"></script>

    <script>
        document.title = "GameCouponHub - 설정페이지"; // 이 부분을 각 페이지별로 설정
    </script>
</body>

</html>