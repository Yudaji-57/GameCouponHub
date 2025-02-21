document.addEventListener('DOMContentLoaded', function() {
    console.log("쿠폰 제보 페이지 JS 로드됨");

    let formElement = document.getElementById("couponForm");
    if (!formElement) {
        console.error("Error: 'couponForm' 요소를 찾을 수 없습니다.");
        return;
    }

    formElement.addEventListener("submit", function(event) {
        event.preventDefault(); // 기본 제출 방지

        let game = document.getElementById("game").value.trim();
        let coupon = document.getElementById("coupon").value.trim();
        let resultMessage = document.getElementById("resultMessage");

        // 입력값 유효성 검사
        if (game === "" || coupon === "") {
            resultMessage.textContent = "게임명과 쿠폰 코드를 입력해주세요.";
            resultMessage.style.color = "red";
            return;
        }

        // 데이터 전송 (AJAX)
        let formData = new FormData();
        formData.append("game", game);
        formData.append("coupon", coupon);

        fetch("/backend/routes/submit.php", { // 백엔드 경로 수정
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                resultMessage.textContent = "쿠폰이 성공적으로 제보되었습니다!";
                resultMessage.style.color = "green";
            } else {
                resultMessage.textContent = "오류 발생: " + data.message;
                resultMessage.style.color = "red";
            }
        })
        .catch(error => {
            console.error("Error:", error);
            resultMessage.textContent = "서버 오류가 발생했습니다.";
            resultMessage.style.color = "red";
        });
    });
});
