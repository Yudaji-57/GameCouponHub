<!-- /GameCouponHub/index.php -->
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameCouponHub</title>
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- 부트스트랩 CSS 링크 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/common.css"> <!-- 공통 CSS 파일 -->
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
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-9">
                <div class="main-content">
                    <h2 class="display-4">환영합니다!</h2>
                    <p class="lead">게임 쿠폰을 찾고 정리하세요.</p>
                </div>
            </div>
        </div>
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
    <!-- 페이지별 JS 파일 링크 -->
    <script src="../assets/js/index.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        <?php
        // PHP에서 세션값을 가져와서 JavaScript 변수로 전달
        if (isset($_SESSION['user_id'])) {
            echo "sessionStorage.setItem('user_id', '" . $_SESSION['user_id'] . "');";
        } else {
            echo "console.log('로그인되지 않았습니다.');";
        }
        ?>
    });
</script>
</body>
</html>
