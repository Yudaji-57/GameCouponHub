<?php
session_start();  // 세션 시작

// 로그인 여부 확인
$isLoggedIn = isset($_SESSION['user_id']);  // 로그인 상태 여부
$isAdmin = isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';  // 관리자 권한 여부 확인
?>

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
                        
                        <?php if ($isAdmin): ?>
                            <a href="../admin/index.php" class="nav-link" style="color: #fff;">관리자 페이지</a>
                        <?php endif; ?>
                        
                        <a href="../auth/logout.php" class="nav-link" style="color: #fff;">로그아웃</a>
                    <?php else: ?>
                        <a href="../auth/login.php" class="nav-link" style="color: #fff;">로그인</a>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</header>
