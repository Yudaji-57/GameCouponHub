document.addEventListener("DOMContentLoaded", function() {
    const emailForm = document.getElementById("email-form");
    const passwordForm = document.getElementById("password-form");
    const nicknameForm = document.getElementById("nickname-form");
    const messageDiv = document.getElementById("message");
    const nicknameDisplay = document.getElementById("current-nickname"); // 닉네임 표시할 요소

    // 공통 메시지 출력 함수
    function showMessage(type, text) {
        messageDiv.innerHTML = `<div class="alert alert-${type}">${text}</div>`;
    }

    // AJAX 요청 함수 (공통 처리)
    function sendRequest(data, callback) {
        fetch('../backend/user/profile_settings.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(callback)
        .catch(() => showMessage('danger', '서버 오류가 발생했습니다.'));
    }

    // 페이지 로드 시 닉네임 불러오기
    if (nicknameDisplay) {
        sendRequest({ type: 'get_nickname' }, (data) => {
            if (data.success) {
                nicknameDisplay.value = data.nickname; // input 필드에 값 설정
            } else {
                showMessage('danger', data.message);
            }
        });
    }

    // 이메일 변경 처리
    if (emailForm) {
        emailForm.addEventListener("submit", function(event) {
            event.preventDefault();
            const currentEmail = document.getElementById("current-email").value;
            const newEmail = document.getElementById("new-email").value;

            if (!validateEmail(newEmail)) {
                showMessage('danger', '유효한 이메일을 입력해주세요.');
                return;
            }

            sendRequest({ type: 'email', currentEmail, newEmail }, (data) => {
                showMessage(data.success ? 'success' : 'danger', data.message);
            });
        });
    }

    // 비밀번호 변경 처리
    if (passwordForm) {
        passwordForm.addEventListener("submit", function(event) {
            event.preventDefault();
            const currentPassword = document.getElementById("current-password").value;
            const newPassword = document.getElementById("new-password").value;
            const confirmPassword = document.getElementById("confirm-password").value;

            if (newPassword.length < 8) {
                showMessage('danger', '비밀번호는 최소 8자 이상이어야 합니다.');
                return;
            }

            if (newPassword !== confirmPassword) {
                showMessage('danger', '비밀번호와 비밀번호 확인이 일치하지 않습니다.');
                return;
            }

            sendRequest({ type: 'password', currentPassword, newPassword }, (data) => {
                showMessage(data.success ? 'success' : 'danger', data.message);
            });
        });
    }

    // 닉네임 변경 처리
    if (nicknameForm) {
        nicknameForm.addEventListener("submit", function(event) {
            event.preventDefault();
            const newNickname = document.getElementById("new-nickname").value;

            if (newNickname.length < 3) {
                showMessage('danger', '닉네임은 최소 3자 이상이어야 합니다.');
                return;
            }

            sendRequest({ type: 'nickname', newNickname }, (data) => {
                if (data.success) {
                    showMessage('success', data.message);
                    nicknameDisplay.value = newNickname; // 닉네임 필드 업데이트
                } else {
                    showMessage('danger', data.message);
                }
            });
        });
    }

    // 이메일 유효성 검사
    function validateEmail(email) {
        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        return emailRegex.test(email);
    }
});
