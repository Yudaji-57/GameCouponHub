let formElement = document.getElementById("couponForm"); // couponForm으로 변경
let resultMessage = document.getElementById("resultMessage");

formElement.addEventListener("submit", function (event) {
    event.preventDefault();

    // 입력 값 가져오기
    let game = document.getElementById("game").value.trim();
    let coupon = document.getElementById("coupon").value.trim();
    let reward = document.getElementById("reward").value.trim();
    let user_id = document.getElementById("user_id") ? document.getElementById("user_id").value.trim() : ''; // user_id도 가져오기

    // 유효성 검사
    if (game === "" || coupon === "" || reward === "") {
        resultMessage.textContent = "게임명, 쿠폰 코드, 보상 내용을 모두 입력해주세요.";
        resultMessage.style.color = "red";
        return;
    }

    // 데이터 전송 (AJAX)
    let formData = new FormData();
    formData.append("game", game);
    formData.append("coupon", coupon);
    formData.append("reward", reward);
    formData.append("user_id", user_id); // user_id도 추가

    fetch("/backend/routes/submit_coupon.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            resultMessage.textContent = "쿠폰이 성공적으로 제보되었습니다! 5초 후 이동합니다.";
            resultMessage.style.color = "green";

            // 5초 동안 카운트다운
            let countdown = 5;
            let countdownInterval = setInterval(function () {
                resultMessage.textContent = "쿠폰이 성공적으로 제보되었습니다! " + countdown + "초 후 이동합니다.";
                countdown--;

                // 카운트다운이 0일 때 리디렉션
                if (countdown < 0) {
                    clearInterval(countdownInterval); // 카운트다운 중지
                    window.location.href = data.redirect; // index.php로 리디렉션
                }
            }, 1000); // 1초마다 업데이트
        } else {
            resultMessage.textContent = "오류 발생: " + data.message;
            resultMessage.style.color = "red";
        }
    })
    .catch(error => {
        resultMessage.textContent = "서버 오류가 발생했습니다.";
        resultMessage.style.color = "red";
    });
});
