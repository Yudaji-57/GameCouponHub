document.addEventListener("DOMContentLoaded", function() {
    const emailForm = document.getElementById("email-form");
    const passwordForm = document.getElementById("password-form");
    const nicknameForm = document.getElementById("nickname-form");
    const messageDiv = document.getElementById("message");
    const nicknameDisplay = document.getElementById("current-nickname"); // 닉네임을 표시할 요소

    // 페이지 로드 시 닉네임 불러오기
    fetch('../backend/user/profile_settings.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ type: 'get_nickname' }) // 닉네임을 가져오기 위한 요청
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // 닉네임이 성공적으로 로드되었으면 화면에 표시
            nicknameDisplay.innerText = data.nickname;
        } else {
            // 에러 처리
            messageDiv.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
        }
    })
    .catch(error => {
        messageDiv.innerHTML = `<div class="alert alert-danger">서버 오류가 발생했습니다.</div>`;
    });

    // 이메일 폼 제출 시 처리
    emailForm.addEventListener("submit", function(event) {
        event.preventDefault(); // 기본 폼 제출 방지

        const currentEmail = document.getElementById("current-email").value;
        const newEmail = document.getElementById("new-email").value;

        // 이메일 유효성 검사
        if (!validateEmail(newEmail)) {
            messageDiv.innerHTML = `<div class="alert alert-danger">유효한 이메일을 입력해주세요.</div>`;
            return;
        }

        // AJAX 요청을 통해 백엔드에 이메일 변경 요청
        fetch('../backend/user/profile_settings.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ type: 'email', currentEmail, newEmail }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                messageDiv.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
            } else {
                messageDiv.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
            }
        })
        .catch(error => {
            messageDiv.innerHTML = `<div class="alert alert-danger">서버 오류가 발생했습니다.</div>`;
        });
    });

    // 비밀번호 폼 제출 시 처리
    passwordForm.addEventListener("submit", function(event) {
        event.preventDefault(); // 기본 폼 제출 방지

        const currentPassword = document.getElementById("current-password").value;
        const newPassword = document.getElementById("new-password").value;
        const confirmPassword = document.getElementById("confirm-password").value;

        // 비밀번호 유효성 검사
        if (!validatePassword(newPassword)) {
            messageDiv.innerHTML = `<div class="alert alert-danger">비밀번호는 최소 8자 이상이어야 합니다.</div>`;
            return;
        }

        if (newPassword !== confirmPassword) {
            messageDiv.innerHTML = `<div class="alert alert-danger">비밀번호와 비밀번호 확인이 일치하지 않습니다.</div>`;
            return;
        }

        // AJAX 요청을 통해 백엔드에 비밀번호 변경 요청
        fetch('../backend/user/profile_settings.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ type: 'password', currentPassword, newPassword }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                messageDiv.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
            } else {
                messageDiv.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
            }
        })
        .catch(error => {
            messageDiv.innerHTML = `<div class="alert alert-danger">서버 오류가 발생했습니다.</div>`;
        });
    });

    // 닉네임 폼 제출 시 처리
    nicknameForm.addEventListener("submit", function(event) {
        event.preventDefault(); // 기본 폼 제출 방지

        const newNickname = document.getElementById("new-nickname").value;

        // 닉네임 유효성 검사
        if (newNickname.length < 3) {
            messageDiv.innerHTML = `<div class="alert alert-danger">닉네임은 최소 3자 이상이어야 합니다.</div>`;
            return;
        }

        // AJAX 요청을 통해 백엔드에 닉네임 변경 요청
        fetch('../backend/user/profile_settings.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ type: 'nickname', newNickname }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                messageDiv.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
                // 닉네임 업데이트 후 화면에 반영
                nicknameDisplay.innerText = newNickname;
            } else {
                messageDiv.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
            }
        })
        .catch(error => {
            messageDiv.innerHTML = `<div class="alert alert-danger">서버 오류가 발생했습니다.</div>`;
        });
    });

    // 이메일 유효성 검사
    function validateEmail(email) {
        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        return emailRegex.test(email);
    }

    // 비밀번호 유효성 검사
    function validatePassword(password) {
        return password.length >= 8; // 최소 8자 이상
    }
});
