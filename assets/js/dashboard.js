fetch('/backend/admin/dashboard_data.php')
    .then(response => response.json())  // 응답을 JSON으로 받기
    .then(data => {
        console.log(data);  // 응답 내용 로그

        const couponTableBody = document.querySelector("#couponTable tbody");
        const noCouponsMessage = document.getElementById("noCouponsMessage");

        // 테이블 초기화 (중복 방지)
        couponTableBody.innerHTML = '';

        // 쿠폰 제보 데이터가 없으면 메시지 표시
        if (data.reports.length === 0) {
            noCouponsMessage.style.display = 'block';
        } else {
            // 쿠폰 제보가 있으면 테이블에 추가
            data.reports.forEach(report => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${report.user_id}</td>
                    <td>${report.coupon_code}</td>
                    <td>${report.game_name}</td>
                    <td>${report.reward_details}</td>
                    <td>${report.created_at}</td>  <!-- 제보 날짜 추가 -->
                `;
                couponTableBody.appendChild(row);
            });
        }
    })
    .catch(error => {
        console.error('데이터 로드 실패:', error);
    });
