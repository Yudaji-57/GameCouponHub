<!-- /GameCouponHub/pages/submit.php -->
<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
    session_start(); // 세션 시작
    $isLoggedIn = isset($_SESSION['user_id']); // 로그인 여부 확인
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
                <a class="nav-link" href="../pages/index.php">메인</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../pages/games.php">게임 목록</a>
            </li>
            <?php if ($isLoggedIn): ?>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="navigateTo('../pages/my_coupons.php')">내 쿠폰</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="navigateTo('../pages/settings.php')">설정</a>
                </li>
            <?php endif; ?>
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

                <!-- ✅ 발급일 입력 (필수) -->
                <div class="form-group mb-3">
                    <label for="issue_date">발급일 (필수):</label>
                    <input type="date" class="form-control" id="issue_date" name="issue_date" required>
                </div>

                <!-- ✅ 만료일 입력 (선택) -->
                <div class="form-group mb-3">
                    <label for="expiration_date">만료일 (선택):</label>
                    <input type="date" class="form-control" id="expiration_date" name="expiration_date">
                </div>

                <!-- 쿠폰 유형 선택 -->
                <div class="form-group mb-3">
                    <label for="coupon_type">쿠폰 유형:</label>
                    <select class="form-control" id="coupon_type" name="coupon_type" required>
                        <option value="일반">일반</option>
                        <option value="한정">한정</option>
                        <option value="이벤트">이벤트</option>
                        <option value="업데이트">업데이트</option>
                        <option value="이슈">이슈</option>
                        <option value="핫타임">핫타임</option>                        
                    </select>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script src="../assets/js/submit.js"></script>
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

        document.title = "GameCouponHub - 쿠폰제보"; // 이 부분을 각 페이지별로 설정
    </script>
</body>

</html>