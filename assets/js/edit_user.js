document.addEventListener('DOMContentLoaded', function () {
    // URL에서 유저 ID 가져오기
    const urlParams = new URLSearchParams(window.location.search);
    const userId = urlParams.get('user_id');

    if (userId) {
        // 유저 정보 요청
        fetch(`/backend/admin/get_user.php?user_id=${encodeURIComponent(userId)}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // 유저 정보가 성공적으로 로드되면, 폼 필드에 표시
                    document.getElementById('userId').value = data.user.user_id;
                    document.getElementById('nickname').value = data.user.nickname;
                    document.getElementById('email').value = data.user.email;
                    document.getElementById('userRole').value = data.user.user_role;
                    document.getElementById('blocked').value = data.user.blocked;
                } else {
                    alert('유저 정보를 불러오는 데 실패했습니다.');
                    window.location.href = '/admin/manage_users.php'; // 실패 시 유저 목록 페이지로 이동
                }
            })
            .catch(error => {
                console.error('유저 정보 로딩 실패:', error);
            });
    } else {
        alert('유효한 유저 ID가 아닙니다.');
        window.location.href = '/admin/manage_users.php';
    }

    // 폼 제출 처리
    document.getElementById('editUserForm').addEventListener('submit', function (e) {
        e.preventDefault();

        // 수정된 유저 정보 가져오기
        const updatedUser = {
            user_id: document.getElementById('userId').value,
            nickname: document.getElementById('nickname').value.trim(),
            email: document.getElementById('email').value.trim(),
            user_role: document.getElementById('userRole').value,
            blocked: document.getElementById('blocked').value
        };

        // 서버로 수정된 유저 정보 전송
        fetch('/backend/admin/edit_user.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(updatedUser)
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('유저 정보가 성공적으로 수정되었습니다.');
                    window.location.href = '/admin/manage_users.php';
                } else {
                    alert('수정 오류: ' + data.message);
                }
            })
            .catch(error => {
                console.error('수정 오류:', error);
            });
    });
});
