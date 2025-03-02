<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- 부트스트랩 CSS 링크 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/terms_of_service.css">
    <link rel="stylesheet" href="../assets/css/common.css"> <!-- 공통 CSS 파일 -->
    <link rel="stylesheet" href="../assets/css/auth.css">
    <!-- 부트스트랩 JS, Popper.js 링크 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/terms_privacy.js"></script>
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
                    <a class="nav-link" href="#" onclick="navigateTo('../pages/mypage.php')">마이페이지</a>
                </li>
            <?php endif; ?>
            <li class="nav-item">
                <a class="nav-link" href="../pages/settings.php">설정</a>
            </li>
        </ul>
    </div>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card p-4">
                    <h2 class="text-center mb-4">회원가입</h2>

                    <!-- 오류 메시지 출력 영역 -->
                    <?php
                    session_start();
                    if (isset($_SESSION['error_message'])) {
                        echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
                        unset($_SESSION['error_message']);
                    }
                    ?>

                    <form action="../auth/process_register.php" method="post" onsubmit="return validateForm()">
                        <div class="mb-3">
                            <label for="username" class="form-label">아이디</label>
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="nickname" class="form-label">닉네임</label>
                            <input type="text" id="nickname" name="nickname" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">이메일</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">비밀번호</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">비밀번호 확인</label>
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                        </div>

                        <!-- 약관 및 개인정보 처리방침 동의 -->
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="terms_of_service" required>
                            <label class="form-check-label" for="terms_of_service">
                                이용약관에 동의합니다.
                            </label>
                            <!-- 이용약관 버튼 -->
                            <button type="button" class="btn btn-link open-terms">보기</button>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="privacy_policy" required>
                            <label class="form-check-label" for="privacy_policy">
                                개인정보 처리방침에 동의합니다.
                            </label>
                            <!-- 개인정보 처리방침 버튼 -->
                            <button type="button" class="btn btn-link open-privacy">보기</button>
                        </div>

                        <!-- 이용약관 모달 -->
                        <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" inert> <!-- inert 속성 추가 -->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="termsModalLabel">이용약관</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
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
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 개인정보 처리방침 모달 -->
                        <div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" inert> <!-- inert 속성 추가 -->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="privacyModalLabel">개인정보 처리방침</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h2 class="text-center mb-4">개인정보 처리방침</h2>
                                        <p>GameCouponHub는 개인정보 보호를 매우 중요하게 생각하며, 이용자의 개인정보를 보호하기 위해 최선을 다합니다.</p>
                                        <h3>1. 개인정보의 수집 항목</h3>
                                        <p>우리는 회원가입 시, 이용자의 아이디, 이메일, 닉네임, 비밀번호 등 최소한의 개인정보를 수집합니다.</p>

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
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">회원가입</button>
                    </form>

                    <div class="text-center mt-3">
                        <a href="../auth/login.php">로그인</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 푸터 포함 -->
    <?php
    include $rootPath . "/includes/footer.php";
    ?>


    <script>
        function navigateTo(url) {
            <?php if (!$isLoggedIn): ?>
                alert("로그인 후 이용할 수 있습니다.");
                window.location.href = "../auth/login.php"; // 로그인 페이지로 리다이렉트
            <?php else: ?>
                window.location.href = url; // 로그인된 경우 해당 페이지로 이동
            <?php endif; ?>
        }

        function validateForm() {
            // 약관 동의 및 개인정보 처리방침 체크 확인
            if (!document.getElementById('terms_of_service').checked) {
                alert("이용약관에 동의해야 회원가입이 가능합니다.");
                return false;
            }
            if (!document.getElementById('privacy_policy').checked) {
                alert("개인정보 처리방침에 동의해야 회원가입이 가능합니다.");
                return false;
            }
            return true;
        }

        document.title = "GameCouponHub - 회원가입"; // 페이지 제목 설정
    </script>
</body>

</html>