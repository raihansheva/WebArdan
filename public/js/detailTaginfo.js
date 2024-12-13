function showPopupEvent(element) {
    console.log("Fungsi showPopupEvent dipanggil"); // Log ini akan menunjukkan apakah fungsi dipanggil
    const description = element.getAttribute("data-description");
    const date = element.getAttribute("data-date");
    const slug = element.getAttribute("data-slug"); // Ambil slug dari data attribute

    // Log untuk melihat nilai yang diambil
    console.log("Deskripsi:", description);
    console.log("Tanggal:", date);
    console.log("Slug:", slug);

    // Menampilkan data di dalam pop-up
    document.querySelector(".desk-event").textContent =
        description || "Deskripsi tidak tersedia";
    document.querySelector(".title-box-event").textContent =
        date || "Tanggal tidak tersedia";

    // Set href pada link "See detail"
    const detailLink = document.querySelector(".detail-link");
    detailLink.href = `/detail-event/${slug}`; // Update URL sesuai dengan slug

    // Menampilkan pop-up
    document.getElementById("popupEvent").style.display = "flex";
}

function closePopupEvent() {
    const popupEvent = document.getElementById("popupEvent");
    popupEvent.classList.remove("muncul"); // Hilangkan kelas show
    popupEvent.classList.add("tutup"); // Tambahkan kelas hide untuk animasi keluar
    popupEvent.style.display = "none";
    popupEvent.classList.remove("tutup"); // Reset kelas hide setelah pop-up hilang
}

function closePopupOutsideEvent(event) {
    if (event.target.id === "popupEvent") {
        closePopupEvent();
    }
}


// Inisialisasi jumlah box yang terlihat
let currentVisibleBoxes = 3;
const boxes = document.querySelectorAll(".box-info");
const toggleButton = document.querySelector(".title-bottom");

function toggleBoxes() {
    if (currentVisibleBoxes < boxes.length) {
        // "See More": Tampilkan 2 box lagi
        currentVisibleBoxes += 2;
    } else {
        // "See Less": Kembali ke 4 box pertama
        currentVisibleBoxes = 4;
    }

    // Tampilkan atau sembunyikan box sesuai jumlah yang terlihat
    boxes.forEach((box, index) => {
        box.classList.toggle("visible", index < currentVisibleBoxes);
    });

    // Ubah teks tombol berdasarkan status tampilan
    toggleButton.textContent = currentVisibleBoxes >= boxes.length ? "See Less" : "See More";
}

// Atur tampilan awal: hanya 4 box pertama yang terlihat
window.addEventListener("DOMContentLoaded", () => {
    boxes.forEach((box, index) => {
        box.classList.toggle("visible", index < 4); // Hanya tampilkan 4 box pertama
    });
    toggleButton.textContent = "See More"; // Atur teks tombol awal
});
