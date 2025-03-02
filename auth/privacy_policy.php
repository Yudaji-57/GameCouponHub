<!-- /auth/privacy_policy.php -->
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>개인정보 처리방침 - GameCouponHub</title>

    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- 부트스트랩 CSS 링크 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/common.css"> <!-- 공통 CSS 파일 -->
    <link rel="stylesheet" href="../assets/css/privacy_policy.css">
    <link rel="stylesheet" href="../assets/css/auth.css">
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
                    <h2 class="text-center mb-4">개인정보 처리방침</h2>
                    <p>GameCouponHub는 개인정보 보호를 매우 중요하게 생각하며, 이용자의 개인정보를 보호하기 위해 최선을 다합니다.</p>
                    <h3>1. 개인정보의 수집 항목</h3>
                    <p>우리는 회원가입 시, 이용자의 이름, 이메일, 닉네임, 비밀번호 등 최소한의 개인정보를 수집합니다.</p>

                    <h3>2. 개인정보의 수집 및 이용 목적</h3>
                    <p>수집된 개인정보는 서비스 제공 및 사용자 인증을 위해 사용됩니다. 또한 서비스 개선과 관련된 분석에도 활용될 수 있습니다.</p>

                    <h3>3. 개인정보의 보유 및 이용 기간</h3>
                    <p>회원 탈퇴 시, 이용자의 개인정보는 즉시 삭제됩니다. 단, 법적으로 보존해야 하는 데이터는 제외됩니다.</p>

                    <h3>4. 개인정보의 제3자 제공</h3>
                    <p>GameCouponHub는 이용자의 동의 없이 개인정보를 제3자에게 제공하지 않습니다. 단, 법적 요구가 있는 경우 제외됩니다.</p>

                    <h3>5. 개인정보 보호</h3>
                    <p>우리는 이용자의 개인정보 보호를 위해 다양한 보안 조치를 시행합니다.</p>

                    <h3>6. 개인정보 처리방침의 변경</h3>
                    <p>이 개인정보 처리방침은 필요 시 변경될 수 있으며, 변경 사항은 공지사항을 통해 알려드립니다.</p>

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
