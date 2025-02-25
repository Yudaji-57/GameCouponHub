<!-- /GameCouponHub/pages/coupons.php -->
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameCouponHub - 쿠폰 리스트</title>

    <!-- 부트스트랩 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- 공통 및 메인 스타일 -->
    <link rel="stylesheet" href="../assets/css/common.css">
    <link rel="stylesheet" href="../assets/css/coupons.css">

    <script src="../assets/js/main.js" defer></script>
</head>

<body>
    <?php
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
                <a class="nav-link" href="#">메인</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">게임 목록</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">내 쿠폰</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">설정</a>
            </li>
        </ul>
    </div>

    <!-- 메인 콘텐츠 -->
    <main class="container mt-4">
        <section>
            <h1 class="display-4 mb-4">쿠폰 리스트</h1>

            <!-- 쿠폰 리스트 카드 스타일 -->
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-solid fa-ticket"></i> 쿠폰 1</h5>
                            <p class="card-text">이 쿠폰은 게임에서 사용 가능합니다.</p>
                            <a href="#" class="btn btn-primary">쿠폰 확인</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-solid fa-ticket"></i> 쿠폰 2</h5>
                            <p class="card-text">이 쿠폰은 게임에서 사용 가능합니다.</p>
                            <a href="#" class="btn btn-primary">쿠폰 확인</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-solid fa-ticket"></i> 쿠폰 3</h5>
                            <p class="card-text">이 쿠폰은 게임에서 사용 가능합니다.</p>
                            <a href="#" class="btn btn-primary">쿠폰 확인</a>
                        </div>
                    </div>
                </div>
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
</body>

</html>
