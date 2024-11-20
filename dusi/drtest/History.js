document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("search");
    const tableRows = document.querySelectorAll("#history-container table tbody tr");

    searchInput.setAttribute("placeholder", "ค้นหา..."); // เพิ่ม placeholder

    searchInput.addEventListener("keyup", function () {
        const searchValue = this.value.toLowerCase().trim(); // ตัดช่องว่าง
        tableRows.forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(searchValue) ? "" : "none";
        });
    });
});

document.getElementById("backButton").addEventListener("click", function () {
    window.history.back(); // พาผู้ใช้กลับไปหน้าก่อนหน้า
});

