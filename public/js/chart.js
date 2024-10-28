// tab chart ardan
document.addEventListener("DOMContentLoaded", () => {
    const tabs = document.querySelectorAll(".tab-chart");
    const tables = document.querySelectorAll(".chart");

    // Menambahkan event listener ke setiap tab
    tabs.forEach((tab) => {
        tab.addEventListener("click", () => {
            // Menghapus kelas aktif dari semua tab
            tabs.forEach((t) => t.classList.remove("active"));
            // Menambahkan kelas aktif ke tab yang dipilih
            tab.classList.add("active");

            // Menyembunyikan semua tabel
            tables.forEach((table) => table.classList.add("hidden"));

            // Menampilkan tabel yang sesuai dengan tab yang dipilih
            const selectedTab = tab.getAttribute("data-tab");
            // console.log('Selected Tab ID:', selectedTab); // Log ID yang dipilih
            const selectedTable = document.getElementById(selectedTab);
            
            // Debugging log untuk memeriksa
            // console.log('Selected Table:', selectedTable);

            if (selectedTable) {
                selectedTable.classList.remove("hidden");
            } else {
                console.warn(`Table with ID '${selectedTab}' not found.`);
            }
        });
    });

    // Secara default, tampilkan tabel pertama
    const defaultTable = document.querySelector(".chart:not(.hidden)"); // Ambil tabel yang tidak tersembunyi
    if (defaultTable) {
        defaultTable.classList.remove('hidden');
    }
});

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
 