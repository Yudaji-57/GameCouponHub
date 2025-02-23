// 백엔드에서 쿠폰 목록을 불러오는 JavaScript 코드
fetch('/backend/admin/coupons_data.php')
    .then(response => response.json())
    .then(data => {
        const couponTableBody = document.querySelector("#couponTable tbody");
        const noCouponsMessage = document.getElementById("noCouponsMessage");

        if (data.coupons.length === 0) {
            // 쿠폰이 없으면 메시지 표시
            noCouponsMessage.style.display = 'block';
        } else {
            // 쿠폰이 있으면 테이블에 표시
            data.coupons.forEach(coupon => {
                const row = document.createElement("tr");
                row.innerHTML = `
                            <td>${coupon.coupon_code}</td>
                            <td>${coupon.game_name}</td>
                            <td>${coupon.reward_details}</td>
                        `;
                couponTableBody.appendChild(row);
            });
        }
    })
    .catch(error => {
        console.error('데이터 로드 실패:', error);
    });