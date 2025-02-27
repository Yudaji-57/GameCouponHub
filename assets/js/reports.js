// 제보 목록을 불러오는 코드
fetch('/backend/admin/reports_data.php')
    .then(response => response.json())
    .then(data => {
        const reportTableBody = document.querySelector("#reportTable tbody");
        data.reports.forEach(report => {
            const statusText = getStatusText(report.approval_status);  // 상태 텍스트 변환

            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${report.user_id}</td>
                <td>${report.game_name}</td>
                <td>${report.coupon_code}</td>
                <td>${report.reward_details}</td>
                <td>${report.issue_date}</td>
                <td>${report.expiration_date}</td>
                <td>${report.created_at}</td>
                <td>${statusText}</td>  <!-- 상태 텍스트 표시 -->
                <td>
                    <button class="btn btn-success approve-btn" data-report-index="${report.index}" ${report.approval_status === 1 ? 'disabled' : ''}>승인</button>
                    <button class="btn btn-danger reject-btn" data-report-index="${report.index}" ${report.approval_status === 2 ? 'disabled' : ''}>거절</button>
                </td>
            `;
            reportTableBody.appendChild(row);

            // 승인 버튼 클릭 시 처리
            row.querySelector(".approve-btn").addEventListener('click', () => {
                updateReportApprovalStatus(report.index, 1); // 승인 처리
            });

            // 거절 버튼 클릭 시 처리
            row.querySelector(".reject-btn").addEventListener('click', () => {
                updateReportApprovalStatus(report.index, 2); // 거절 처리
            });

            // 행 클릭 시 쿠폰 등록 폼에 데이터 자동 삽입
            row.addEventListener('click', () => {
                // 쿠폰 등록 폼의 각 필드에 데이터 자동 삽입
                document.querySelector("#game_name").value = report.game_name;
                document.querySelector("#coupon_code").value = report.coupon_code;
                document.querySelector("#reward_details").value = report.reward_details;

                // issue_date와 expiration_date 값이 undefined인 경우 기본값 설정
                document.querySelector("#issue_date").value = report.issue_date ? report.issue_date : '';
                document.querySelector("#expiration_date").value = report.expiration_date ? report.expiration_date : ''; 

                document.querySelector("#coupon_type").value = report.coupon_type;

                // 쿠폰 등록 버튼 클릭 시 처리
                const couponForm = document.querySelector("#couponForm");
                couponForm.addEventListener('submit', function(e) {
                    e.preventDefault(); // 폼 제출 기본 동작을 막음

                    // 폼 데이터
                    const formData = new FormData(couponForm);
                    // 제보 ID 추가
                    formData.append('report_id', report.index);

                    // 폼 데이터 서버로 전송
                    fetch('/backend/admin/coupon_add_and_delete_report.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(responseData => {
                        // 쿠폰 등록 성공 후
                        if (responseData.success) {
                            alert(responseData.message);
                            // 폼 초기화
                            couponForm.reset();
                        } else {
                            alert("처리 중 오류가 발생했습니다.");
                        }
                    })
                    .catch(error => {
                        console.error('등록 실패:', error);
                    });
                });
            });
        });
    })
    .catch(error => {
        console.error('데이터 로드 실패:', error);
    });

// 제보 승인/거절 상태 업데이트 함수
function updateReportApprovalStatus(index, approvalStatus) {
    console.log("Report ID:", index);  // index 값 확인
    console.log("Approval Status:", approvalStatus);

    fetch('/backend/admin/update_report_status.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            index: index,
            approval_status: approvalStatus
        })
    })
    .then(response => response.json())
    .then(responseData => {
        console.log(responseData);  // 서버 응답 확인
        if (responseData.status === "success") {
            alert(responseData.message);
            // 성공적으로 상태가 업데이트되면 버튼 비활성화
            const reportRow = document.querySelector(`button[data-report-index='${index}']`).closest('tr');
            const approveBtn = reportRow.querySelector('.approve-btn');
            const rejectBtn = reportRow.querySelector('.reject-btn');

            // 상태에 따라 버튼 비활성화
            if (approvalStatus === 1) {
                approveBtn.disabled = true;
            } else if (approvalStatus === 2) {
                rejectBtn.disabled = true;
            }
        } else {
            alert("상태 업데이트 중 오류가 발생했습니다.");
        }
    })
    .catch(error => {
        console.error('상태 업데이트 실패:', error);
    });
}

// approval_status 값을 텍스트로 변환하는 함수
function getStatusText(status) {
    // 숫자가 아니라면 숫자로 변환
    const statusInt = parseInt(status, 10);  // string을 number로 변환
    console.log("approval_status (converted):", statusInt); // 디버깅: 변환된 상태값 확인

    switch(statusInt) {
        case 0:
            return "대기";
        case 1:
            return "승인";
        case 2:
            return "거절";
        default:
            return "알 수 없음";
    }
}
