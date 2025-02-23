<!-- pages/submit.php -->
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameCouponHub - 쿠폰 제보</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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

    <main class="container mt-5">
        <section class="col-md-6 mx-auto">
            <h1 class="text-center mb-4">쿠폰 제보</h1>
            <!-- 쿠폰 제보 폼 (form) 수정 -->
            <form id="couponForm">
                <!-- 게임명 입력 -->
                <div class="form-group">
                    <label for="game">게임명:</label>
                    <input type="text" class="form-control" id="game" name="game" required>
                </div>

                <!-- 쿠폰 코드 입력 -->
                <div class="form-group">
                    <label for="coupon">쿠폰 코드:</label>
                    <input type="text" class="form-control" id="coupon" name="coupon" required>
                </div>

                <!-- 보상 내용 입력 -->
                <div class="form-group">
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
