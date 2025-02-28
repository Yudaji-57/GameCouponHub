<!-- /GameCouponHub/pages/notification_settings.php -->
<!-- 알림 설정 페이지 -->


<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/common.css">
    <link rel="stylesheet" href="../assets/css/user_common.css">
    <link rel="stylesheet" href="../assets/css/notification_settings.css">
    <script src="../assets/js/notification_settings.js" defer></script>
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- 부트스트랩 CSS 링크 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <a class="nav-link active" href="../pages/index.php">메인</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/pages/games.php">게임 목록</a>
            </li>
            <?php if ($isLoggedIn): ?>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="navigateTo('/pages/my_coupons.php')">내 쿠폰</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="navigateTo('/pages/settings.php')">설정</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>

        <div class="container mt-5">
            <h2>알림 설정</h2>
            <div id="message"></div>
            <form id="notification-form">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="email_notifications" name="email_notifications">
                    <label class="form-check-label" for="email_notifications">이메일 알림 수신</label>
                </div>
                <div class="form-check mt-3">
                    <input type="checkbox" class="form-check-input" id="push_notifications" name="push_notifications">
                    <label class="form-check-label" for="push_notifications">푸시 알림 수신</label>
                </div>
                <button type="submit" class="btn btn-primary mt-3">알림 설정 변경</button>
            </form>
        </div>
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
            // navigateTo 함수는 PHP에서 전달된 로그인 상태에 따라 다르게 동작
            function navigateTo(url) {
                <?php if (!$isLoggedIn): ?>
                    alert("로그인 후 이용할 수 있습니다.");
                    window.location.href = "../auth/login.php"; // 로그인 페이지로 리다이렉트
                <?php else: ?>
                    window.location.href = url; // 로그인된 경우 해당 페이지로 이동
                <?php endif; ?>
            }

            // 페이지마다 타이틀을 설정하는 코드
            document.title = "GameCouponHub - 알림설정"; // 이 부분을 각 페이지별로 설정
        </script>
</body>

</html>