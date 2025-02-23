document.addEventListener('DOMContentLoaded', function() {
    fetch('/backend/admin/dashboard_data.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                // 대시보드 통계
                document.getElementById('totalUsers').innerText = `${data.totalUsers}명`;
                document.getElementById('totalReports').innerText = `${data.totalReports}개`;
                document.getElementById('totalCoupons').innerText = `${data.totalCoupons}개`;
                document.getElementById('todayReports').innerText = `${data.todayReports}개`;
                document.getElementById('newCoupons').innerText = `${data.newCoupons}개`; // 신규 쿠폰 수

                // 총 쿠폰 수 + 제보 수 합산
                const totalCouponsAndReports = data.totalCoupons + data.totalReports;
                document.getElementById('totalCouponsAndReports').innerText = `${totalCouponsAndReports}개`;

                // 최근 쿠폰 제보 리스트
                const couponTableBody = document.querySelector('#couponTable tbody');
                data.recentReports.forEach(report => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${report.user_id}</td>
                        <td>${report.game_name}</td>
                        <td>${report.coupon_code}</td>
                        <td>${report.reward}</td>
                        <td>${report.created_at}</td>
                    `;
                    couponTableBody.appendChild(row);
                });

                // 월별 쿠폰 제보 통계 차트
                const ctx = document.getElementById('reportChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: data.months,
                        datasets: [{
                            label: '월별 쿠폰 제보 수',
                            data: data.monthlyReports,
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
                            x: {
                                beginAtZero: true,
                            },
                            y: {
                                beginAtZero: true,
                            },
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
