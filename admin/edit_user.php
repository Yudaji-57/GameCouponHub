<!-- /frontend/admin/edit_user.php -->
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>유저 정보 수정</title>
    <link rel="stylesheet" href="../assets/css/admin_common.css">
    <link rel="stylesheet" href="../assets/css/edit_user.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="/admin/index.php">관리자 대시보드</a></li>
            <li class="nav-item"><a class="nav-link active" href="/admin/manage_users.php">유저 현황</a></li>
            <li class="nav-item"><a class="nav-link" href="/admin/manage_coupons.php">쿠폰 관리</a></li>
            <li class="nav-item"><a class="nav-link" href="/admin/reports.php">쿠폰 제보</a></li>
        </ul>

        <!-- 다크 모드 토글 버튼 (사이드바 하단) -->
        <button id="darkModeToggle" class="btn btn-secondary mode-toggle">🌙</button>
    </div>

    <div class="container mt-5">
        <h2>유저 정보 수정</h2>
        <form id="editUserForm" autocomplete="off"> <!-- 폼 전체에 대해 자동완성 끄기 -->
            <div class="mb-3">
                <label for="userId" class="form-label">유저 ID</label>
                <input type="text" id="userId" class="form-control" readonly autocomplete="off"> <!-- 자동완성 끄기 -->
            </div>
            <div class="mb-3">
                <label for="nickname" class="form-label">닉네임</label>
                <input type="text" id="nickname" class="form-control" required autocomplete="off"> <!-- 자동완성 끄기 -->
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">이메일</label>
                <input type="email" id="email" class="form-control" required autocomplete="off"> <!-- 자동완성 끄기 -->
            </div>
            <div class="mb-3">
                <label for="userRole" class="form-label">권한</label>
                <select id="userRole" class="form-control">
                    <option value="user">유저</option>
                    <option value="admin">관리자</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="blocked" class="form-label">차단 여부</label>
                <select id="blocked" class="form-control">
                    <option value="0">활성</option>
                    <option value="1">차단</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">수정 완료</button>
        </form>

    </div>

    <script src="/assets/js/edit_user.js"></script>
    <script src="../assets/js/darkMode.js"></script>
</body>

</html>