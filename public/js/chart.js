const rows = document.querySelectorAll("#chart-body tr");
const button = document.getElementById("toggle-button");
let isExpanded = false;
let defaultRows = 5; // Jumlah baris yang ditampilkan secara default

function toggleTable() {
    if (isExpanded) {
        // Tampilkan hanya 5 data
        for (let i = defaultRows; i < rows.length; i++) {
            rows[i].style.display = "none";
        }
        button.textContent = "See More";
    } else {
        // Tampilkan semua data
        rows.forEach(row => {
            row.style.display = "table-row";
        });
        button.textContent = "Show Less";
    }
    isExpanded = !isExpanded;
}

// Saat pertama kali, tampilkan hanya 5 baris data
document.addEventListener("DOMContentLoaded", function () {
    for (let i = defaultRows; i < rows.length; i++) {
        rows[i].style.display = "none";
    }
});
 