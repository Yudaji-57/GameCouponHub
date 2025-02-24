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
        console.log(user); // 유저 정보가 제대로 들어오는지 확인

        const roleText = user.user_role === 'admin' ? '관리자' : '유저';

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${user.user_id}</td>
            <td>${user.email}</td>
            <td>${user.last_login}</td>
            <td>${roleText}</td>
            <td>
                <button class="btn btn-warning edit-btn" data-user-id="${user.user_id}">수정</button>
            </td>
        `;
        userTableBody.appendChild(row);
    });

    // 모든 수정 버튼에 클릭 이벤트 추가
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.getAttribute('data-user-id');
            console.log(`수정할 유저 ID: ${userId}`);
            editUser(userId);
        });
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
    console.log(`유저 ID 타입:`, typeof userId); // 타입 확인

    // 유저 ID가 유효한지 검사
    if (userId && typeof userId === 'string' && userId.trim() !== '') {
        // 유저 수정 페이지로 이동 (URL 인코딩 적용)
        window.location.href = `/admin/edit_user.php?user_id=${encodeURIComponent(userId.trim())}`;
    } else {
        console.error('❌ 유효한 유저 ID가 아닙니다.');
        alert('유효한 유저 ID가 아닙니다.');
    }
}

// 유저 검색
function searchUser() {
    const searchTerm = document.getElementById('searchUser').value.toLowerCase().trim();
    const rows = document.querySelectorAll('#userTable tbody tr');

    rows.forEach(row => {
        const userId = row.cells[0].textContent.toLowerCase().trim();
        const email = row.cells[1].textContent.toLowerCase().trim();

        // 이메일과 사용자 ID로 검색
        row.style.display = (userId.includes(searchTerm) || email.includes(searchTerm)) ? '' : 'none';
    });
}

