<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>쿠폰 관리</title>
    <script src="/assets/js/manage_coupons.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin_common.css">
    <link rel="stylesheet" href="../assets/css/manage_coupons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex">
        <div class="sidebar">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="/admin/index.php">관리자 대시보드</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/manage_users.php">유저 현황</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/admin/manage_coupons.php">쿠폰 관리</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/reports.php">쿠폰 제보</a>
                </li>
            </ul>
        </div>

        <div class="container mt-5 ms-5">
            <h2 class="mb-4">쿠폰 관리</h2>

            <!-- 검색 입력 -->
            <div class="mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="검색...">
            </div>

            <!-- 쿠폰 테이블 -->
            <table class="table table-bordered table-striped table-hover" id="couponTable">
                <thead>
                    <tr>
                        <th>게임명</th>
                        <th>쿠폰 코드</th>
                        <th>보상 내용</th>
                        <th>발급일</th>
                        <th>만료일</th>
                        <th>쿠폰 생성일</th>
                        <th>쿠폰타입</th>
                        <th>만료여부</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- 쿠폰 목록은 JavaScript에서 불러와서 여기 표시할 예정 -->
                </tbody>
            </table>

            <div id="noCouponsMessage" class="alert alert-warning" style="display: none;">
                <strong>알림!</strong> 쿠폰 데이터가 없습니다.
            </div>

            <!-- 페이지 네비게이션 -->
            <div class="d-flex justify-content-between">
                <button id="prevButton" class="btn btn-secondary" disabled>이전</button>
                <span id="pageInfo"></span>
                <button id="nextButton" class="btn btn-secondary">다음</button>
            </div>
        </div>
    </div>
</body>

</html>
