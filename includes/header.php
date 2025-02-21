<!-- /GameCouponHub/includes/header.php -->
<header class="bg-dark py-3 coupons-header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">
                <a href="../pages/index.php" style="color: #fff; text-decoration: none;">GameCouponHub</a>
            </h1>
            <nav>
                <ul class="nav">
                    <li class="nav-item"><a href="../pages/index.php" class="nav-link" style="color: #fff;">홈</a></li>
                    <li class="nav-item"><a href="../pages/coupons.php" class="nav-link" style="color: #fff;">쿠폰 리스트</a></li>
                    <li class="nav-item"><a href="../pages/game.php" class="nav-link" style="color: #fff;">게임별 쿠폰</a></li>
                    <li class="nav-item"><a href="../pages/submit.php" class="nav-link" style="color: #fff;">쿠폰 제보</a></li>
                    
                    <?php
                    session_start();
                    if (isset($_SESSION['user_id'])) {
                        // 로그인 상태일 때, 로그아웃 링크 표시
                        echo '<li class="nav-item"><a href="../auth/logout.php" class="nav-link" style="color: #fff;">로그아웃</a></li>';
                    } else {
                        // 로그인하지 않은 상태일 때, 로그인 링크 표시
                        echo '<li class="nav-item"><a href="../auth/login.php" class="nav-link" style="color: #fff;">로그인</a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</header>
