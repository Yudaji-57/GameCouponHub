<!-- /auth/login.php -->
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인 - GameCouponHub</title>
    
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- 부트스트랩 CSS 링크 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/common.css"> <!-- 공통 CSS 파일 -->
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>
<?php
    $rootPath = "/volume1/web/GameCouponHub"; // 현재 파일 기준 상위 디렉토리 경로

    // 헤더
    include $rootPath . "/includes/header.php";
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card p-4">
                <h2 class="text-center mb-4">로그인</h2>

                <!-- 오류 메시지 출력 영역 -->
                <?php
                session_start();
                if (isset($_SESSION['error_message'])) {
                    echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
                    unset($_SESSION['error_message']);
                }
                ?>

                <form action="../auth/process_login.php" method="post">
                    <div class="mb-3">
                        <label for="userId" class="form-label">아이디</label>
                        <input type="text" id="userId" name="userId" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">비밀번호</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">로그인</button>
                </form>

                <div class="text-center mt-3">
                    <a href="../auth/register.php">회원가입</a> |
                    <a href="../auth/forgot_password.php">비밀번호 찾기</a>
                </div>

                <div class="social-login mt-4 text-center">
                    <p>소셜 로그인</p>
                    <button class="btn btn-outline-warning mx-2">
                        <i class="fas fa-comment"></i> 카카오
                    </button>
                    <button class="btn btn-outline-danger mx-2">
                        <i class="fab fa-google"></i> 구글
                    </button>
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
<script src="/assets/js/auth.js"></script>
</body>
</html>
