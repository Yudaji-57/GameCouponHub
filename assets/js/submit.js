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
        let reward = document.getElementById("reward").value.trim();
        let resultMessage = document.getElementById("resultMessage");

        // user_id 추가 (예: 로그인된 사용자의 ID)
        let user_id = "example_user_id"; // 로그인된 사용자 ID를 동적으로 설정해야 합니다.

        // 입력값 유효성 검사
        if (game === "" || coupon === "" || reward === "" || user_id === "") {
            resultMessage.textContent = "게임명, 쿠폰 코드, 보상 내용, 사용자 ID를 모두 입력해주세요.";
            resultMessage.style.color = "red";
            return;
        }

        // 데이터 전송 (AJAX)
        let formData = new FormData();
        formData.append("game", game);
        formData.append("coupon", coupon);
        formData.append("reward", reward);
        formData.append("user_id", user_id); // user_id 추가

        fetch("/backend/routes/submit_coupon.php", { // 백엔드 경로 수정
            method: "POST",
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("서버 오류: " + response.statusText);
            }
            return response.text(); // 응답을 텍스트로 받아오기
        })
        .then(text => {
            try {
                const data = JSON.parse(text); // 텍스트를 JSON으로 파싱
                if (data.success) {
                    resultMessage.textContent = "쿠폰이 성공적으로 제보되었습니다!";
                    resultMessage.style.color = "green";
                    formElement.reset(); // 폼 리셋
                } else {
                    resultMessage.textContent = "오류 발생: " + data.message;
                    resultMessage.style.color = "red";
                }
            } catch (error) {
                console.error("응답을 JSON으로 파싱할 수 없습니다:", error);
                resultMessage.textContent = "서버 응답 오류: JSON 파싱 실패";
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
