function getColorBySeverity(severity) {
    if (severity >= 0 && severity <= 2) return "green";
    if (severity >= 3 && severity <= 5) return "yellow";
    if (severity >= 6 && severity <= 8) return "orange";
    if (severity >= 9 && severity <= 10) return "red";
    return "gray";
}

function getSeverityLevelText(severity) {
    if (severity >= 0 && severity <= 2) return "เล็กน้อย";
    if (severity >= 3 && severity <= 5) return "ปานกลาง";
    if (severity >= 6 && severity <= 8) return "รุนแรง";
    if (severity >= 9 && severity <= 10) return "รุนแรงมาก";
    return "ไม่ระบุ";
}

function printForm() {
    window.print();
    showCountdownPopup();
}

function showCountdownPopup() {
    const popupContainer = document.createElement('div');
    popupContainer.className = 'popup-container';
    const popup = document.createElement('div');
    popup.className = 'popup';
    popupContainer.appendChild(popup);
    document.body.appendChild(popupContainer);

    let countdown = 10;
    const countdownInterval = setInterval(() => {
        popup.innerHTML = `<h3>กำลังกลับไปหน้าแรกใน ${countdown} วินาที</h3>`;
        countdown--;
        if (countdown < 0) {
            clearInterval(countdownInterval);
            document.body.removeChild(popupContainer);
            window.location.href = '../login.html';
        }
    }, 1000);
}