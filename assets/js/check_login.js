async function checkLoginStatus() {
    try {
        const response = await fetch("../backend/auth/check_login.php");
        const data = await response.json();

        // 로그인 상태에 따라 메뉴 변경
        const loginLink = document.getElementById("loginLink");
        const dynamicMenu = document.getElementById("dynamicMenu");

        if (data.isLoggedIn) {
            // 로그인 상태일 때 "로그인" 링크 숨기기
            loginLink.style.display = "none";

            // "마이페이지" 메뉴 추가
            const myPageItem = document.createElement('a');
            myPageItem.href = "../pages/mypage.html";
            myPageItem.className = "nav-link";
            myPageItem.style.color = "#fff";
            myPageItem.textContent = "마이페이지";

            // "로그아웃" 메뉴 추가
            const logoutItem = document.createElement('a');
            logoutItem.href = "../auth/logout.php";
            logoutItem.className = "nav-link";
            logoutItem.style.color = "#fff";
            logoutItem.textContent = "로그아웃";

            // 관리자일 경우 "관리자 페이지" 메뉴 추가
            if (data.isAdmin) {
                const adminItem = document.createElement('a');
                adminItem.href = "../admin/index.html";
                adminItem.className = "nav-link";
                adminItem.style.color = "#fff";
                adminItem.textContent = "관리자 페이지";

                // 관리자 메뉴 추가
                dynamicMenu.appendChild(adminItem);
            }

            // 동적으로 "마이페이지"와 "로그아웃" 메뉴 추가
            dynamicMenu.appendChild(myPageItem);
            dynamicMenu.appendChild(logoutItem);
        } else {
            // 로그인되지 않았을 때 "로그인" 링크 보이기
            loginLink.style.display = "block";
        }
    } catch (error) {
        console.error("로그인 상태 확인 오류:", error);
    }
}

// 로그인 상태 체크 실행
document.addEventListener("DOMContentLoaded", checkLoginStatus);

