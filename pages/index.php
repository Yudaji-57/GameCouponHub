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

    <!-- 메인 콘텐츠 -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-9">
                <div class="main-content">
                    <h2 class="display-4">환영합니다!</h2>
                    <p class="lead">게임 쿠폰을 찾고 정리하세요.</p>
                </div>
            </div>
            <!-- 사이드바 -->
            <div class="col-md-3">
                <?php include $rootPath . "/includes/sidebar.php"; ?>
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
</body>

</html>

<!-- /GameCouponHub/index.php (또는 footer.php에 추가) -->
<script>
    document.getElementById('sidebar-toggle').addEventListener('click', function () {
        var sidebar = document.getElementById('sidebar');
        var icon = document.getElementById('toggle-icon');

        // 'collapsed' 클래스를 추가/제거
        sidebar.classList.toggle('collapsed');

        // 아이콘 변경
        if (sidebar.classList.contains('collapsed')) {
            icon.classList.remove('fa-chevron-left');
            icon.classList.add('fa-chevron-right');  // '펼치기' 아이콘
        } else {
            icon.classList.remove('fa-chevron-right');
            icon.classList.add('fa-chevron-left');  // '접기' 아이콘
        }
    });
</script>