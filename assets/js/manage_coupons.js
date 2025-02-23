


document.addEventListener("DOMContentLoaded", function () {
    fetch('/backend/admin/coupons_data.php')
        .then(response => response.json())  // 응답을 JSON으로 받기
        .then(data => {
            const couponTableBody = document.querySelector("#couponTable tbody");
            const noCouponsMessage = document.getElementById("noCouponsMessage");

            // 쿠폰 데이터가 없으면 메시지 표시
            if (data.coupons.length === 0) {
                noCouponsMessage.style.display = 'block';
            } else {
                // 쿠폰 목록을 테이블에 추가
                data.coupons.forEach(coupon => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${coupon.game_name}</td>
                        <td>${coupon.coupon_code}</td>
                        <td>${coupon.reward_details}</td>
                        <td>${coupon.issue_date}</td>
                        <td>${coupon.expiration_date}</td>
                        <td>${coupon.created_at}</td>
                    `;
                    couponTableBody.appendChild(row);
                });
            }
        })
        .catch(error => {
            console.error('쿠폰 데이터를 불러오는 중 오류가 발생했습니다.', error);
        });
});
