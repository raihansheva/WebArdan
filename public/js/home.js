// caraousel program
const tombolKiri = document.querySelector(".tombol-kiri");
const tombolKanan = document.querySelector(".tombol-kanan");
const areaContentBox = document.querySelector(".area-content-box-program");

const getScrollAmount = () => {
    if (window.matchMedia("(max-width: 480px)").matches) {
        return 360;
    } else if (window.matchMedia("(max-width: 768px)").matches) {
        return 350;
    } else if (window.matchMedia("(max-width: 1024px)").matches) {
        return 310;
    } else {
        return 330;
    }
};

tombolKiri.addEventListener("click", () => {
    if (areaContentBox.scrollLeft === 0) {
        areaContentBox.scrollLeft = areaContentBox.scrollWidth; // Kembali ke akhir
    } else {
        areaContentBox.scrollBy({
            left: -getScrollAmount(),
            behavior: "smooth",
        });
    }
});

tombolKanan.addEventListener("click", () => {
    if (
        areaContentBox.scrollLeft + areaContentBox.clientWidth >=
        areaContentBox.scrollWidth
    ) {
        areaContentBox.scrollLeft = 0; // Kembali ke awal
    } else {
        areaContentBox.scrollBy({
            left: getScrollAmount(),
            behavior: "smooth",
        });
    }
});

// ---------------------------------------

// carousel announcer
const tombolKiriA = document.querySelector(".tombol-kiri-announcer");
const tombolKananA = document.querySelector(".tombol-kanan-announcer");
const areaContentBoxA = document.querySelector(".area-content-box-announcer");

const getScrollAmountA = () => {
    if (window.matchMedia("(max-width: 480px)").matches) {
        return 358;
    } else if (window.matchMedia("(max-width: 768px)").matches) {
        return 234;
    } else if (window.matchMedia("(max-width: 1024px)").matches) {
        return 240;
    } else {
        return 330;
    }
};

tombolKiriA.addEventListener("click", () => {
    areaContentBoxA.scrollBy({
        left: -getScrollAmountA(),
        behavior: "smooth",
    });
});

tombolKananA.addEventListener("click", () => {
    areaContentBoxA.scrollBy({
        left: getScrollAmountA(),
        behavior: "smooth",
    });
});
// ----------------------------------------

// card-streaming
const cardA = document.querySelector(".card-A");
const cardB = document.querySelector(".card-B");
const tontonSiaranBtnA = document.querySelector(".card-A .view");
const tontonSiaranBtnB = document.querySelector(".card-B .view-B");

cardA.style.display = "block";
cardA.classList.add("show");

function showCard(card) {
    card.style.display = "block";
    setTimeout(() => {
        card.classList.add("show");
        card.classList.remove("hide");
    }, 10);
}

function hideCard(card) {
    card.classList.remove("show");
    card.classList.add("hide");
    setTimeout(() => {
        card.style.display = "none";
    }, 500);
}

tontonSiaranBtnA.addEventListener("click", function () {
    hideCard(cardA);
    pauseStreaming();
    setTimeout(() => {
        showCard(cardB);
    }, 500);
});

tontonSiaranBtnB.addEventListener("click", function () {
    hideCard(cardB);
    // playStreaming();
    setTimeout(() => {
        showCard(cardA);
    }, 500);
});

// youtube-player
var tag = document.createElement("script");
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName("script")[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

// var player;
// var playlistID = document.getElementById("player").getAttribute("data-pl");

// function onYouTubeIframeAPIReady() {
//     player = new YT.Player("player", {
//         height: "360",
//         width: "640",
//         playerVars: {
//             listType: "playlist",
//             list: playlistID,
//         },
//         events: {
//             onReady: onPlayerReady,
//         },
//     });
// }

// function onPlayerReady(event) {
//     event.target.playVideo();
// }

function showPopup(element) {
    document.getElementById("popup").style.display = "flex"; // Tampilkan popup

    const title = element.getAttribute("data-title");
    const description = element.getAttribute("data-description");
    const time = element.getAttribute("data-time");
    const slug = element.getAttribute("data-slugP");
    const deskP = element.getAttribute("data-deskP");

    // Log data untuk debug
    console.log("Title:", title); // Pastikan ini mencetak judul
    console.log("Description:", description); // Pastikan ini mencetak deskripsi
    console.log("Time:", time); // Pastikan ini mencetak waktu
    console.log("Time:", deskP); // Pastikan ini mencetak waktu

    document.querySelector(".title-box-program").textContent =
        title || "Deskripsi tidak tersedia";
    document.querySelector(".desk-program").textContent =
        description || "Deskripsi tidak tersedia";
    document.querySelector(".jam-program").textContent =
        time || "Deskripsi tidak tersedia";

    const detailLink = document.querySelector(".detail-link-program");

    if (deskP) {
        // Tampilkan detailLink jika deskShort ada
        detailLink.style.display = "block";
        detailLink.href = `/detail-program/${slug}`; // Update URL sesuai dengan slug
    } else {
        // Sembunyikan detailLink jika deskShort tidak ada
        detailLink.style.display = "none";
    }
}

function closePopup() {
    const popup = document.getElementById("popup");
    popup.classList.remove("muncul"); // Hilangkan kelas show
    popup.classList.add("tutup"); // Tambahkan kelas hide untuk animasi keluar

    // Sembunyikan pop-up setelah animasi selesai
    popup.style.display = "none";
    popup.classList.remove("tutup"); // Reset kelas hide setelah pop-up hilang
}

function closePopupOutside(event) {
    if (event.target.id === "popup") {
        closePopup();
    }
}

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

// pop up feed
function showPopupFeed(element) {
    const popupFeed = document.getElementById("popupFeed");
    popupFeed.classList.add("muncul");
    popupFeed.style.display = "flex";

    // const description = element.getAttribute("data-description");
    // const date = element.getAttribute("data-date");

    // // Log untuk melihat nilai yang diambil
    // console.log("Deskripsi:", description);
    // console.log("Tanggal:", date);

    // // Menampilkan data di dalam pop-up
    // document.querySelector(".desk-event").textContent =
    //     description || "Deskripsi tidak tersedia";
    // document.querySelector(".title-box-event").textContent =
    //     date || "Tanggal tidak tersedia";

    // Menampilkan pop-up
    document.getElementById("popupFeed").style.display = "flex";
}

function closePopupFeed() {
    const popupFeed = document.getElementById("popupFeed");
    popupFeed.classList.remove("muncul"); // Hilangkan kelas show
    popupFeed.classList.add("tutup"); // Tambahkan kelas hide untuk animasi keluar

    popupFeed.style.display = "none";
    popupFeed.classList.remove("tutup"); // Reset kelas hide setelah pop-up hilang
}

function closePopupOutsideFeed(event) {
    if (event.target.id === "popupFeed") {
        closePopupFeed();
    }
}
// -----------

// pop up announcer
function showPopupAnnouncer(element) {
    const popupAnnouncer = document.getElementById("popupAnnouncer");
    popupAnnouncer.classList.add("muncul");
    popupAnnouncer.style.display = "flex";

    // Ambil atribut data dari elemen yang diklik
    const imageA = element.getAttribute("data-image");
    const name = element.getAttribute("data-name");
    const bio = element.getAttribute("data-bio");
    const ig = element.getAttribute("data-ig");
    const tiktok = element.getAttribute("data-tiktok");
    const twitter = element.getAttribute("data-twitter");

    // Setel gambar
    document.querySelector(".popUp-image-announcer").src =
        imageA || "./default-image.jpg";

    // Setel nama dan bio
    document.querySelector(".name-announcer").textContent =
        name || "Nama tidak tersedia";
    document.querySelector(".bio-announcer").textContent =
        bio || "Bio tidak tersedia";

    // Tangani link sosial media
    const igLink = document.querySelector(
        ".area-profile-announcer a[data-social='instagram']"
    );
    const tiktokLink = document.querySelector(
        ".area-profile-announcer a[data-social='tiktok']"
    );
    const twitterLink = document.querySelector(
        ".area-profile-announcer a[data-social='twitter']"
    );

    // Instagram
    if (ig) {
        igLink.style.display = "inline-block";
        igLink.href = ig;
    } else {
        igLink.style.display = "none";
    }

    // TikTok
    if (tiktok) {
        tiktokLink.style.display = "inline-block";
        tiktokLink.href = tiktok;
    } else {
        tiktokLink.style.display = "none";
    }

    // Twitter
    if (twitter) {
        twitterLink.style.display = "inline-block";
        twitterLink.href = twitter;
    } else {
        twitterLink.style.display = "none";
    }

    // Tampilkan pop-up
    popupAnnouncer.style.display = "flex";
}

function closePopupAnnouncer() {
    const popupAnnouncer = document.getElementById("popupAnnouncer");
    popupAnnouncer.classList.remove("muncul"); // Hilangkan kelas show
    popupAnnouncer.classList.add("tutup"); // Tambahkan kelas hide untuk animasi keluar

    popupAnnouncer.style.display = "none";
    popupAnnouncer.classList.remove("tutup"); // Reset kelas hide setelah pop-up hilang
}

function closePopupOutsideAnnouncer(event) {
    if (event.target.id === "popupAnnouncer") {
        closePopupAnnouncer();
    }
}
// ----------------

// pop up announcer
function showPopupArtis(element) {
    const popupArtis = document.getElementById("popupArtis");
    popupArtis.classList.add("muncul"); // Tambahkan kelas show untuk animasi muncul
    popupArtis.style.display = "flex"; // Tampilkan pop-up

    // const description = element.getAttribute("data-description");
    // const date = element.getAttribute("data-date");

    // // Log untuk melihat nilai yang diambil
    // console.log("Deskripsi:", description);
    // console.log("Tanggal:", date);

    // // Menampilkan data di dalam pop-up
    // document.querySelector(".desk-event").textContent =
    //     description || "Deskripsi tidak tersedia";
    // document.querySelector(".title-box-event").textContent =
    //     date || "Tanggal tidak tersedia";

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
        defaultTable.classList.remove("hidden");
    }
});

var player;

function showPopupYT(videoId) {
    document.getElementById("popup-player").style.display = "flex";

    if (!player) {
        player = new YT.Player("player-yt", {
            height: "360",
            width: "640",
            videoId: videoId,
            events: {
                onReady: function (event) {
                    event.target.playVideo();
                },
            },
        });
    } else {
        player.loadVideoById(videoId);
        player.playVideo();
    }
}

function hidePopup() {
    document.getElementById("popup-player").style.display = "none";
    player.stopVideo(); // Hentikan video saat popup ditutup
}

// Load YouTube IFrame API
var tag = document.createElement("script");
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName("script")[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

function onYouTubeIframeAPIReady() {
    // IFrame API siap
}
function onPlayerReady(event) {
    event.target.playVideo();
}

function hidePopup() {
    document.getElementById("popup-player").style.display = "none";
    if (player) {
        player.stopVideo();
    }
}

// Menambahkan event listener untuk klik di luar player
document
    .getElementById("popup-player")
    .addEventListener("click", function (event) {
        var popupContent = document.querySelector(".popup-content");

        // Jika user klik di luar area .popup-content, tutup popup
        if (!popupContent.contains(event.target)) {
            hidePopup();
        }
    });

// document.addEventListener("DOMContentLoaded", () => {
const tabS = document.querySelectorAll(".schedule");
const scheduleContent = document.querySelectorAll(".box-schedule");

// Array untuk mapping index hari ke nama hari dalam bahasa Indonesia
const dayMapping = [
    "minggu",
    "senin",
    "selasa",
    "rabu",
    "kamis",
    "jumat",
    "sabtu",
];

// Fungsi untuk menampilkan program sesuai dengan hari yang dipilih
function showScheduleForDay(day) {
    // Menyembunyikan semua konten schedule
    scheduleContent.forEach((content) => content.classList.add("hidden"));

    // Menampilkan semua konten yang sesuai dengan hari yang dipilih
    const selectedSchedules = document.querySelectorAll(
        `.box-schedule[data-day="${day}"]`
    );

    if (selectedSchedules.length > 0) {
        selectedSchedules.forEach((schedule) =>
            schedule.classList.remove("hidden")
        );
    } else {
        console.warn(`No schedules found for day '${day}'.`);
    }

    // Menandai tab hari sebagai aktif dan menghapus kelas aktif dari tab lainnya
    tabS.forEach((t) => t.classList.remove("active"));
    const selectedTab = document.querySelector(`.schedule[data-day="${day}"]`);
    if (selectedTab) {
        selectedTab.classList.add("active");
    }
}

// Event listener untuk setiap tab hari
tabS.forEach((tabSC) => {
    tabSC.addEventListener("click", () => {
        const selectedDay = tabSC.getAttribute("data-day");
        showScheduleForDay(selectedDay);
    });
});

// Dapatkan hari saat ini (0 = Minggu, 1 = Senin, dst.)
const currentDate = new Date();
const currentDayIndex = currentDate.getDay();
const currentDayName = dayMapping[currentDayIndex]; // Nama hari dalam bahasa Indonesia

// Secara otomatis tampilkan program untuk hari ini
showScheduleForDay(currentDayName);
// });
if (window.matchMedia("(max-width: 480px)").matches) {
    const days = [
        "senin",
        "selasa",
        "rabu",
        "kamis",
        "jumat",
        "sabtu",
        "minggu",
    ];
    const dayNames = [
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
        "Sunday",
    ];
    const currentDayIndex = new Date().getDay() - 1; // JavaScript getDay() Sunday=0
    let selectedDayIndex = currentDayIndex < 0 ? 6 : currentDayIndex; // Adjust for Monday start
    const currentDayElement = document.getElementById("currentDay");
    const prevButton = document.getElementById("prevDay");
    const nextButton = document.getElementById("nextDay");
    const scheduleBoxes = document.querySelectorAll(".box-schedule-mobile");

    function updateSchedule() {
        const selectedDay = days[selectedDayIndex];
        currentDayElement.textContent = dayNames[selectedDayIndex];

        // Tampilkan jadwal sesuai hari
        scheduleBoxes.forEach((box) => {
            if (box.dataset.day === selectedDay) {
                box.classList.add("active");
            } else {
                box.classList.remove("active");
            }
        });
    }

    // Navigasi antar hari
    prevButton.addEventListener("click", () => {
        selectedDayIndex = (selectedDayIndex - 1 + days.length) % days.length;
        updateSchedule();
    });

    nextButton.addEventListener("click", () => {
        selectedDayIndex = (selectedDayIndex + 1) % days.length;
        updateSchedule();
    });

    // Inisialisasi tampilan awal
    updateSchedule();
}
// Load YouTube API
// document.addEventListener("DOMContentLoaded", function () {
//     const video = document.getElementById("hlsPlayer");
//     const hlsUrl = document.getElementById("player").getAttribute("data-pl");

//     if (Hls.isSupported()) {
//         const hls = new Hls();
//         hls.loadSource(hlsUrl);
//         hls.attachMedia(video);
//         hls.on(Hls.Events.MANIFEST_PARSED, function () {
//             // Menghapus video.play() di sini
//             // Video tidak akan diputar otomatis saat manifest diparsing
//         });
//     } else if (video.canPlayType("application/vnd.apple.mpegurl")) {
//         video.src = hlsUrl;
//         // Menghapus video.play() di sini
//         // Video tidak akan diputar otomatis saat metadata dimuat
//     }

//     // Menambahkan event listener agar video hanya diputar ketika user melakukan interaksi
//     video.addEventListener("click", function () {
//         video.play();
//     });

// });

// api untuk feed instagram
// Mengambil data feed dari API
fetch("/api/instagram/feed/{id}") // Ganti {id} dengan ID yang sesuai
    .then((response) => response.json())
    .then((data) => {
        const swiperContainer = document.querySelector(
            ".area-content-box-feed-instagram"
        );
        const template = document.getElementById("feed-template");

        data.forEach((feed) => {
            const clone = template.content.cloneNode(true);
            const slide = clone.querySelector(".box-feed-instagram");

            // Mengisi data ke slide
            slide.querySelector("img").src = feed.media_url;
            slide.querySelector("img").alt = feed.caption;
            slide.dataset.title = feed.caption;
            slide.dataset.description = feed.media_type;
            slide.dataset.time = feed.timestamp;

            swiperContainer.appendChild(clone);
        });
    })
    .catch((error) => console.error("Error:", error));
