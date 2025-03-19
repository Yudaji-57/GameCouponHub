document.addEventListener("DOMContentLoaded", function () {
    loadUserData();
    loadUserCoupons();
    loadReportCount();
    loadReportHistory();
    loadUserPoints();
});

// 사용자 정보 및 포인트 불러오기
function loadUserData() {
    fetch("../backend/api/get_user_data.php")
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }

            document.getElementById("nickname").textContent = data.nickname;
            document.getElementById("availablePoints").textContent = data.available_points + "P";
            document.getElementById("expiringPoints").textContent = data.expiring_points + "P";
        })
        .catch(error => console.error("사용자 데이터 불러오기 오류:", error));
}

// 사용자가 복사한 쿠폰 목록 불러오기
function loadUserCoupons() {
    fetch("../backend/api/get_user_coupons.php")
        .then(response => response.json())
        .then(coupons => {
            const couponList = document.getElementById("couponList");
            couponList.innerHTML = "";

            if (coupons.error) {
                couponList.innerHTML = "<li>쿠폰 정보를 불러올 수 없습니다.</li>";
                return;
            }

            if (coupons.length === 0) {
                couponList.innerHTML = "<li>복사한 쿠폰이 없습니다.</li>";
                return;
            }

            coupons.forEach(coupon => {
                const li = document.createElement("li");
                li.textContent = `게임: ${coupon.game_name} / 쿠폰: ${coupon.coupon_code} / 만료일: ${coupon.expiry_date}`;
                couponList.appendChild(li);
            });
        })
        .catch(error => console.error("쿠폰 데이터 불러오기 오류:", error));
}

// 사용자가 제보한 쿠폰 개수 불러오기
function loadReportCount() {
    fetch("../backend/api/get_report_count.php")
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }
            document.getElementById("reportCount").textContent = data.report_count;
        })
        .catch(error => console.error("제보 개수 불러오기 오류:", error));
}

// 사용자가 제보한 쿠폰 내역 불러오기
function loadReportHistory() {
    fetch("../backend/api/get_report_history.php")
        .then(response => response.json())
        .then(reports => {
            const reportList = document.getElementById("reportList");
            reportList.innerHTML = "";

            if (reports.error) {
                reportList.innerHTML = "<li>쿠폰 제보 정보를 불러올 수 없습니다.</li>";
                return;
            }

            if (reports.length === 0) {
                document.getElementById("noReports").style.display = "block";
                return;
            }

            reports.forEach(report => {
                const li = document.createElement("li");
                li.className = "list-group-item";

                let statusText = "";
                let badgeClass = "";

                switch (report.approval_status) {
                    case "0":
                        statusText = "대기 중";
                        badgeClass = "bg-warning text-dark";
                        break;
                    case "1":
                        statusText = "승인 됨";
                        badgeClass = "bg-success";
                        break;
                    case "2":
                        statusText = "거부 됨";
                        badgeClass = "bg-danger";
                        break;
                }

                let expirationStatus = new Date(report.expiration_date) < new Date() ? "만료됨" : "유효";

                li.innerHTML = `
                    <strong>${report.game_name}</strong>
                    <p>${report.reward_details}</p>
                    <span class="badge ${badgeClass}">${statusText}</span>
                    <span class="badge bg-secondary">발급일: ${report.issue_date}</span>
                    <span class="badge bg-info">만료일: ${report.expiration_date} (${expirationStatus})</span>
                `;

                reportList.appendChild(li);
            });
        })
        .catch(error => console.error("제보 내역 불러오기 오류:", error));
}

// 페이지 로드 후 사용자 포인트 정보를 불러오는 함수
function loadUserPoints() {
    fetch("../backend/api/get_user_data.php")
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }

            document.getElementById("availablePoints").textContent = data.available_points + "P";
            document.getElementById("expiringPoints").textContent = data.expiring_points + "P";
        })
        .catch(error => console.error("포인트 정보 불러오기 오류:", error));
}