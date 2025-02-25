<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>쿠폰 제보 리스트</title>
    <!-- 쿠폰 제보 리스트 페이지에 필요한 JS 파일 선언 -->
    <script src="/assets/js/reports.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin_common.css">
    <!-- 쿠폰 제보 리스트 페이지 CSS -->
    <link rel="stylesheet" href="../assets/css/reports.css">
</head>

<body>
    <div class="d-flex">
        <!-- 사이드 메뉴 -->
        <div class="sidebar">
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link" href="/admin/index.php">관리자 대시보드</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/manage_users.php">유저 현황</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/manage_coupons.php">쿠폰 관리</a></li>
                <li class="nav-item"><a class="nav-link active" href="/admin/reports.php">쿠폰 제보</a></li>
            </ul>

            <!-- 다크 모드 토글 버튼 (사이드바 하단) -->
            <button id="darkModeToggle" class="btn btn-secondary mode-toggle">🌙</button>
        </div>

        <div class="container mt-5">
          
            <!-- 쿠폰 등록 폼 -->
            <h3>쿠폰 등록</h3>
            <form id="couponForm" method="POST" action="/backend/admin/coupon_add.php">
                <div class="mb-3">
                    <label for="game_name" class="form-label">게임명</label>
                    <input type="text" class="form-control" id="game_name" name="game_name" required>
                </div>
                <div class="mb-3">
                    <label for="coupon_code" class="form-label">쿠폰 코드</label>
                    <input type="text" class="form-control" id="coupon_code" name="coupon_code" required>
                </div>
                <div class="mb-3">
                    <label for="reward_details" class="form-label">보상 내용</label>
                    <textarea class="form-control" id="reward_details" name="reward_details" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="issue_date" class="form-label">발급일</label>
                    <input type="date" class="form-control" id="issue_date" name="issue_date" required>
                </div>
                <div class="mb-3">
                    <label for="expiration_date" class="form-label">만료일</label>
                    <input type="date" class="form-control" id="expiration_date" name="expiration_date" required>
                </div>
                <div class="mb-3">
                    <label for="coupon_type" class="form-label">쿠폰유형</label>
                    <input type="text" class="form-control" id="coupon_type" name="coupon_type" required>
                </div>
                <button type="submit" class="btn btn-primary">쿠폰 추가</button>
            </form>

            <hr>
            <h2>쿠폰 제보 리스트</h2>
            <table class="table" id="reportTable">
                <thead>
                    <tr>
                        <th>아이디</th>
                        <th>게임명</th>
                        <th>쿠폰 코드</th>
                        <th>보상 내용</th>
                        <th>제보 날짜</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- 제보 목록은 JavaScript에서 불러와서 여기 표시할 예정 -->
                </tbody>
            </table>
        </div>
    </div>

    <script src="../assets/js/reports.js"></script>
    <script src="../assets/js/darkMode.js"></script>
</body>

</html>
