<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>사용자 관리</title>
    <!-- 사용자 관리 페이지에 필요한 JS 파일 선언 -->
    <script src="/assets/js/manage_users.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin_common.css">
    <!-- 사용자 관리 페이지 CSS -->
    <link rel="stylesheet" href="../assets/css/manage_users.css">
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
                    <a class="nav-link active" href="/admin/manage_users.php">유저 현황</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/manage_coupons.php">쿠폰 관리</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/reports.php">쿠폰 제보</a>
                </li>
            </ul>
        </div>

        <div class="container mt-5">
            <h2>사용자 관리</h2>
            <table class="table" id="userTable">
                <thead>
                    <tr>
                        <th>아이디</th>
                        <th>이메일</th>
                        <th>마지막 로그인</th>
                        <th>권한</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- 사용자 목록은 JavaScript에서 불러와서 여기 표시할 예정 -->
                </tbody>
            </table>
        </div>

        <script src="../assets/js/manage_users.js"></script>
</body>

</html>