<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>쿠폰 관리</title>
    <!-- 쿠폰 관리 페이지에 필요한 JS 파일 선언 -->
    <script src="/assets/js/manage_coupons.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin_common.css">
    <!-- 쿠폰 관리 페이지 CSS -->
    <link rel="stylesheet" href="../assets/css/manage_coupons.css">
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
                    <a class="nav-link " href="/admin/manage_users.php">유저 현황</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/admin/manage_coupons.php">쿠폰 관리</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/reports.php">쿠폰 제보</a>
                </li>
            </ul>
        </div>

        <div class="container mt-5">
            <h2>쿠폰 관리</h2>
            <table class="table" id="couponTable">
                <thead>
                    <tr>
                        <th>게임명</th>
                        <th>쿠폰 코드</th>                        
                        <th>보상 내용</th>
                        <th>발급일</th>
                        <th>만료일</th>
                        <th>쿠폰 생성일</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- 쿠폰 목록은 JavaScript에서 불러와서 여기 표시할 예정 -->
                </tbody>
            </table>
            <div id="noCouponsMessage" class="alert alert-warning" style="display: none;">
                쿠폰 데이터가 없습니다.
            </div>
        </div>
    </div>

    <!-- JavaScript 파일이 한 번만 포함되도록 수정 -->
    <script src="../assets/js/manage_coupons.js"></script>
</body>

</html>
