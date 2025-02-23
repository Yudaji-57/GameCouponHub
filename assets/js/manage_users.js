document.addEventListener('DOMContentLoaded', function () {
    fetchUserList();
});

// manage_users.js
let currentPage = 1; // 중복 선언을 피합니다.
const usersPerPage = 10;

// 유저 목록 불러오기
function fetchUserList() {
    fetch(`/backend/admin/manage_users_data.php?page=${currentPage}&limit=${usersPerPage}`)
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                displayUserList(data.users);
                setupPagination(data.totalUsers);
            } else {
                console.error("유저 목록을 불러오는 데 실패했습니다.");
            }
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
}

// 유저 목록을 테이블에 표시
function displayUserList(users) {
    const userTableBody = document.querySelector('#userTable tbody');
    userTableBody.innerHTML = ''; // 기존 목록 비우기

    users.forEach(user => {
        const roleText = user.user_role === 'admin' ? '관리자' : '유저'; // admin이면 '관리자', 아니면 '유저'

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${user.user_id}</td>
            <td>${user.email}</td>
            <td>${user.last_login}</td>
            <td>${roleText}</td>  <!-- 권한 표시 -->
            <td>
<!-- 수정 버튼 -->
<button class="btn btn-warning" onclick="editUser(${user.user_id})">수정</button>

<!-- 차단 버튼 -->
<button class="btn btn-danger" onclick="blockUser(${user.user_id})">차단</button>

            </td>
        `;
        userTableBody.appendChild(row);
    });
}

// 페이지네이션 설정
function setupPagination(totalUsers) {
    const totalPages = Math.ceil(totalUsers / usersPerPage);
    document.getElementById('prevPage').disabled = currentPage === 1;
    document.getElementById('nextPage').disabled = currentPage === totalPages;
}

// 페이지 변경
function changePage(direction) {
    currentPage += direction;
    fetchUserList();
}

// 수정 버튼 클릭 시
function editUser(userId) {
    console.log(`수정할 유저 ID: ${userId}`);

    // 유저 ID가 제대로 전달되었는지 확인
    if (userId) {
        // 유저 수정 페이지로 이동
        window.location.href = `/backend/admin/edit_user.php?user_id=${userId}`;
    } else {
        console.error('유효한 유저 ID가 아닙니다.');
    }
}


// 예시로 차단 버튼 클릭 시
function blockUser(userId) {
    let test1234 = "Some value";  // test1234 변수 선언 및 값 할당
    console.log(test1234);  // test1234를 사용하는 코드

    fetch(`/backend/admin/block_user.php?user_id=${userId}`, {
        method: 'POST'
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                alert("유저가 차단되었습니다.");
                fetchUserList(); // 목록 새로고침
            } else {
                alert("유저 차단에 실패했습니다.");
            }
        })
        .catch(error => {
            console.error("차단 오류:", error);
        });
}

// 유저 검색
function searchUser() {
    const searchTerm = document.getElementById('searchUser').value.toLowerCase();
    const rows = document.querySelectorAll('#userTable tbody tr');

    rows.forEach(row => {
        const userId = row.cells[0].textContent.toLowerCase();
        const email = row.cells[1].textContent.toLowerCase();

        // 이메일과 사용자 ID로 검색
        if (userId.includes(searchTerm) || email.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}
