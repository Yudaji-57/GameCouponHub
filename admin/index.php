<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>관리자 대시보드</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin_common.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="d-flex">
        <div class="sidebar">
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link active" href="../admin/index.php">관리자 대시보드</a></li>
                <li class="nav-item"><a class="nav-link" href="../admin/manage_users.php">유저 현황</a></li>
                <li class="nav-item"><a class="nav-link" href="../admin/manage_coupons.php">쿠폰 관리</a></li>
                <li class="nav-item"><a class="nav-link" href="../admin/reports.php">쿠폰 제보</a></li>
            </ul>

            <!-- 다크 모드 토글 버튼 (사이드바 하단) -->
            <button id="darkModeToggle" class="btn btn-secondary mode-toggle">🌙</button>
        </div>


        <div class="container mt-5">
            <h2>관리자 대시보드</h2>

            <div class="row mb-4">
                <div class="col-lg-3 col-md-6">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <h5 class="card-title">전체 사용자 수</h5>
                            <p class="card-text" id="totalUsers">0명</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h5 class="card-title">쿠폰 제보 수</h5>
                            <p class="card-text" id="totalReports">0개</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card text-white bg-warning">
                        <div class="card-body">
                            <h5 class="card-title">기존 쿠폰 수</h5>
                            <p class="card-text" id="totalCoupons">0개</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card text-white bg-danger">
                        <div class="card-body">
                            <h5 class="card-title">오늘 제보된 쿠폰</h5>
                            <p class="card-text" id="todayReports">0개</p>
                        </div>
                    </div>
                </div>
            </div>

            <h4>최근 쿠폰 제보 리스트</h4>
            <table id="couponTable" class="table">
                <thead>
                    <tr>
                        <th>아이디</th>
                        <th>게임명</th>
                        <th>쿠폰 코드</th>
                        <th>보상 내용</th>
                        <th>제보 날짜</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            <h4>월별 쿠폰 제보 통계</h4>
            <canvas id="reportChart"></canvas>
        </div>
    </div>

    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/darkMode.js"></script>
</body>

</html>