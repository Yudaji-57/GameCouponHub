<!DOCTYPE html>
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
    <!-- 부트스트랩 JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
    session_start();

    // 로그인 상태 체크
    $isLoggedIn = isset($_SESSION['user_id']); // 로그인된 상태인지 확인

    if (!$isLoggedIn) {
        header("Location: ../auth/login.php");
        exit();
    }

    $userId = $_SESSION['user_id']; // 로그인한 사용자의 ID

    // 데이터베이스 연결
    $rootPath = "/volume1/web/GameCouponHub";
    include $rootPath . "/includes/header.php";
    include $rootPath . "/backend/config/database.php";

    // 사용자 정보와 포인트 정보 조인하여 가져오기
    $stmt = $pdo->prepare("SELECT u.user_id, u.user_id, u.nickname, p.available_points, p.expiring_points
               FROM users u
               LEFT JOIN user_points p ON u.user_id = p.user_id
               WHERE u.user_id = :userId");

    $stmt->bindParam(':userId', $userId, PDO::PARAM_STR); // user_id를 문자열로 처리
    $stmt->execute();
    $userData = $stmt->fetch();

    if ($userData) {
        // 사용자 정보와 포인트 정보 출력
        $nickname = htmlspecialchars($userData['nickname']);

        // 포인트 값이 NULL일 수 있으므로 처리
        $availablePoints = !is_null($userData['available_points']) ? number_format($userData['available_points']) . 'P' : '0P';
        $expiringPoints = !is_null($userData['expiring_points']) ? number_format($userData['expiring_points']) . 'P' : '0P';

        // echo "닉네임: $nickname <br>";
        // echo "가용 포인트: $availablePoints <br>";
        // echo "소멸 예정 포인트: $expiringPoints <br>";
    } else {
        // echo "유효하지 않는 사용자 ID입니다.";
        exit();
    }


    // 사용자가 제보한 쿠폰 개수 가져오기
    $stmt = $pdo->prepare("SELECT COUNT(*) AS report_count FROM coupons_report WHERE user_id = :userId");
    $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
    $stmt->execute();
    $reportData = $stmt->fetch();
    $reportCount = $reportData ? $reportData['report_count'] : 0;

    // 복사된 쿠폰 리스트 가져오기
    $stmt = $pdo->prepare("SELECT game_name, coupon_code, expiry_date FROM coupons WHERE user_id = :userId");
    $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
    $stmt->execute();
    $coupons = $stmt->fetchAll();
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
                    <a class="nav-link active" href="#" onclick="navigateTo('../pages/mypage.php')">마이페이지</a>
                </li>
            <?php endif; ?>
            <li class="nav-item">
                <a class="nav-link" href="../pages/settings.php">설정</a>
            </li>
        </ul>
    </div>

    <main class="content container mt-4">
        <h2>마이페이지</h2>

        <!-- 탭 버튼 -->
        <ul class="nav nav-tabs" id="mypageTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="coupons-tab" data-bs-toggle="tab" href="#coupons" role="tab" aria-controls="coupons" aria-selected="true">복사된 게임별 쿠폰리스트</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="report-tab" data-bs-toggle="tab" href="#report" role="tab" aria-controls="report" aria-selected="false">쿠폰 제보 내역</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">내 정보 수정</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="points-tab" data-bs-toggle="tab" href="#points" role="tab" aria-controls="points" aria-selected="false">포인트 정보</a>
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
            <!-- 보유 쿠폰 탭 -->
            <div class="tab-pane fade show active" id="coupons" role="tabpanel" aria-labelledby="coupons-tab">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">복사된 게임별 쿠폰 리스트</h5>
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

            <!-- 쿠폰 제보 내역 탭 -->
            <div class="tab-pane fade" id="report" role="tabpanel" aria-labelledby="report-tab">
                <div class="card" style="min-height: 500px;">
                    <div class="card-body" style="height: 100%; overflow-y: auto;">
                        <h5 class="card-title">쿠폰 제보 내역</h5>
                        <?php
                        // 쿠폰 제보 내역을 가져오는 쿼리
                        $stmt = $pdo->prepare("SELECT game_name, coupon_code, reward_details, issue_date, expiration_date, approval_status, coupon_type
               FROM coupons_report
               WHERE user_id = :userId
               ORDER BY issue_date DESC");
                        $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
                        $stmt->execute();
                        $reports = $stmt->fetchAll();

                        if ($reports):
                            echo '<ul class="list-group" style="max-height: 400px; overflow-y: auto;">'; // 여기서 높이를 더 키웠습니다.
                            foreach ($reports as $report):
                                // 승인 상태에 따른 배지 색상 설정
                                $statusText = "";
                                $badgeClass = "";

                                switch ($report['approval_status']) {
                                    case 0:
                                        $statusText = "대기 중";
                                        $badgeClass = "bg-warning text-dark";
                                        break;
                                    case 1:
                                        $statusText = "승인 됨";
                                        $badgeClass = "bg-success";
                                        break;
                                    case 2:
                                        $statusText = "거부 됨";
                                        $badgeClass = "bg-danger";
                                        break;
                                }

                                // 만료일을 현재 날짜와 비교하여 상태 표시
                                $expirationStatus = (strtotime($report['expiration_date']) < time()) ? "만료됨" : "유효";

                                echo '<li class="list-group-item">';
                                echo '<strong>' . htmlspecialchars($report['game_name']) . '</strong>';
                                echo '<p>' . htmlspecialchars($report['reward_details']) . '</p>';
                                echo '<span class="badge ' . $badgeClass . '">' . $statusText . '</span>';
                                echo '<span class="badge bg-secondary">발급일: ' . $report['issue_date'] . '</span>';
                                echo '<span class="badge bg-info">만료일: ' . $report['expiration_date'] . ' (' . $expirationStatus . ')</span>';
                                echo '</li>';
                            endforeach;
                            echo '</ul>';
                        else:
                            echo '<p>제보된 쿠폰이 없습니다.</p>';
                        endif;
                        ?>
                    </div>
                </div>
            </div>

            <!-- 내 정보 수정 탭 -->
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">내 정보 수정</h5>
                        <p>이메일, 비밀번호, 닉네임 변경</p>
                        <!-- 이메일, 비밀번호, 주소 변경 수정 링크 -->
                        <a href="../pages/profile_settings.php" class="btn btn-primary">내 정보 수정</a>
                    </div>
                </div>
            </div>

            <!-- 포인트 정보 탭 -->
            <div class="tab-pane fade" id="points" role="tabpanel" aria-labelledby="points-tab">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">포인트 정보</h5>
                        <p>가용 포인트: <strong><?= $availablePoints ?></strong></p>
                        <p>소멸 예정 포인트: <strong><?= $expiringPoints ?></strong></p>
                    </div>
                </div>
            </div>

            <!-- 포인트 사용 내역 탭 -->
            <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                <div class="card" style="min-height: 500px;">
                    <div class="card-body" style="height: 100%; overflow-y: auto;">
                        <h5 class="card-title">포인트 사용 내역</h5>
                        <p>포인트 사용 내역을 여기에 표시합니다.</p>
                        <!-- 여기에 포인트 사용 내역을 동적으로 출력할 수 있습니다. 예시로는 아래처럼 사용할 수 있습니다. -->
                        <ul class="list-group" style="max-height: 400px; overflow-y: auto;">
                            <li class="list-group-item">
                                <strong>게임명:</strong> 게임 1 <br>
                                <strong>사용 포인트:</strong> 100P <br>
                                <strong>사용일:</strong> 2025-03-01
                            </li>
                            <li class="list-group-item">
                                <strong>게임명:</strong> 게임 2 <br>
                                <strong>사용 포인트:</strong> 200P <br>
                                <strong>사용일:</strong> 2025-03-02
                            </li>
                            <!-- 실제 데이터를 여기에서 출력 -->
                        </ul>
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

    <script>
        function copyToClipboard(text) {
            const tempTextArea = document.createElement('textarea');
            tempTextArea.value = text;
            document.body.appendChild(tempTextArea);
            tempTextArea.select();
            document.execCommand('copy');
            document.body.removeChild(tempTextArea);
            alert('쿠폰 코드가 복사되었습니다.');
        }

        // 로그인 상태에 따라 이동
        function navigateTo(url) {
            <?php if (!$isLoggedIn): ?>
                alert("로그인 후 이용할 수 있습니다.");
                window.location.href = "../auth/login.php"; // 로그인 페이지로 리다이렉트
            <?php else: ?>
                window.location.href = url; // 로그인된 경우 해당 페이지로 이동
            <?php endif; ?>
        };

        document.title = "GameCouponHub - 마이페이지";
    </script>
    <?php include $rootPath . "/includes/footer.php"; ?>
</body>

</html>