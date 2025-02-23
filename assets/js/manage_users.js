// 사용자 목록을 불러와서 테이블에 추가하는 JavaScript 코드

fetch('/backend/admin/users_data.php') // PHP 파일에서 사용자 데이터를 불러오기
    .then(response => response.json())  // JSON 응답 받기
    .then(data => {
        if (data.users) {
            const userTableBody = document.querySelector("#userTable tbody");

            // 테이블 내용 초기화 (중복 방지)
            userTableBody.innerHTML = '';

            // 사용자 데이터가 없으면 메시지 표시
            if (data.users.length === 0) {
                const row = document.createElement("tr");
                row.innerHTML = `<td colspan="4">등록된 사용자가 없습니다.</td>`;  // 열 수를 4로 맞추기
                userTableBody.appendChild(row);
            } else {
                // 사용자 목록을 테이블에 추가
                data.users.forEach(user => {
                    const roleText = user.user_role === 'admin' ? '관리자' : '유저';  // user_role 값에 따른 표시
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${user.user_id}</td>
                        <td>${user.email}</td>
                        <td>${user.last_login}</td>
                        <td>${roleText}</td>  <!-- 유저 역할을 '관리자' 또는 '유저'로 표시 -->
                    `;
                    userTableBody.appendChild(row);
                });
            }
        } else {
            console.error('사용자 데이터 로드 실패');
        }
    })
    .catch(error => {
        console.error('사용자 데이터를 불러오는 중 오류가 발생했습니다.', error);
    });
