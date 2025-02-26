<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>사용자 관리</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin_common.css">
    <link rel="stylesheet" href="../assets/css/manage_users.css">
</head>

<body>
    <div class="d-flex">
        <!-- 사이드 메뉴 -->
        <div class="sidebar">
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link" href="../admin/index.php">관리자 대시보드</a></li>
                <li class="nav-item"><a class="nav-link active" href="../admin/manage_users.php">유저 현황</a></li>
                <li class="nav-item"><a class="nav-link" href="../admin/manage_coupons.php">쿠폰 관리</a></li>
                <li class="nav-item"><a class="nav-link" href="../admin/reports.php">쿠폰 제보</a></li>
            </ul>

            <!-- 다크 모드 토글 버튼 (사이드바 하단) -->
            <button id="darkModeToggle" class="btn btn-secondary mode-toggle">🌙</button>
        </div>

        <div class="container mt-5">
            <h2>사용자 관리</h2>

            <!-- 유저 검색 -->
            <div class="mb-3">
                <input type="text" id="searchUser" class="form-control" placeholder="사용자 검색" onkeyup="searchUser()">
            </div>

            <!-- 사용자 목록 테이블 -->
            <table class="table" id="userTable">
                <thead>
                    <tr>
                        <th>아이디</th>
                        <th>이메일</th>
                        <th>마지막 로그인</th>
                        <th>권한</th>
                        <th>관리</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- 사용자 목록은 JavaScript에서 불러와서 표시할 예정 -->
                </tbody>
            </table>

            <!-- 페이지네이션 -->
            <nav>
                <ul class="pagination">
                    <li class="page-item">
                        <button class="page-link" id="prevPage" onclick="changePage(-1)">이전</button>
                    </li>
                    <li class="page-item">
                        <button class="page-link" id="nextPage" onclick="changePage(1)">다음</button>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- 스크립트 중복 확인 -->
        <script src="../assets/js/manage_users.js"></script> <!-- 한 번만 -->
        <script src="../assets/js/darkMode.js"></script>

</body>

</html>