// 백엔드에서 제보 목록을 불러오는 JavaScript 코드
fetch('/backend/admin/reports_data.php')
    .then(response => response.json())
    .then(data => {
        const reportTableBody = document.querySelector("#reportTable tbody");
        data.reports.forEach(report => {
            const row = document.createElement("tr");
            row.innerHTML = `
                        <td>${report.user_id}</td>
                        <td>${report.game_name}</td>
                        <td>${report.coupon_code}</td>
                        <td>${report.reward_details}</td>
                        <td>${report.created_at}</td>
                    `;
            reportTableBody.appendChild(row);
        });
    })
    .catch(error => {
        console.error('데이터 로드 실패:', error);
    });