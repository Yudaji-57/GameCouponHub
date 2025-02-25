// 제보 목록을 불러오는 코드
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

            // 행 클릭 시 쿠폰 등록 폼에 데이터 자동 삽입
            row.addEventListener('click', () => {
                // 쿠폰 등록 폼의 각 필드에 데이터 자동 삽입
                document.querySelector("#game_name").value = report.game_name;
                document.querySelector("#coupon_code").value = report.coupon_code;
                document.querySelector("#reward_details").value = report.reward_details;
                document.querySelector("#issue_date").value = report.issue_date;
                document.querySelector("#expiration_date").value = report.expiration_date; // 만료일 추가
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
                        // 쿠폰 등록과 제보 삭제가 성공적으로 이루어진 후
                        if (responseData.success) {
                            alert(responseData.message);

                            // 제보 항목 삭제 후 화면에서 제거
                            row.remove();

                            // 폼 초기화
                            couponForm.reset();
                        } else {
                            alert("처리 중 오류가 발생했습니다.");
                        }
                    })
                    .catch(error => {
                        console.error('등록 및 삭제 실패:', error);
                    });
                });
            });
        });
    })
    .catch(error => {
        console.error('데이터 로드 실패:', error);
    });
