<!-- /auth/terms_of_service.php -->
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>이용약관 - GameCouponHub</title>

    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- 부트스트랩 CSS 링크 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/common.css"> <!-- 공통 CSS 파일 -->
    <link rel="stylesheet" href="../assets/css/auth.css">
    <link rel="stylesheet" href="../assets/css/terms_of_service.css">
</head>

<body>
    <?php
    session_start();
    $isLoggedIn = isset($_SESSION['user_id']);
    $rootPath = "/volume1/web/GameCouponHub"; // 현재 파일 기준 상위 디렉토리 경로

    // 헤더
    include $rootPath . "/includes/header.php";
    ?>

    <!-- 컨텐츠 영역 -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4">
                    <h2 class="text-center mb-4">이용약관</h2>
                    <p>본 약관은 GameCouponHub의 서비스 이용과 관련된 사항을 규정합니다.</p>
                    <h3>제1조 (목적)</h3>
                    <p>본 약관은 GameCouponHub에서 제공하는 서비스 이용에 관한 기본적인 사항을 규정합니다.</p>

                    <h3>제2조 (서비스 이용)</h3>
                    <p>1. 이용자는 본 서비스를 이용함에 있어 서비스를 제공하는 모든 법적 절차를 준수해야 합니다.</p>
                    <p>2. 서비스의 내용은 GameCouponHub의 정책에 따라 변경될 수 있습니다.</p>

                    <h3>제3조 (이용자의 의무)</h3>
                    <p>1. 이용자는 서비스 이용 시 타인의 권리를 침해해서는 안 됩니다.</p>
                    <p>2. 이용자는 서비스 이용 중 발생할 수 있는 문제에 대해 책임을 집니다.</p>

                    <h3>제4조 (서비스 제공의 제한)</h3>
                    <p>서비스 제공자는 필요한 경우 서비스의 일시적 중단 또는 제한을 할 수 있습니다.</p>

                    <h3>제5조 (개인정보 보호)</h3>
                    <p>이용자의 개인정보는 개인정보 처리방침에 따라 보호됩니다.</p>

                    <h3>제6조 (약관의 변경)</h3>
                    <p>서비스 제공자는 필요 시 약관을 변경할 수 있습니다. 변경된 약관은 공지사항에 게시됩니다.</p>

                    <div class="text-center mt-3">
                        <a href="../auth/register.php">회원가입으로 돌아가기</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 푸터 포함 -->
    <?php
    include $rootPath . "/includes/footer.php";
    ?>

    <!-- 부트스트랩 JS, Popper.js 링크 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
