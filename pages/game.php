<!-- /GameCouponHub/pages/game.php -->
<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameCouponHub - 게임별 쿠폰</title>
    <!-- 부트스트랩 CSS 링크 -->
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/common.css"> <!-- 공통 CSS 파일 -->
    <link rel="stylesheet" href="../assets/css/game.css"> <!-- game.css: 게임별 스타일 -->

    <script src="../assets/js/game.js" defer></script> <!-- game.js: 게임별 쿠폰 JS -->
</head>

<body>
    <?php
    session_start(); // 세션 시작
    $isLoggedIn = isset($_SESSION['user_id']); // 로그인 여부 확인
    $rootPath = "/volume1/web/GameCouponHub"; // 현재 파일 기준 상위 디렉토리 경로

    // 헤더
    include $rootPath . "/includes/header.php";
    ?>

    <!-- 사이드바 -->
    <div id="sidebar" class="sidebar">
        <button id="sidebar-toggle" class="btn btn-dark">
            <i id="toggle-icon" class="fas fa-chevron-left"></i>
        </button>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="../pages/index.php">메인</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../pages/games.php">게임 목록</a>
            </li>
            <?php if ($isLoggedIn): ?>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="navigateTo('../pages/my_coupons.php')">내 쿠폰</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="navigateTo('../pages/settings.php')">설정</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>

    <main class="container mt-4">
        <section>
            <h1 class="display-4">게임 쿠폰</h1>
            <p class="lead">이 게임의 쿠폰을 확인해보세요!</p>
            <!-- 게임별 쿠폰 내용 추가 -->
            <div class="row">
                <!-- 예시: 게임 쿠폰 카드 -->
                <div class="col-md-4 mb-4">
                    <div class="card game-card">
                        <img src="../assets/images/game1.jpg" class="card-img-top" alt="게임 1">
                        <div class="card-body">
                            <h5 class="card-title">게임 1</h5>
                            <p class="card-text">쿠폰 코드: ABC12345</p>
                            <a href="#" class="btn btn-primary">쿠폰 보기</a>
                        </div>
                    </div>
                </div>
                <!-- 더 많은 게임 쿠폰 카드 추가 -->
            </div>
        </section>
    </main>

    <?php
    // 푸터
    include $rootPath . "/includes/footer.php";
    ?>

    <!-- 부트스트랩 JS, Popper.js 링크 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <!-- 공통 JS 파일 링크 -->
    <script src="../assets/js/common.js"></script>
    <script src="../assets/js/siteTitleAndFavicon.js"></script>

    <script>
        function navigateTo(url) {
            <?php if (!$isLoggedIn): ?>
                alert("로그인 후 이용할 수 있습니다.");
                window.location.href = "../auth/login.php"; // 로그인 페이지로 리다이렉트
            <?php else: ?>
                window.location.href = url; // 로그인된 경우 해당 페이지로 이동
            <?php endif; ?>
        }

        document.title = "GameCouponHub - 게임별 쿠폰"; // 이 부분을 각 페이지별로 설정
    </script>
</body>

</html>