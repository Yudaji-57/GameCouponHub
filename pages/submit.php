<!-- /GameCouponHub/pages/submit.php -->
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameCouponHub - 쿠폰 제보</title>
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- 최신 부트스트랩 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/common.css"> <!-- 공통 CSS 파일 -->
    <link rel="stylesheet" href="../assets/css/submit.css"> <!-- 추가적인 커스텀 스타일 -->
    <script src="../assets/js/submit.js" defer></script> <!-- submit.js: 쿠폰 제보 JS -->
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

    <main class="container mt-5">
        <section class="col-md-6 mx-auto">
            <h1 class="text-center mb-4">쿠폰 제보</h1>

            <!-- 설명란 -->
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i>
                소중한 쿠폰 제보 감사합니다! 🎉 <br>
                관리자가 확인 후 빠르게 정상 쿠폰으로 반영하겠습니다. <br>
                <strong>- GameCouponHub 운영팀 -</strong>
            </div>


            <!-- 쿠폰 제보 폼 -->
            <form id="couponForm">
                <!-- 게임명 입력 -->
                <div class="form-group mb-3">
                    <label for="game">게임명:</label>
                    <input type="text" class="form-control" id="game" name="game" required>
                </div>

                <!-- 쿠폰 코드 입력 -->
                <div class="form-group mb-3">
                    <label for="coupon">쿠폰 코드:</label>
                    <input type="text" class="form-control" id="coupon" name="coupon" required>
                </div>

                <!-- 보상 내용 입력 -->
                <div class="form-group mb-3">
                    <label for="reward">보상 내용:</label>
                    <textarea class="form-control" id="reward" name="reward" rows="4" required></textarea>
                </div>

                <!-- 숨겨진 user_id 입력 -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                <?php endif; ?>

                <button type="submit" class="btn btn-primary btn-block">제보하기</button>
            </form>

            <div id="resultMessage" class="mt-3"></div> <!-- 결과 메시지 표시 -->

        </section>
    </main>

    <?php
    // 푸터
    include $rootPath . "/includes/footer.php";
    ?>

    <!-- 부트스트랩 JS, Popper.js 링크 -->
    <script src="https://cdn.jsdelivr.net/np