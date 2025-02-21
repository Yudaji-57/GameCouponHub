<!-- /auth/login.php -->
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인 - GameCouponHub</title>
    
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/common.css"> <!-- 공통 CSS 파일 -->
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>
<?php
    $rootPath = "/volume1/web/GameCouponHub"; // 현재 파일 기준 상위 디렉토리 경로

    // 헤더
    include $rootPath . "/includes/header.php";
    ?>


    <div class="login-container">
        <h2>로그인</h2>
        <form action="/auth/process_login.php" method="post">
            <div class="input-group">
                <label for="username">아이디</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">비밀번호</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="login-btn">로그인</button>
        </form>

        <div class="login-links">
            <a href="/auth/register.php">회원가입</a> |
            <a href="/auth/forgot_password.php">비밀번호 찾기</a>
        </div>

        <div class="social-login">
            <p>소셜 로그인</p>
            <button class="social-btn kakao">
                <i class="fas fa-comment"></i> <!-- 카카오 아이콘 대체 -->
            </button>
            <button class="social-btn google">
                <i class="fab fa-google"></i> <!-- 구글 아이콘 -->
            </button>
        </div>
    </div>

    <!-- 푸터 포함 -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"; ?>
    
    <script src="/assets/js/auth.js"></script>
</body>
</html>
