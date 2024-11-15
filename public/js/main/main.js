// DOM Element References
const content = document.querySelector(".content"),
    Playimage = content.querySelector(".music-image img"),
    musicName = content.querySelector(".music-titles .name"),
    musicArtist = content.querySelector(".music-titles .artist"),
    Audio = document.querySelector(".main-song"),
    playBtn = document.querySelectorAll(
        ".play-pause, .play-pause-mobile, .btn-play-streaming, .btn-play-chart, .btn-play-DP"
    ),
    prevBtn = content.querySelector("#prev"),
    nextBtn = content.querySelector("#next"),
    progressBar = content.querySelector(".progress-bar"),
    progressDetails = content.querySelector(".progress-details"),
    currentTimeDisplay = content.querySelector(".current-time"),
    durationTimeDisplay = content.querySelector(".duration-time");

// Global Variables
let currentIndex = null;
let eps = 1;
let isPlaying = false;
let isStreamingPlaying = false;
let lastStreamingSrc = null;
let podcastId = document.getElementById("id_podcast")
    ? document.getElementById("id_podcast").textContent
    : null;
let IdP = document.getElementById("idP")
    ? document.getElementById("idP").textContent
    : null;
let isAudioPaused = false;
let isChartPlaying = false;
let lastAudioSrc = "";

// ----------------------------
// Event Listeners
// ----------------------------

// Load podcast details on page load
window.addEventListener("load", () => {
    if (IdP) {
        loadPodcastDetails(IdP);
    }
});

// Play/Pause Button Click Event
// playBtn.forEach((button) => {
//     button.addEventListener("click", () => {
//         if (isPlaying) {
//             pauseSong();
//             if (isStreamingPlaying) {
//                 pauseStreaming();
//             }
//         } else {
//             playSong();
//         }
//     });
// });

// ----------------------------
// Podcast Functions
// ----------------------------

// Status play/pause untuk setiap podcast berdasarkan ID podcast
let playPodcastStatus = {};
let currentPodcastId = null; // Simpan ID podcast yang sedang dimainkan

function loadPodcastDetails(idP) {
    fetch(`/podcast/details/${idP}`)
        .then((response) => response.json())
        .then((data) => {
            if (data) {
                musicName.innerHTML = data.judul_podcast;
                musicArtist.innerHTML = data.genre_podcast;
                Playimage.src = "./storage/" + data.image_podcast;
                Audio.src = "./storage/" + data.file;
                Audio.load(); // Load hanya saat pertama kali
                playPodcastStatus[idP] = { isPlaying: false }; // Reset status
                currentPodcastId = idP; // Set current podcast
            } else {
                console.error("Podcast not found.");
            }
        })
        .catch((error) => console.error("Failed to load podcast data:", error));
}

function loadEpisode(idP, episode, direction) {
    fetch(`/podcast/${idP}/episode/${episode}/${direction}`)
        .then((response) => response.json())
        .then((data) => {
            if (data) {
                musicName.innerHTML = data.judul_podcast;
                musicArtist.innerHTML = data.genre_podcast;
                Playimage.src = "./storage/" + data.image_podcast;
                Audio.src = "./storage/" + data.file;
                Audio.load();
                playPodcastStatus[idP] = { isPlaying: false }; // Reset status
            } else {
                console.error("Episode not found.");
            }
        })
        .catch((error) => console.error("Failed to load episode data:", error));
}

// Fungsi play podcast
function playPodcast(idP) {
    if (!playPodcastStatus[idP]?.isPlaying) {
        Audio.play()
            .then(() => {
                playPodcastStatus[idP].isPlaying = true;
                currentPodcastId = idP; // Update current podcast ID
                updatePodcastPlayButtonState(idP);
            })
            .catch((error) => {
                console.error("Audio play error:", error);
            });
    }
}

// Fungsi pause podcast
function pausePodcast(idP) {
    if (!Audio.paused) {
        Audio.pause();
        playPodcastStatus[idP].isPlaying = false;
        updatePodcastPlayButtonState(idP);
    }
}

// Update status tombol play/pause
function updatePodcastPlayButtonState(idP) {
    document.querySelectorAll(".btn-play-DP, .play-pause").forEach((button) => {
        const icon = button.querySelector("span");
        const buttonId = button.getAttribute("data-id");

        if (buttonId === idP || button.classList.contains("play-pause")) {
            icon.textContent = playPodcastStatus[idP]?.isPlaying
                ? "pause"
                : "play_arrow";
            button.classList.toggle(
                "active",
                playPodcastStatus[idP]?.isPlaying
            );
        } else if (button.classList.contains("btn-play-DP")) {
            icon.textContent = "play_arrow"; // Reset ikon tombol lainnya
            button.classList.remove("active");
        }
    });
}

// Event listener untuk tombol .btn-play-DP
document.querySelectorAll(".btn-play-DP").forEach((button) => {
    button.addEventListener("click", () => {
        const podcastId = button.getAttribute("data-id");
        if (!playPodcastStatus[podcastId]?.isPlaying) {
            playPodcast(podcastId);
        } else {
            pausePodcast(podcastId);
        }
    });
});

// Event listener untuk tombol .play-pause di audio player
document.querySelectorAll(".play-pause").forEach((button) => {
    button.addEventListener("click", () => {
        if (currentPodcastId) {
            if (Audio.paused) {
                playPodcast(currentPodcastId);
            } else {
                pausePodcast(currentPodcastId);
            }
        }
    });
});

// Update status ketika Audio dijeda atau dimainkan
Audio.onpause = () => {
    if (currentPodcastId) {
        playPodcastStatus[currentPodcastId].isPlaying = false;
        updatePodcastPlayButtonState(currentPodcastId);
    }
};

Audio.onplay = () => {
    if (currentPodcastId) {
        playPodcastStatus[currentPodcastId].isPlaying = true;
        updatePodcastPlayButtonState(currentPodcastId);
    }
};

// Event listener untuk tombol next dan prev
nextBtn.addEventListener("click", () => {
    eps++; // Increment episode number
    loadEpisode(podcastId, eps, "next");
});

prevBtn.addEventListener("click", () => {
    eps = Math.max(1, eps - 1); // Ensure eps doesn't go below 1
    loadEpisode(podcastId, eps, "previous");
});


// Streaming Functions
// ----------------------------
document.addEventListener("DOMContentLoaded", function () {
    function toggleStreaming() {
        if (isStreamingPlaying) {
            pauseStreaming();
        } else {
            playStreaming();
        }
    }
    
     window.playStreaming = function() {
        if (!isStreamingPlaying) {
            Audio.play()
                .then(() => {
                    isStreamingPlaying = true;
                    updatePlayPauseButtonState();
                })
                .catch((error) => {
                    console.error("Error playing streaming audio:", error);
                });
        }
    }
    
     window.pauseStreaming = function() {
        if (isStreamingPlaying) {
            Audio.pause();
            isStreamingPlaying = false;
            updatePlayPauseButtonState();
        }
    }
    
    function updatePlayPauseButtonState() {
        // Memperbarui status tombol play/pause baik untuk tombol play streaming maupun play-pause umum
        document.querySelectorAll(".btn-play-streaming, .play-pause").forEach((button) => {
            const icon = button.querySelector("span");
    
            if (isStreamingPlaying) {
                icon.textContent = "pause"; // Menampilkan ikon pause
            } else {
                icon.textContent = "play_arrow"; // Menampilkan ikon play
            }
        });
    }
    
    document.querySelectorAll(".btn-play-streaming").forEach((button) => {
        button.addEventListener("click", () => {
            const streamingSrc = button.getAttribute("data-audio-src");
            const streamName = "Streaming Audio";
            const streamArtist = "Live Stream";
            loadStreamingAudio(streamingSrc, streamName, streamArtist);
        });
    });
    
    function loadStreamingAudio(streamingSrc, streamName, streamArtist) {
        if (streamingSrc) {
            if (streamingSrc !== lastStreamingSrc || !isStreamingPlaying) {
                Audio.src = streamingSrc;
                Audio.crossOrigin = "anonymous";
                lastStreamingSrc = streamingSrc;
                Audio.load();
    
                Audio.oncanplay = () => {
                    musicName.innerHTML = streamName;
                    musicArtist.innerHTML = streamArtist;
                    playStreaming();
                };
            } else {
                pauseStreaming();
            }
        } else {
            console.error("Streaming source not found.");
        }
    }
    
    // Event listener untuk tombol play/pause umum (play-pause)
    document.querySelectorAll(".play-pause").forEach((button) => {
        button.addEventListener("click", toggleStreaming); // Saat tombol ini diklik, toggle streaming
    });
});



// ----------------------------
// chart
// ----------------------------
let currentChartId = null; // Menyimpan ID chart yang sedang diputar
let playStatus = {}; // Menyimpan status play/pause per chart
let lastClickedBtnId = null; // Variabel untuk menyimpan ID tombol yang terakhir diklik

// Fungsi untuk memutar chart audio
function playChartAudio(audioSrc, chartName, chartArtist, chartId) {
    if (audioSrc) {
        // Jika audio yang diputar berbeda, stop audio yang sedang diputar dan mulai yang baru
        if (Audio.src !== audioSrc) {
            Audio.pause();
            if (currentChartId) {
                playStatus[currentChartId] = { isPlaying: false }; // Set tombol sebelumnya jadi pause
            }

            // Set audio baru dan mulai memutar
            Audio.src = audioSrc;
            Audio.load();
            Audio.play()
                .then(() => {
                    musicName.innerHTML = chartName;
                    musicArtist.innerHTML = chartArtist;
                    if (!playStatus[chartId]) {
                        playStatus[chartId] = {}; // Inisialisasi jika belum ada
                    }
                    playStatus[chartId].isPlaying = true;
                    currentChartId = chartId; // Update ID chart yang sedang diputar
                    updatePlayButtonState(); // Update status tombol play/pause
                })
                .catch((error) => console.error("Audio play error:", error));
        } else {
            // Jika audio yang sama, toggle antara play dan pause
            if (Audio.paused) {
                Audio.play();
                if (!playStatus[chartId]) {
                    playStatus[chartId] = {}; // Inisialisasi jika belum ada
                }
                playStatus[chartId].isPlaying = true;
            } else {
                Audio.pause();
                if (!playStatus[chartId]) {
                    playStatus[chartId] = {}; // Inisialisasi jika belum ada
                }
                playStatus[chartId].isPlaying = false;
            }
            updatePlayButtonState(); // Update status tombol play/pause
        }
    }
}

// Fungsi untuk memperbarui status tombol play/pause berdasarkan playStatus[chartId]
function updatePlayButtonState() {
    // Update tombol play/pause untuk semua chart
    document
        .querySelectorAll(".btn-play-chart, .play-pause")
        .forEach((button) => {
            const chartId = button.getAttribute("data-id"); // ID chart atau null untuk tombol utama
            const icon = button.querySelector("span");

            // Periksa apakah tombol adalah tombol chart spesifik atau tombol utama
            const isMainPlayPauseButton =
                button.classList.contains("play-pause");

            if (
                (chartId === currentChartId &&
                    playStatus[chartId]?.isPlaying) ||
                (isMainPlayPauseButton && !Audio.paused)
            ) {
                // Jika audio sedang diputar, ikon diubah ke "pause"
                icon.textContent = "pause";
            } else {
                // Jika audio dijeda atau tidak diputar, ikon diubah ke "play_arrow"
                icon.textContent = "play_arrow";
            }
        });
}

// Fungsi untuk memutar lagu di chart tertentu
function playSong(chartId, audioSrc, chartName, chartArtist) {
    if (Audio.paused) {
        currentChartId = chartId;
        Audio.src = audioSrc;
        Audio.load();
        Audio.play()
            .then(() => {
                musicName.innerHTML = chartName;
                musicArtist.innerHTML = chartArtist;
                playStatus[chartId] = { isPlaying: true };
                updatePlayButtonState(); // Update tombol play/pause
            })
            .catch((error) => console.error("Audio play error:", error));
    }
}

// Fungsi untuk menjeda lagu di chart tertentu
function pauseSong(chartId) {
    if (!Audio.paused) {
        Audio.pause();
        playStatus[chartId] = { isPlaying: false }; // Update status play/pause untuk chart ini
        updatePlayButtonState(); // Update tombol play/pause
    }
}

// Event listener untuk tombol .btn-play-chart
document.querySelectorAll(".btn-play-chart").forEach((button) => {
    button.addEventListener("click", () => {
        const audioSrc = button.getAttribute("data-audio-src");
        const chartName = button.getAttribute("data-name");
        const chartArtist = button.getAttribute("data-kategori");
        const chartId = button.getAttribute("data-id");

        // Jika tombol yang sama diklik lagi
        if (lastClickedBtnId === chartId) {
            if (playStatus[chartId]?.isPlaying) {
                pauseSong(chartId);
                currentChartId = null; 
            } else {
                
                playSong(chartId, audioSrc, chartName, chartArtist);
            }
            return; 
        }
        lastClickedBtnId = chartId;

        if (currentChartId && currentChartId !== chartId) {
            pauseSong(currentChartId);
            currentChartId = null;
        }

        playSong(chartId, audioSrc, chartName, chartArtist);
    });
});

// Event listener untuk tombol play/pause utama
document.querySelector(".play-pause").addEventListener("click", () => {
    if (Audio.paused) {
        Audio.play()
            .then(() => {
                if (currentChartId) {
                    playStatus[currentChartId].isPlaying = true;
                }
                updatePlayButtonState(); 
            })
            .catch((error) => console.error("Audio play error:", error)); 
    } else {
        Audio.pause();
        if (currentChartId) {
            playStatus[currentChartId].isPlaying = false;
        }
        updatePlayButtonState();
    }
});

// Ketika audio dijeda, perbarui status dan ikon tombol
Audio.onplay = () => {
    if (currentChartId) {
        if (!playStatus[currentChartId]) {
            playStatus[currentChartId] = {}; 
        }
        playStatus[currentChartId].isPlaying = true;
    }
    updatePlayButtonState();
};

Audio.onpause = () => {
    if (currentChartId) {
        if (!playStatus[currentChartId]) {
            playStatus[currentChartId] = {};
        }
        playStatus[currentChartId].isPlaying = false;
    }
    updatePlayButtonState();
};
// ----------------------------
// progress bar
// ----------------------------

// Update progress bar based on audio time update
Audio.addEventListener("timeupdate", () => {
    if (Audio.duration) {
        const progressPercent = (Audio.currentTime / Audio.duration) * 100;
        progressBar.style.width = `${progressPercent}%`; // Update progress bar width
        // updateAudioTimeDisplay();
    }
});

// Seek functionality: Jump to clicked position on progress bar
progressDetails.addEventListener("click", (event) => {
    const clickPosition = event.offsetX / progressDetails.clientWidth;
    Audio.currentTime = clickPosition * Audio.duration;
});
// ----------------------------
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
            newPath += `C${controlX1} ${controlY1}, ${controlX2} ${controlY2}, ${x} ${y}`;
        } else {
            newPath += `L${x} ${y}`;
        }
    }

    newPath += `L${width} ${height / 2}`;
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

document.addEventListener("DOMContentLoaded", function () {
    const prevButton = document.getElementById("prev");
    const nextButton = document.getElementById("next");
    const controlBtn = document.getElementById("control-btn");
    const img = document.getElementById("image");

    const currentPage = window.location.pathname;

    if (currentPage.includes("detail-podcast")) {
        prevButton.style.display = "flex";  
        nextButton.style.display = "flex"; 
    } else {
        prevButton.style.display = "none"; 
        nextButton.style.display = "none"; 
        controlBtn.style.width = "170px";
        controlBtn.style.gap = "20px";
        img.style.display = "none";
    }
});

// ----------------------------------------------

document
    .getElementById("dropdown-toggle")
    .addEventListener("click", function (event) {
        document.getElementById("dropdown-menu").classList.toggle("show");
        event.preventDefault();
    });

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

document
    .getElementById("hamburger-icon")
    .addEventListener("click", function () {
        const mobileMenu = document.getElementById("mobile-menu");
        mobileMenu.classList.toggle("active");
    });

const closeMenu = document.getElementById("close-menu") || null;

// Close the mobile menu on close icon click
if (closeMenu) {
    closeMenu.addEventListener("click", function () {
        const mobileMenu = document.getElementById("mobile-menu");
        if (mobileMenu) {
            mobileMenu.classList.remove("active");
        }
    });
}

// Close menu when clicking outside of the mobile menu
document.addEventListener("click", function (event) {
    const mobileMenu = document.getElementById("mobile-menu");
    const hamburgerIcon = document.getElementById("hamburger-icon");

    const isClickInsideMenu = mobileMenu.contains(event.target);
    const isClickInsideHamburger = hamburgerIcon.contains(event.target);

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
        ComCP.classList.add("slide-out");

        Comcontrolbtn.style.backgroundColor = "transparent";
        setTimeout(() => {
            ComCP.style.display = "none";
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
});

// Mendapatkan path URL saat ini
const currentPath = window.location.pathname;
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
    popupEvent.classList.add("muncul"); 
    popupEvent.style.display = "flex"; 

    const description = element.getAttribute("data-description");
    const date = element.getAttribute("data-date");

    console.log("Deskripsi:", description);
    console.log("Tanggal:", date);

    document.querySelector(".desk-event").textContent =
        description || "Deskripsi tidak tersedia";
    document.querySelector(".title-box-event").textContent =
        date || "Tanggal tidak tersedia";
    document.getElementById("popupEvent").style.display = "flex";
}

function closePopupEvent() {
    const popupEvent = document.getElementById("popupEvent");
    popupEvent.classList.remove("muncul"); 
    popupEvent.classList.add("tutup"); 


    setTimeout(() => {
        popupEvent.style.display = "none";
        popupEvent.classList.remove("tutup");
    }, 300);
}

function closePopupOutsideEvent(event) {
    if (event.target.id === "popupEvent") {
        closePopupEvent();
    }
}
// -----------

