<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>관리자 대시보드</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin_common.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <!-- 차트 라이브러리 추가 (예시로 Chart.js 사용) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="d-flex">
        <!-- 사이드 메뉴 -->
        <div class="sidebar">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="/admin/index.php">관리자 대시보드</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/manage_users.php">유저 현황</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/manage_coupons.php">쿠폰 관리</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/reports.php">쿠폰 제보</a>
                </li>
            </ul>
        </div>

        <!-- 메인 콘텐츠 -->
        <div class="container mt-5">
            <h2>관리자 대시보드</h2>

            <!-- 대시보드 지표 -->
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
                            <h5 class="card-title">총 쿠폰 수</h5>
                            <p class="card-text" id="totalCoupons">0개</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card text-white bg-danger">
                        <div class="card-body">
                            <h5 class="card-title">오늘의 신규 제보</h5>
                            <p class="card-text" id="todayReports">0개</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 쿠폰 제보 리스트 테이블 -->
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
                <tbody>
                    <!-- 이곳에 JavaScript에서 동적으로 데이터를 추가 -->
                </tbody>
            </table>

            <p id="noCouponsMessage" style="display: none;">현재 제보된 쿠폰이 없습니다.</p>


            <!-- 차트: 쿠폰 제보 월별 통계 -->
            <h4>월별 쿠폰 제보 통계</h4>
            <canvas id="reportChart"></canvas>

        </div>
    </div>

    <script src="../assets/js/dashboard.js"></script>
    <script>
        // 대시보드 데이터 업데이트 (예시)
        fetch('/backend/admin/dashboard_data.php')
            .then(response => response.json())
            .then(data => {
                // 대시보드 지표 데이터
                document.getElementById('totalUsers').innerText = `${data.totalUsers}명`;
                document.getElementById('totalReports').innerText = `${data.totalReports}개`;
                document.getElementById('totalCoupons').innerText = `${data.totalCoupons}개`;
                document.getElementById('todayReports').innerText = `${data.todayReports}개`;

                // 월별 쿠폰 제보 통계 차트
                const ctx = document.getElementById('reportChart').getContext('2d');
                const reportChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.months,
                        datasets: [{
                            label: '월별 제보 수',
                            data: data.monthlyReports,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => {
                console.error('대시보드 데이터 로드 실패:', error);
            });
    </script>
</body>

</html>