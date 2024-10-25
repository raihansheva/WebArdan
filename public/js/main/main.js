// audio spectrum
const content = document.querySelector(".content"),
    Playimage = content.querySelector(".music-image img"),
    musicName = content.querySelector(".music-titles .name"),
    musicArtist = content.querySelector(".music-titles .artist"),
    Audio = document.querySelector(".main-song"),
    playBtn = document.querySelectorAll(
        ".play-pause, .play-pause-mobile, .btn-play-streaming"
    ), // Mengambil semua tombol play
    playBtnIcon = content.querySelector(".play-pause span"),
    prevBtn = content.querySelector("#prev"),
    nextBtn = content.querySelector("#next"),
    progressBar = content.querySelector(".progress-bar"),
    progressDetails = content.querySelector(".progress-details"),
    repeatBtn = content.querySelector("#repeat"),
    Shuffle = content.querySelector("#shuffle");

let index = 1;

// Memuat data saat halaman di-load
window.addEventListener("load", () => {
    loadData(index);
});

// Fungsi untuk memuat data lagu berdasarkan indeks
function loadData(indexValue) {
    musicName.innerHTML = songs[indexValue - 1].name;
    musicArtist.innerHTML = songs[indexValue - 1].artist;
    Playimage.src = "images/" + songs[indexValue - 1].img + ".jpg";
    Audio.src = "music/" + songs[indexValue - 1].audio + ".mp3";
}

// Menambahkan event listener pada semua tombol play (baik versi web maupun mobile)
playBtn.forEach((button) => {
    button.addEventListener("click", () => {
        const isMusicPaused = content.classList.contains("paused");
        if (isMusicPaused) {
            pauseSong();
        } else {
            playSong();
        }
    });
});

// Fungsi untuk memainkan lagu
function playSong() {
    content.classList.add("paused");
    updatePlayBtnIcon("pause"); // Memperbarui ikon play untuk semua tombol
    Audio.play();
}

// Fungsi untuk menjeda lagu
function pauseSong() {
    content.classList.remove("paused");
    updatePlayBtnIcon("play_arrow"); // Memperbarui ikon play untuk semua tombol
    Audio.pause();
}

// Fungsi untuk memperbarui ikon tombol play
function updatePlayBtnIcon(icon) {
    playBtn.forEach((button) => {
        let iconElement = button.querySelector("span");
        if (iconElement) {
            iconElement.innerHTML = icon;
        }
    });
}

nextBtn.addEventListener("click", () => {
    nextSong();
});

prevBtn.addEventListener("click", () => {
    prevSong();
});

// Fungsi untuk memainkan lagu selanjutnya
function nextSong() {
    index++;
    if (index > songs.length) {
        index = 1;
    }
    loadData(index);
    playSong();
}

// Fungsi untuk memainkan lagu sebelumnya
function prevSong() {
    index--;
    if (index <= 0) {
        index = songs.length;
    }
    loadData(index);
    playSong();
}

// Memperbarui progress bar sesuai dengan waktu audio
Audio.addEventListener("timeupdate", (e) => {
    const initialTime = e.target.currentTime; // Waktu lagu saat ini
    const finalTime = e.target.duration; // Total durasi lagu
    let BarWidth = (initialTime / finalTime) * 100;
    progressBar.style.width = BarWidth + "%";

    // Memungkinkan pengguna untuk mengklik progress bar dan mengubah waktu lagu
    progressDetails.addEventListener("click", (e) => {
        let progressValue = progressDetails.clientWidth; // Lebar progress bar
        let clickedOffsetX = e.offsetX; // Posisi klik
        let MusicDuration = Audio.duration; // Total durasi musik

        Audio.currentTime = (clickedOffsetX / progressValue) * MusicDuration;
    });
});

// Ketika lagu berakhir, otomatis ke lagu berikutnya
Audio.addEventListener("ended", () => {
    nextSong();
});

// Spectrum Audio Visualization
const svg = document.getElementById("visual");
const audio = Audio;
const path = svg.querySelector("#layer1");

const audioContext = new (window.AudioContext || window.webkitAudioContext)();
const analyser = audioContext.createAnalyser();
analyser.fftSize = 2048;
const bufferLength = analyser.frequencyBinCount;
const dataArray = new Uint8Array(bufferLength);

const source = audioContext.createMediaElementSource(audio);
source.connect(analyser);
analyser.connect(audioContext.destination);

function updateVisualization() {
    analyser.getByteFrequencyData(dataArray);

    const width = svg.clientWidth;
    const height = svg.clientHeight;

    const numPoints = 7; // Jumlah titik yang ditampilkan
    const step = width / (numPoints - 1);

    const waveHeight = height / 1.5; // Tinggi gelombang, dapat diatur sesuai kebutuhan

    let newPath = `M0 ${height / 2}`;

    for (let i = 1; i < numPoints; i++) {
        const index = Math.floor(i * (bufferLength / numPoints));
        const amplitude = dataArray[index] || 0;
        const scaledAmplitude = (amplitude / 255) * waveHeight; // Menggunakan waveHeight

        const x = i * step;
        const y = height / 2 - scaledAmplitude;

        if (i > 0) {
            const prevX = (i - 1) * step;
            const prevY =
                height / 2 -
                ((dataArray[Math.floor((i - 1) * (bufferLength / numPoints))] ||
                    0) /
                    255) *
                    waveHeight; // Menggunakan waveHeight

            // Menghitung kontrol titik untuk kurva Bezier
            const controlX1 = prevX + (x - prevX) * 0.4;
            const controlY1 = prevY;
            const controlX2 = prevX + (x - prevX) * 0.6;
            const controlY2 = y;

            // Menambahkan kurva Bezier
            newPath += ` C${controlX1} ${controlY1}, ${controlX2} ${controlY2}, ${x} ${y}`;
        } else {
            newPath += ` L${x} ${y}`;
        }
    }

    newPath += ` L${width} ${height / 2}`;
    path.setAttribute("d", newPath);
    requestAnimationFrame(updateVisualization);
}

// function updateVisualization() {
//     analyser.getByteFrequencyData(dataArray);

//     const width = svg.clientWidth;
//     const height = svg.clientHeight;

//     const numBars = 64; // Jumlah bar yang ditampilkan
//     const barWidth = 50; // Lebar bar yang dapat diatur (misalnya, 5 piksel)

//     // Menghapus semua rectangle yang ada sebelumnya
//     while (svg.firstChild) {
//         svg.removeChild(svg.firstChild);
//     }

//     for (let i = 0; i < numBars; i++) {
//         const index = Math.floor(i * (bufferLength / numBars));
//         const amplitude = dataArray[index] || 0;
//         const scaledAmplitude = (amplitude / 255) * height;

//         const x = i * barWidth; // Posisi x dari bar
//         const y = height - scaledAmplitude; // Posisi y dari bar

//         // Membuat elemen rectangle
//         const rect = document.createElementNS("http://www.w3.org/2000/svg", "rect");
//         rect.setAttribute("x", x);
//         rect.setAttribute("y", y);
//         rect.setAttribute("width", barWidth - 1); // Lebar bar (kurangi sedikit agar tidak ada celah)
//         rect.setAttribute("height", scaledAmplitude); // Tinggi bar
//         rect.setAttribute("fill", "#FF004D"); // Warna bar

//         svg.appendChild(rect); // Menambahkan bar ke dalam SVG
//     }

//     requestAnimationFrame(updateVisualization);
// }

audio.addEventListener("play", () => {
    audioContext.resume().then(() => {
        updateVisualization();
    });
});

window.addEventListener("resize", () => {
    path.setAttribute("d", "");
});
// ----------------------------------------------

// JavaScript untuk toggle dropdown saat diklik
document
    .getElementById("dropdown-toggle")
    .addEventListener("click", function (event) {
        // Toggle class 'show' untuk menampilkan atau menyembunyikan dropdown
        document.getElementById("dropdown-menu").classList.toggle("show");

        // Mencegah link default jika ada di dropdown-text
        event.preventDefault();
    });

// Tutup dropdown jika klik di luar dropdown
window.onclick = function (event) {
    if (!event.target.matches(".arrow-down")) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains("show")) {
                openDropdown.classList.remove("show");
            }
        }
    }
};

// document.querySelectorAll(".link").forEach((anchor) => {
//     anchor.addEventListener("click", function (e) {
//         e.preventDefault();

//         const target = document.querySelector(this.getAttribute("href"));
//         const navbarHeight = document.querySelector(".navbar").offsetHeight;
//         const targetTop =
//             target.getBoundingClientRect().top + window.pageYOffset;

//         // Sesuaikan posisi scroll dengan menambahkan offset height dari navbar
//         window.scrollTo({
//             top: targetTop - navbarHeight,
//             behavior: "smooth",
//         });
//     });
// });

// Toggle mobile menu on hamburger icon click
document
    .getElementById("hamburger-icon")
    .addEventListener("click", function () {
        const mobileMenu = document.getElementById("mobile-menu");
        mobileMenu.classList.toggle("active");
    });

// Close the mobile menu on close icon click
document.getElementById("close-menu").addEventListener("click", function () {
    const mobileMenu = document.getElementById("mobile-menu");
    mobileMenu.classList.remove("active");
});

// Close menu when clicking outside of the mobile menu
document.addEventListener("click", function (event) {
    const mobileMenu = document.getElementById("mobile-menu");
    const hamburgerIcon = document.getElementById("hamburger-icon");

    const isClickInsideMenu = mobileMenu.contains(event.target);
    const isClickInsideHamburger = hamburgerIcon.contains(event.target);

    // console.log("Clicked inside menu: ", isClickInsideMenu);
    // console.log("Clicked inside hamburger: ", isClickInsideHamburger);

    if (
        !isClickInsideMenu &&
        !isClickInsideHamburger &&
        mobileMenu.classList.contains("active")
    ) {
        // console.log("Closing mobile menu");
        mobileMenu.classList.remove("active");
    }
});
window.onload = function () {
    checkScrollPosition();
};

window.onscroll = function () {
    checkScrollPosition();
};

function checkScrollPosition() {
    var scrollToTopBtn = document.getElementById("scrollToTopBtn");
    if (
        document.body.scrollTop > 100 ||
        document.documentElement.scrollTop > 100
    ) {
        scrollToTopBtn.style.display = "block";
    } else {
        scrollToTopBtn.style.display = "none";
    }
}

// Fungsi untuk scroll ke atas
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: "smooth", // Scroll secara halus
    });
}

// show hide audio player

const btnhideshow = document.getElementById("show-hide-player");
var Comaudioplayer = document.querySelector(".content"),
    ComCP = document.querySelector(".area-control-progres"),
    Comcontrolbtn = document.querySelector(".area-control-btn");

let isVisible = true;

btnhideshow.addEventListener("click", function () {
    // audio first muncul
    if (isVisible) {
        // Comaudioplayer.classList.add("fade-out"); // Tambahkan kelas fade-out
        ComCP.classList.add("slide-out");

        Comcontrolbtn.style.backgroundColor = "transparent";
        setTimeout(() => {
            ComCP.style.display = "none";
            // Comaudioplayer.classList.remove("fade-out");
            ComCP.classList.remove("slide-out");
        }, 500);
    } else {
        ComCP.style.display = "flex";
        // Comaudioplayer.classList.add("fade-in");
        ComCP.classList.add("slide-in");

        setTimeout(() => {
            // Comaudioplayer.classList.remove("fade-in");
            ComCP.classList.remove("slide-in");
            Comimage.classList.remove("slide-in");
            Commusictitle.classList.remove("slide-in");
        }, 500);

        setTimeout(() => {
            Comcontrolbtn.style.backgroundColor = "";
        }, 280);
    }

    isVisible = !isVisible;
    // ----------------------

    // audio player first hide
    // if (isVisible) {
    //     // Comaudioplayer.classList.add("fade-out"); // Tambahkan kelas fade-out
    //     ComCP.style.display = "flex";
    //     ComCP.classList.add("slide-in");

    //     setTimeout(() => {
    //         // Comaudioplayer.classList.remove("fade-out");
    //         ComCP.classList.remove("slide-in");
    //     }, 500);

    //     setTimeout(() =>{
    //         Comcontrolbtn.style.backgroundColor = "#17171769";

    //     }, 280);
    // } else {
    //     // Comaudioplayer.classList.add("fade-in");
    //     ComCP.classList.add("slide-out");

    //     Comcontrolbtn.style.backgroundColor = "transparent";
    //     setTimeout(() => {
    //         ComCP.style.display = "none";
    //         // Comaudioplayer.classList.remove("fade-in");
    //         ComCP.classList.remove("slide-out");
    //         Comimage.classList.remove("slide-out");
    //         Commusictitle.classList.remove("slide-out");
    //     }, 500);

    // }

    // isVisible = !isVisible;
    // ----------------------
});

// countdown event
// Mendapatkan path URL saat ini
const currentPath = window.location.pathname;

// Mengecek apakah URL-nya /home, /event, atau /
if (
    currentPath === "/home" ||
    currentPath === "/event" ||
    currentPath === "/" ||
    currentPath == "/ardan-youtube"
) {
    // Eksekusi JavaScript countdown hanya jika path sesuai
    const daysElement = document.getElementById("days");
    const hoursElement = document.getElementById("hours");
    const minutesElement = document.getElementById("minutes");
    const secondsElement = document.getElementById("seconds");

    const countdownDateStr = document
        .getElementById("dataTime")
        .innerText.trim();
    const countdownDate = new Date(countdownDateStr).getTime();

    function updateCountdown() {
        const now = new Date().getTime();
        const timeRemaining = countdownDate - now;

        const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
        const hours = Math.floor(
            (timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
        );
        const minutes = Math.floor(
            (timeRemaining % (1000 * 60 * 60)) / (1000 * 60)
        );
        const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

        daysElement.innerText = days < 10 ? "0" + days : days;
        hoursElement.innerText = hours < 10 ? "0" + hours : hours;
        minutesElement.innerText = minutes < 10 ? "0" + minutes : minutes;
        secondsElement.innerText = seconds < 10 ? "0" + seconds : seconds;

        if (timeRemaining < 0) {
            clearInterval(countdownInterval);
            daysElement.innerText = "00";
            hoursElement.innerText = "00";
            minutesElement.innerText = "00";
            secondsElement.innerText = "00";
            alert("Countdown selesai!");
        }
    }

    const countdownInterval = setInterval(updateCountdown, 1000);
}

// ---------------------------------------

// pop up event
function showPopupEvent(element) {
    const popupEvent = document.getElementById("popupEvent");
    popupEvent.classList.add("muncul"); // Tambahkan kelas show untuk animasi muncul
    popupEvent.style.display = "flex"; // Tampilkan pop-up

    const description = element.getAttribute('data-description');
    const date = element.getAttribute('data-date');

    // Log untuk melihat nilai yang diambil
    console.log('Deskripsi:', description);
    console.log('Tanggal:', date);
    
    // Menampilkan data di dalam pop-up
    document.querySelector('.desk-event').textContent = description || 'Deskripsi tidak tersedia';
    document.querySelector('.title-box-event').textContent = date || 'Tanggal tidak tersedia';

    // Menampilkan pop-up
    document.getElementById("popupEvent").style.display = "flex";
}

function closePopupEvent() {
    const popupEvent = document.getElementById("popupEvent");
    popupEvent.classList.remove("muncul"); // Hilangkan kelas show
    popupEvent.classList.add("tutup"); // Tambahkan kelas hide untuk animasi keluar

    // Sembunyikan pop-up setelah animasi selesai
    setTimeout(() => {
        popupEvent.style.display = "none";
        popupEvent.classList.remove("tutup"); // Reset kelas hide setelah pop-up hilang
    }, 300); // 300ms sesuai dengan durasi animasi
}

function closePopupOutsideEvent(event) {
    if (event.target.id === "popupEvent") {
        closePopupEvent();
    }
}
// -----------


// tabel connect  db