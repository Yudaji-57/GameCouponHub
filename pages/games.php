<!-- /main/games.php -->
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게임 목록</title>
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
                <a class="nav-link" href="/pages/index.php">메인</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/pages/games.php">게임 목록</a>
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
    </nav>

    <main class="content">
        <h1>공식 쿠폰 제공 게임 목록</h1>
        <p>다양한 게임에서 제공되는 공식 쿠폰을 확인하고, 쿠폰을 활용해 보세요.</p>

        <div class="row">
            <!-- 게임 1 -->
            <div class="col-md-2 col-sm-3 col-4 mb-4">
                <div class="card">
                    <img src="../assets/images/game_images/초월자키우기.webp" class="card-img-top" alt="초월자키우기" style="object-fit: cover; width: 100%; height: 120px;">
                    <div class="card-body d-flex flex-column justify-content-between" style="height: 150px;">
                        <h5 class="card-title text-center">
                            초월자 키우기 <br> 방치형 RPG
                        </h5>
                        <div class="d-flex justify-content-between mt-auto" style="gap: 10px;">
                            <a href="https://play.google.com/store/apps/details?id=com.playgames.transcender" target="_blank" class="btn btn-primary">게임 다운로드하기</a>
                            <a href="#" class="btn btn-primary">사용 가능 쿠폰 보기</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 게임 2 -->
            <div class="col-md-2 col-sm-3 col-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="게임 2 이미지" style="object-fit: cover; width: 100%; height: 120px;">
                    <div class="card-body d-flex flex-column justify-content-between" style="height: 150px;">
                        <h5 class="card-title text-center">
                            게임2
                        </h5>
                        <div class="d-flex justify-content-between mt-auto" style="gap: 10px;">
                            <a href="#" class="btn btn-primary" disabled>게임 다운로드하기</a>
                            <a href="#" class="btn btn-primary" disabled>사용 가능 쿠폰 보기</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 게임 3 -->
            <div class="col-md-2 col-sm-3 col-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="게임 3 이미지" style="object-fit: cover; width: 100%; height: 120px;">
                    <div class="card-body d-flex flex-column justify-content-between" style="height: 150px;">
                        <h5 class="card-title text-center">
                            게임3
                        </h5>
                        <div class="d-flex justify-content-between mt-auto" style="gap: 10px;">
                            <a href="#" class="btn btn-primary">게임 다운로드하기</a>
                            <a href="#" class="btn btn-primary">사용 가능 쿠폰 보기</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 게임 4 -->
            <div class="col-md-2 col-sm-3 col-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="게임 4 이미지" style="object-fit: cover; width: 100%; height: 120px;">
                    <div class="card-body d-flex flex-column justify-content-between" style="height: 150px;">
                        <h5 class="card-title text-center">
                            게임4
                        </h5>
                        <div class="d-flex justify-content-between mt-auto" style="gap: 10px;">
                            <a href="#" class="btn btn-primary">게임 다운로드하기</a>
                            <a href="#" class="btn btn-primary">사용 가능 쿠폰 보기</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 게임 5 -->
            <div class="col-md-2 col-sm-3 col-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="게임 5 이미지" style="object-fit: cover; width: 100%; height: 120px;">
                    <div class="card-body d-flex flex-column justify-content-between" style="height: 150px;">
                        <h5 class="card-title text-center">
                            게임5
                        </h5>
                        <div class="d-flex justify-content-between mt-auto" style="gap: 10px;">
                            <a href="#" class="btn btn-primary" disabled>게임 다운로드하기</a>
                            <a href="#" class="btn btn-primary" disabled>사용 가능 쿠폰 보기</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php
    // 푸터
    include $rootPath . "/includes/footer.php";
    ?>

    <!-- 부트스트랩 JS, Popper.js 링크 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script src="../assets/js/user_common.js"></script>
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

        document.title = "GameCouponHub - 게임 목록"; // 페이지 제목 설정
    </script>
</body>

</html>
