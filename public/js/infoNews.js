function showPopupEvent(element) {
    console.log("Fungsi showPopupEvent dipanggil"); // Log ini akan menunjukkan apakah fungsi dipanggil
    const description = element.getAttribute("data-description");
    const date = element.getAttribute("data-date");

    // Log untuk melihat nilai yang diambil
    console.log("Deskripsi:", description);
    console.log("Tanggal:", date);

    // Menampilkan data di dalam pop-up
    document.querySelector(".desk-event").textContent =
        description || "Deskripsi tidak tersedia";
    document.querySelector(".title-box-event").textContent =
        date || "Tanggal tidak tersedia";

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

// // Atur tampilan awal: hanya 4 box pertama yang terlihat
// document.addEventListener("DOMContentLoaded", function () {
//     const articles = document.querySelectorAll(".area-konten-berita");

//     articles.forEach((article) => {
//         const content = article.querySelector(".desk-berita");
//         const seeMore = article.querySelector(".see-more-news");

//         // Debugging: Log tinggi elemen
//         console.log('Scroll Height:', content.scrollHeight);
//         console.log('Offset Height:', content.offsetHeight);

//         // Periksa apakah teks terpotong
//         if (content.scrollHeight > content.offsetHeight) {
//             seeMore.style.display = "inline-block"; // Tampilkan tombol See More
//         }

//         // seeMore.addEventListener("click", function () {
//         //     if (content.style.display === "block") {
//         //         content.style.display = "-webkit-box";
//         //         content.style.overflow = "hidden";
//         //         content.style.maxHeight = "calc(1.5em * 4)";
//         //         this.textContent = "See More";
//         //     } else {
//         //         content.style.display = "block";
//         //         content.style.overflow = "visible";
//         //         content.style.maxHeight = "none";
//         //         this.textContent = "See Less";
//         //     }
//         // });
//     });
// });

// pop up announcer
function showPopupArtis(element) {
    const popupArtis = document.getElementById("popupArtis");
    popupArtis.classList.add("muncul"); // Tambahkan kelas show untuk animasi muncul
    popupArtis.style.display = "flex"; // Tampilkan pop-up

    const judulB = element.getAttribute("data-judul-berita");
    const deskB = element.getAttribute("data-desk-berita");

 // Menampilkan data di dalam pop-up
    document.querySelector(".popUp-judul-berita").textContent =
        judulB || "Deskripsi tidak tersedia";
    document.querySelector(".popUp-desk-berita").textContent =
        deskB || "Tanggal tidak tersedia";

    // Menampilkan pop-up
    document.getElementById("popupArtis").style.display = "flex";
}

function closePopupArtis() {
    const popupArtis = document.getElementById("popupArtis");
    popupArtis.classList.remove("muncul"); // Hilangkan kelas show
    popupArtis.classList.add("tutup"); // Tambahkan kelas hide untuk animasi keluar

    popupArtis.style.display = "none";
    popupArtis.classList.remove("tutup"); // Reset kelas hide setelah pop-up hilang
}

function closePopupOutsideArtis(event) {
    if (event.target.id === "popupArtis") {
        closePopupArtis();
    }
}
// ----------------

