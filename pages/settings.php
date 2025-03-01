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
    <!-- 부트스트랩 CSS -->
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
                <a class="nav-link" href="../pages/index.php">메인</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../pages/games.php">게임 목록</a>
            </li>
            <?php if ($isLoggedIn): ?>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="navigateTo('../pages/mypage.php')">마이페이지</a>
                </li>
            <?php endif; ?>
            <li class="nav-item">
                <a class="nav-link active" href="../pages/settings.php">설정</a>설정</a>
            </li>
        </ul>
    </nav>

    <main class="content container mt-4">
        <h2>설정</h2>
        <p>사이트 내 설정을 관리하세요.</p>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">다크 모드 설정</h5>
                <p class="card-text">사이트의 테마를 변경할 수 있습니다.</p>
                <button class="btn btn-primary" id="toggleDarkMode">다크 모드 활성화</button>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">알림 설정</h5>
                <p class="card-text">쿠폰 알림 및 사이트 공지 수신 설정</p>
                <button class="btn btn-primary" id="toggleNotifications">알림 설정 변경</button>
            </div>
        </div>
    </main>

    <?php include $rootPath . "/includes/footer.php"; ?>

    <!-- 부트스트랩 JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="/assets/js/user_common.js"></script>
    <script src="../assets/js/siteTitleAndFavicon.js"></script>

    <script>
        function navigateTo(url) {
            <?php if (!$isLoggedIn): ?>
                alert("로그인 후 이용할 수 있습니다.");
                window.location.href = "../auth/login.php";
            <?php else: ?>
                window.location.href = url;
            <?php endif; ?>
        }

        document.title = "GameCouponHub - 설정";

        // 다크 모드 토글 기능
        document.getElementById("toggleDarkMode").addEventListener("click", function() {
            document.body.classList.toggle("dark-mode");
            alert("다크 모드가 변경되었습니다.");
        });

        // 알림 설정 변경 (더미 기능)
        document.getElementById("toggleNotifications").addEventListener("click", function() {
            alert("알림 설정이 변경되었습니다.");
        });
    </script>
</body>

</html>