// /assets/js/notification_settings.js
// 알림 설정 페이지에서 이메일과 푸시 알림 수신 여부를 설정하는 JS 로직

document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("notification-form");
    const messageDiv = document.getElementById("message");

    // 폼 제출 시 처리
    form.addEventListener("submit", function(event) {
        event.preventDefault(); // 기본 폼 제출 방지

        const email_notifications = document.getElementById("email_notifications").checked ? 1 : 0;
        const push_notifications = document.getElementById("push_notifications").checked ? 1 : 0;

        // AJAX 요청을 통해 백엔드에 알림 설정 변경 요청
        fetch('/backend/notification_settings.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ email_notifications, push_notifications }),
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
});
