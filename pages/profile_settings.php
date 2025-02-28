<!-- /GameCouponHub/pages/profile_settings.php -->
<!-- 프로필 설정 페이지 -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/common.css">
    <link rel="stylesheet" href="../assets/css/user_common.css">
    <link rel="stylesheet" href="../assets/css/profile_settings.css">
    <script src="../assets/js/profile_settings.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    session_start(); // 세션 시작
    $isLoggedIn = isset($_SESSION['user_id']); // 로그인 여부 확인
    $rootPath = "/volume1/web/GameCouponHub"; // 현재 파일 기준 상위 디렉토리 경로

    // 세션에서 닉네임 가져오기
    $currentNickname = isset($_SESSION['user_nickname']) ? $_SESSION['user_nickname'] : ''; // 로그인된 유저의 닉네임
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
                <a class="nav-link active" href="../pages/index.php">메인</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/pages/games.php">게임 목록</a>
            </li>
            <?php if ($isLoggedIn): ?>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="navigateTo('/pages/my_coupons.php')">내 쿠폰</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="navigateTo('/pages/settings.php')">설정</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>

    <div class="container mt-5">
        <h2>프로필 설정</h2>
        <div id="message"></div>

        <!-- 탭 메뉴 -->
        <ul class="nav nav-tabs" id="profileTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="email-tab" data-bs-toggle="tab" href="#email-section" role="tab" aria-controls="email-section" aria-selected="true">이메일 변경</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="password-tab" data-bs-toggle="tab" href="#password-section" role="tab" aria-controls="password-section" aria-selected="false">비밀번호 변경</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="nickname-tab" data-bs-toggle="tab" href="#nickname-section" role="tab" aria-controls="nickname-section" aria-selected="false">닉네임 변경</a>
            </li>
        </ul>

        <div class="tab-content mt-4" id="profileTabsContent">
            <!-- 이메일 변경 폼 -->
            <div class="tab-pane fade show active" id="email-section" role="tabpanel" aria-labelledby="email-tab">
                <h3>이메일 변경</h3>
                <form id="email-form" method="POST" onsubmit="return validateEmailForm()">
                    <div class="form-group">
                        <label for="current-email">현재 이메일</label>
                        <input type="email" class="form-control" id="current-email" name="current-email" required>
                    </div>
                    <div class="form-group">
                        <label for="new-email">새 이메일</label>
                        <input type="email" class="form-control" id="new-email" name="new-email" required>
                    </div>
                    <button type="submit" class="btn btn-primary">이메일 변경</button>
                </form>
            </div>

            <!-- 비밀번호 변경 폼 -->
            <div class="tab-pane fade" id="password-section" role="tabpanel" aria-labelledby="password-tab">
                <h3>비밀번호 변경</h3>
                <form id="password-form" onsubmit="return validatePasswordForm()">
                    <div class="form-group">
                        <label for="current-password">현재 비밀번호</label>
                        <input type="password" class="form-control" id="current-password" name="current-password" required>
                    </div>
                    <div class="form-group">
                        <label for="new-password">새 비밀번호</label>
                        <input type="password" class="form-control" id="new-password" name="new-password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">비밀번호 확인</label>
                        <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">비밀번호 변경</button>
                </form>
            </div>

            <!-- 닉네임 변경 폼 -->
            <div class="tab-pane fade" id="nickname-section" role="tabpanel" aria-labelledby="nickname-tab">
                <h3>닉네임 변경</h3>
                <form id="nickname-form" onsubmit="return validateNicknameForm()">
                    <div class="form-group">
                        <label for="current-nickname">현재 닉네임</label>
                        <!-- 현재 닉네임을 표시하고, 변경할 수 있도록 수정 -->
                        <input type="text" class="form-control" id="current-nickname" name="current-nickname" value="<?= $currentNickname ?>" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="new-nickname">새 닉네임</label>
                        <input type="text" class="form-control" id="new-nickname" name="new-nickname" required>
                    </div>
                    <button type="submit" class="btn btn-primary">닉네임 변경</button>
                </form>
            </div>
        </div>
    </div>

    <?php
    // 푸터
    include $rootPath . "/includes/footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/common.js"></script>
    <script src="../assets/js/siteTitleAndFavicon.js"></script>

    <script>
        // 로그인 상태에 따라 이동
        function navigateTo(url) {
            <?php if (!$isLoggedIn): ?>
                alert("로그인 후 이용할 수 있습니다.");
                window.location.href = "../auth/login.php"; // 로그인 페이지로 리다이렉트
            <?php else: ?>
                window.location.href = url; // 로그인된 경우 해당 페이지로 이동
            <?php endif; ?>
        }

        document.title = "GameCouponHub - 프로필설정"; // 페이지 타이틀 설정
    </script>
</body>

</html>
