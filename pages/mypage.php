<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/common.css">
    <link rel="stylesheet" href="../assets/css/user_common.css">
    <link rel="stylesheet" href="../assets/css/mypage.css">
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- 부트스트랩 CSS 링크 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../auth/login.php");
        exit();
    }

    $userId = $_SESSION['user_id']; // 로그인한 사용자의 ID

    // 데이터베이스 연결
    $rootPath = "/volume1/web/GameCouponHub";
    include $rootPath . "/includes/header.php";
    include $rootPath . "/backend/config/database.php";

    // 사용자 정보와 포인트 정보 조인하여 가져오기
    $stmt = $pdo->prepare("
SELECT u.user_index, u.user_id, u.nickname, p.available_points, p.expiring_points
FROM users u
LEFT JOIN user_points p ON u.user_index = p.user_id
WHERE u.user_id = :userId
");

    $stmt->bindParam(':userId', $userId, PDO::PARAM_STR); // user_id를 문자열로 처리
    $stmt->execute();
    $userData = $stmt->fetch();

    if ($userData) {
        // 사용자 정보와 포인트 정보 출력
        $nickname = htmlspecialchars($userData['nickname']);

        // 포인트가 없으면 0으로 설정하고 천 단위 구분자와 "P" 단위 추가
        $availablePoints = isset($userData['available_points']) ? number_format($userData['available_points']) . 'P' : '0P';
        $expiringPoints = isset($userData['expiring_points']) ? number_format($userData['expiring_points']) . 'P' : '0P';
    } else {
        echo "유효하지 않는 사용자 ID입니다.";
        exit();
    }
    ?>




    <nav id="sidebar" class="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="../pages/index.php">메인</a></li>
            <li class="nav-item"><a class="nav-link" href="../pages/games.php">게임 목록</a></li>
            <li class="nav-item"><a class="nav-link active" href="../pages/mypage.php">마이페이지</a></li>
            <li class="nav-item"><a class="nav-link" href="../pages/settings.php">설정</a></li>
        </ul>
    </nav>

    <main class="content container mt-4">
        <h2>마이페이지</h2>

        <!-- 탭 버튼 -->
        <ul class="nav nav-tabs" id="mypageTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="points-tab" data-bs-toggle="tab" href="#points" role="tab" aria-controls="points" aria-selected="true">포인트 정보</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="coupons-tab" data-bs-toggle="tab" href="#coupons" role="tab" aria-controls="coupons" aria-selected="false">보유 쿠폰</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">내 정보 수정</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="history-tab" data-bs-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="false">포인트 사용 내역</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="logout-tab" data-bs-toggle="tab" href="#logout" role="tab" aria-controls="logout" aria-selected="false">로그아웃</a>
            </li>
        </ul>

        <!-- 탭 내용 -->
        <div class="tab-content mt-3" id="mypageTabsContent">
            <!-- 포인트 정보 탭 -->
            <div class="tab-pane fade show active" id="points" role="tabpanel" aria-labelledby="points-tab">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">포인트 정보</h5>
                        <p>가용 포인트: <strong><?= $availablePoints ?></strong></p>
                        <p>소멸 예정 포인트: <strong><?= $expiringPoints ?></strong></p>
                    </div>
                </div>
            </div>

            <!-- 보유 쿠폰 탭 -->
            <div class="tab-pane fade" id="coupons" role="tabpanel" aria-labelledby="coupons-tab">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">보유 쿠폰</h5>
                        <?php if (!empty($coupons)): ?>
                            <ul class="list-group">
                                <?php foreach ($coupons as $coupon): ?>
                                    <li class="list-group-item">
                                        <strong><?= htmlspecialchars($coupon['game_name']) ?></strong>
                                        <span><?= htmlspecialchars($coupon['coupon_code']) ?></span>
                                        <span class="badge"><?= $coupon['expiry_date'] ?></span>
                                        <button class="btn btn-sm btn-outline-primary" onclick="copyToClipboard('<?= $coupon['coupon_code'] ?>')">복사</button>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p>등록된 쿠폰이 없습니다.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- 내 정보 수정 탭 -->
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">내 정보 수정</h5>
                        <p>이메일, 비밀번호, 주소 변경</p>
                        <a href="../pages/profile_settings.php" class="btn btn-primary">내 정보 수정</a>
                    </div>
                </div>
            </div>

            <!-- 포인트 사용 내역 탭 -->
            <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">포인트 사용 내역</h5>
                        <a href="../pages/point_history.php" class="btn btn-secondary">사용 내역 보기</a>
                    </div>
                </div>
            </div>

            <!-- 로그아웃 탭 -->
            <div class="tab-pane fade" id="logout" role="tabpanel" aria-labelledby="logout-tab">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">로그아웃</h5>
                        <a href="../auth/logout.php" class="btn btn-danger">로그아웃</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include $rootPath . "/includes/footer.php"; ?>

    <script>
        // 쿠폰 복사 기능
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert("쿠폰 코드가 복사되었습니다!");
            }).catch(err => {
                console.error("복사 실패: ", err);
            });
        }

        document.title = "GameCouponHub - 마이페이지";
    </script>

    <!-- 부트스트랩 JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>