<!-- /GameCouponHub/includes/header.php -->
<header class="bg-dark py-3 coupons-header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">
                <a href="../pages/index.php" style="color: #fff; text-decoration: none;">GameCouponHub</a>
            </h1>
            <nav class="nav">
                <ul class="nav">
                    <a href="../pages/index.php" class="nav-link" style="color: #fff;">홈</a>
                    <a href="../pages/games.php" class="nav-link" style="color: #fff;">게임 목록</a>
                    <a href="../pages/submit.php" class="nav-link" style="color: #fff;">쿠폰 제보</a>
                    <?php if ($isLoggedIn): ?>
                        <a href="../pages/mypage.php" class="nav-link" style="color: #fff;">마이페이지</a>
                        <a href="../auth/logout.php" class="nav-link" style="color: #fff;">로그아웃</a>
                    <?php else: ?>
                        <a href="../auth/login.php" class="nav-link" style="color: #fff;">로그인</a>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</header>