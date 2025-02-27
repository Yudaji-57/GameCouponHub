document.addEventListener('DOMContentLoaded', function () {
    fetch('/backend/admin/dashboard_data.php', { cache: "no-store" })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                // 대시보드 통계 업데이트
                document.getElementById('totalUsers').innerText = `${data.data.totalUsers}명`;
                document.getElementById('totalReports').innerText = `${data.data.totalReports}개`;
                document.getElementById('totalCoupons').innerText = `${data.data.totalCoupons}개`;
                document.getElementById('todayReports').innerText = `${data.data.todayReports}개`;

                // 최근 쿠폰 제보 리스트
                const couponTableBody = document.querySelector('#couponTable tbody');
                couponTableBody.innerHTML = ""; // 기존 데이터 초기화

                if (data.data.recentReports.length > 0) {
                    data.data.recentReports.forEach(report => {
                        const row = document.createElement('tr');
                        const issueDate = report.issue_date ? new Date(report.issue_date).toLocaleDateString() : 'N/A';
                        const expirationDate = report.expiration_date ? new Date(report.expiration_date).toLocaleDateString() : 'N/A';
                        const approvalStatusLabel = report.approval_status_label || '알 수 없음';

                        row.innerHTML = `
                            <td>${report.user_id}</td>
                            <td>${report.game_name}</td>
                            <td>${report.coupon_code}</td>
                            <td>${report.reward}</td>
                            <td>${issueDate}</td>
                            <td>${expirationDate}</td>
                            <td>${approvalStatusLabel}</td>
                            <td>${report.created_at}</td>
                        `;
                        couponTableBody.appendChild(row);
                    });
                } else {
                    const row = document.createElement('tr');
                    row.innerHTML = `<td colspan="8" class="text-center">최근 제보된 쿠폰이 없습니다.</td>`;
                    couponTableBody.appendChild(row);
                }

                // 월별 쿠폰 제보 통계 차트
                const chartCanvas = document.getElementById('reportChart');
                if (chartCanvas.chartInstance) {
                    chartCanvas.chartInstance.destroy(); // 기존 차트 삭제
                }

                chartCanvas.chartInstance = new Chart(chartCanvas.getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: data.data.months, // ['2025-02']
                        datasets: [{
                            label: '월별 쿠폰 제보 수',
                            data: data.data.monthlyReports, // [8]
                            borderColor: 'rgba(75, 192, 192, 1)',
                            fill: false,
                        }],
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                        },
                        scales: {
                            x: { beginAtZero: true },
                            y: { beginAtZero: true },
                        },
                    },
                });
            } else {
                console.error("Error loading dashboard data:", data.message);
            }
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
});
