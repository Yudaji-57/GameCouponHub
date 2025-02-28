<!-- /GameCouponHub/pages/settings.php -->
<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
    session_start(); // 세션 시작
    $isLoggedIn = isset($_SESSION['user_id']); // 로그인 여부 확인
    $rootPath = "/volume1/web/GameCouponHub";
    
    // 헤더
    include $rootPath . "/includes/header.php";
    ?>

    <nav id="sidebar" class="sidebar">
    <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link " href="../pages/index.php">메인</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../pages/games.php">게임 목록</a>
            </li>
            <?php if ($isLoggedIn): ?>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="navigateTo('../pages/my_coupons.php')">내 쿠폰</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#" onclick="navigateTo('../pages/settings.php')">설정</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>

    <main class="content container mt-4">
        <h2>설정</h2>
        <p>계정 및 환경 설정을 관리하세요.</p>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">프로필 설정</h5>
                <p class="card-text">이메일, 비밀번호 변경</p>
                <a href="/pages/profile_settings.php" class="btn btn-primary">설정 변경</a>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">알림 설정</h5>
                <p class="card-text">이메일 및 푸시 알림 설정</p>
                <a href="/pages/notification_settings.php" class="btn btn-primary">알림 설정</a>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">로그아웃</h5>
                <p class="card-text">계정에서 로그아웃합니다.</p>
                <a href="../auth/logout.php" class="btn btn-danger">로그아웃</a>
            </div>
        </div>
    </main>

    <?php include $rootPath . "/includes/footer.php"; ?>

    <!-- 부트스트랩 JS, Popper.js 링크 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="/assets/js/user_common.js"></script>
    <script src="../assets/js/siteTitleAndFavicon.js"></script>

    <script>
        // navigateTo 함수는 PHP에서 전달된 로그인 상태에 따라 다르게 동작
        function navigateTo(url) {
            <?php if (!$isLoggedIn): ?>
                alert("로그인 후 이용할 수 있습니다.");
                window.location.href = "../auth/login.php"; // 로그인 페이지로 리다이렉트
            <?php else: ?>
                window.location.href = url; // 로그인된 경우 해당 페이지로 이동
            <?php endif; ?>
        }

        document.title = "GameCouponHub - 설정";
    </script>
</body>

</html>
