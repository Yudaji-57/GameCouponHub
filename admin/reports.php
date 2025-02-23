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
                <li class="nav-item">
                    <a class="nav-link " href="/admin/index.php">관리자 대시보드</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/manage_users.php">유저 현황</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/manage_coupons.php">쿠폰 관리</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/admin/reports.php">쿠폰 제보</a>
                </li>
            </ul>
        </div>

        <div class="container mt-5">
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

        <script src="../assets/js/reports.js"></script>
</body>

</html>