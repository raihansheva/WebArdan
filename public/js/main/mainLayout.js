const content = document.querySelector(".content"),
    Playimage = content.querySelector(".music-image img"),
    musicName = content.querySelector(".music-titles .name"),
    musicArtist = content.querySelector(".music-titles .artist"),
    Audio = document.querySelector(".main-song"),
    AudioStream = document.getElementById("audio-streaming"),
    AudioChart = document.getElementById("audio-chart"),
    AudioPodcast = document.getElementById("audio-podcast"),
    // playBtn = document.querySelectorAll(
    //     ".play-pause, .play-pause-mobile, .btn-play-streaming, .btn-play-chart, .btn-play-DP"
    // ),
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
let activeAudioSource = null;
let currentChartId = null; // Menyimpan ID chart yang sedang diputar
let playStatus = {}; // Menyimpan status play/pause per chart
let lastClickedBtnId = null;

// ---------------------------
// Streaming Functions
// ----------------------------
function stopAllAudio() {
    if (isStreamingPlaying) {
        pauseStreaming();
    }

    if (currentChartId) {
        pauseChart(currentChartId);
        currentChartId = null;
    }

    // Update semua tombol
    updatePlayPauseButtonStateC();
}

document.addEventListener("DOMContentLoaded", function () {
    let previousIsStreamingPlaying = null; // Menyimpan status sebelumnya untuk mencegah pembaruan ganda
    // Mengubah ID tombol play/pause untuk streaming
    function changeIdPlayPauseStream() {
        const playPauseBtnS = document.querySelector(".play-pause");
        if (playPauseBtnS) {
            playPauseBtnS.id = "streaming"; // Set ID tombol
        }
    }

    // Fungsi untuk toggle play/pause pada audio streaming
    function toggleStreaming() {
        if (activeAudioSource !== "streaming") {
            stopActiveAudio(); // Hentikan audio chart jika ada
            activeAudioSource = "streaming"; // Set audio aktif ke streaming
        }

        if (isStreamingPlaying) {
            pauseStreaming();
        } else {
            playStreaming();
        }
    }

    // Fungsi untuk memutar audio streaming
    window.playStreaming = function () {
        if (activeAudioSource !== "streaming") {
            stopActiveAudio(); // Hentikan audio lain
            activeAudioSource = "streaming";
        }

        if (!isStreamingPlaying) {
            AudioStream.play()
                .then(() => {
                    isStreamingPlaying = true;
                    updatePlayPauseButtonStateS();
                })
                .catch((error) => {
                    console.error("Error playing streaming audio:", error);
                    alert("Failed to play audio: " + error);
                });
        }
        startSpectrumAudio(AudioStream);
        proggresBarAudio(AudioStream);
    };

    // Fungsi untuk menjeda audio streaming
    window.pauseStreaming = function () {
        AudioStream.pause(); // Jeda audio streaming
        activeAudioSource = null; // Hapus status sumber aktif
        isStreamingPlaying = false;
        updatePlayPauseButtonStateS(); // Perbarui status tombol play/pause
    };

    // Fungsi untuk memuat audio streaming baru
    function loadStreamingAudio(streamingSrc, streamName, streamArtist) {
        if (streamingSrc) {
            // Pastikan kita hanya memuat streaming jika sumbernya berbeda atau audio tidak sedang diputar
            if (streamingSrc !== lastStreamingSrc || !isStreamingPlaying) {
                AudioStream.src = streamingSrc;
                AudioStream.crossOrigin = "anonymous";
                lastStreamingSrc = streamingSrc;
                AudioStream.load();

                AudioStream.oncanplay = () => {
                    musicName.innerHTML = streamName;
                    musicArtist.innerHTML = streamArtist;
                    playStreaming();
                };
            } else {
                pauseStreaming(); // Jika audio sudah diputar, hentikan
            }
        } else {
            console.error("Streaming source not found.");
        }
    }

    // Memperbarui status tombol play/pause
    function updatePlayPauseButtonStateS() {
        console.log("Updating play/pause button...");

        // Cek apakah status streaming berubah
        if (isStreamingPlaying !== previousIsStreamingPlaying) {
            const playPauseButtons = document.querySelectorAll(
                ".btn-play-streaming , .play-pause#streaming"
            );

            playPauseButtons.forEach((button) => {
                const icon = button.querySelector("span");

                // Pastikan elemen icon ada sebelum mengubahnya
                if (icon) {
                    if (isStreamingPlaying) {
                        icon.textContent = "pause"; // Jika streaming diputar, tampilkan ikon pause
                        console.log("Ini pausee woii");
                    } else {
                        icon.textContent = "play_arrow"; // Jika streaming dihentikan, tampilkan ikon play
                        console.log("Ini play woii");
                    }
                } else {
                    console.error("Icon element not found inside button.");
                }
            });

            // Simpan status saat ini agar tidak memperbarui lagi sampai ada perubahan status
            previousIsStreamingPlaying = isStreamingPlaying;
        }
    }

    // Event listener untuk tombol play/pause
    document.querySelectorAll(".btn-play-streaming").forEach((button) => {
        button.addEventListener("click", () => {
            const streamingSrc = button.getAttribute("data-audio-src");
            const streamName = "Streaming Audio";
            const streamArtist = "Live Stream";
            loadStreamingAudio(streamingSrc, streamName, streamArtist);
            changeIdPlayPauseStream();
        });
    });

    // Event listener untuk tombol umum play/pause
    // Tunggu elemen tersedia sebelum menambahkan event listener
    const intervalId = setInterval(() => {
        const playPauseBtn = document.querySelector(".play-pause#streaming");
        if (playPauseBtn) {
            clearInterval(intervalId); // Hentikan pengecekan jika elemen ditemukan
            playPauseBtn.addEventListener("click", toggleStreaming);
        }
    }, 100); // Cek setiap 100ms hingga elemen ditemukan

    // ----------------------------
    // chart
    // ----------------------------
    // Fungsi untuk memutar chart audio
    function playChartAudio(audioSrc, chartName, chartArtist, chartId) {
        if (audioSrc) {
            // Jika audio yang diputar berbeda, stop audio yang sedang diputar dan mulai yang baru
            if (AudioChart.src !== audioSrc) {
                AudioChart.pause();
                if (currentChartId) {
                    playStatus[currentChartId] = { isPlaying: false };
                }

                // Set audio baru dan mulai memutar
                AudioChart.src = audioSrc;
                AudioChart.load();
                AudioChart.play()
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
                    .catch((error) =>
                        console.error("Audio play error:", error)
                    );
            } else {
                // Jika audio yang sama, toggle antara play dan pause
                if (AudioChart.paused) {
                    AudioChart.play();
                    if (!playStatus[chartId]) {
                        playStatus[chartId] = {}; // Inisialisasi jika belum ada
                    }
                    playStatus[chartId].isPlaying = true;
                } else {
                    AudioChart.pause();
                    if (!playStatus[chartId]) {
                        playStatus[chartId] = {}; // Inisialisasi jika belum ada
                    }
                    playStatus[chartId].isPlaying = false;
                }
                updatePlayButtonState(); // Update status tombol play/pause
            }
        }
    }

    function changeIdPlayPause() {
        const playPauseBtn = document.querySelector(".play-pause");
        if (playPauseBtn) {
            playPauseBtn.id = "BtnChart"; // Set ID tombol
        }
    }

    // Fungsi untuk memperbarui status tombol play/pause berdasarkan playStatus[chartId]
    function updatePlayButtonState() {
        // Perbarui tombol play/pause di chart
        document.querySelectorAll(".btn-play-chart").forEach((button) => {
            const chartId = button.getAttribute("data-id");
            const icon = button.querySelector("span");
            icon.textContent = playStatus[chartId]?.isPlaying
                ? "pause"
                : "play_arrow";
        });

        // Perbarui tombol utama BtnChart
        const playPauseChart = document.querySelector(".play-pause#BtnChart");
        if (playPauseChart) {
            const iconChart = playPauseChart.querySelector("span");
            iconChart.textContent =
                currentChartId && playStatus[currentChartId]?.isPlaying
                    ? "pause"
                    : "play_arrow";
        }
    }

    // Fungsi untuk memutar lagu di chart tertentu
    function playSong(chartId, audioSrc, chartName, chartArtist) {
        console.log("Tombol chart diklik:", chartId);

        if (activeAudioSource !== "chart") {
            stopActiveAudio(); // Hentikan audio lain
            activeAudioSource = "chart";
        }
        // Set dan mainkan audio chart
        currentChartId = chartId; // Set ID chart yang sedang dimainkan
        AudioChart.src = audioSrc; // Set sumber audio
        AudioChart.load(); // Muat audio
        AudioChart.play()
            .then(() => {
                // Perbarui informasi pemutar
                musicName.innerHTML = chartName;
                musicArtist.innerHTML = chartArtist;
                playStatus[chartId] = { isPlaying: true };

                // Update status tombol play/pause
                updatePlayButtonState();
            })
            .catch((error) => {
                console.error("Audio play error:", error);
            });
        startSpectrumAudio(AudioChart);
        proggresBarAudio(AudioChart);
    }

    // Fungsi untuk menjeda lagu di chart tertentu
    function pauseSong(chartId) {
        AudioChart.pause();
        playStatus[chartId] = { isPlaying: false }; // Update status play/pause untuk chart ini
        updatePlayButtonState(); // Update tombol play/pause
    }

    // Event listener untuk tombol .btn-play-chart
    document.querySelectorAll(".btn-play-chart").forEach((button) => {
        button.addEventListener("click", () => {
            const chartId = button.getAttribute("data-id");
            const audioSrc = button.getAttribute("data-audio-src");
            const chartName = button.getAttribute("data-name");
            const chartArtist = button.getAttribute("data-kategori");
            changeIdPlayPause();

            // Hentikan streaming jika sedang berjalan
            if (isStreamingPlaying) {
                pauseStreaming();
            }

            // Perbarui logika tombol chart
            if (lastClickedBtnId === chartId) {
                console.log("Toggling play/pause for chartId:", chartId);
                if (playStatus[chartId]?.isPlaying) {
                    pauseSong(chartId);
                } else {
                    playSong(chartId, audioSrc, chartName, chartArtist);
                }
            } else {
                console.log(
                    "New song clicked, stopping previous chart:",
                    currentChartId
                );
                if (currentChartId) {
                    pauseSong(currentChartId);
                }
                playSong(chartId, audioSrc, chartName, chartArtist);
                lastClickedBtnId = chartId;
            }

            updatePlayButtonState();
            console.log("After play/pause:", {
                currentChartId,
                isStreamingPlaying,
                playStatus,
            });
        });
    });

    // Event listener untuk tombol play/pause utama
    const intervalIdChart = setInterval(() => {
        const playPauseBtnChart = document.querySelector(
            ".play-pause#BtnChart"
        );

        if (playPauseBtnChart) {
            clearInterval(intervalIdChart); // Hentikan pengecekan setelah elemen ditemukan

            playPauseBtnChart.addEventListener("click", () => {
                console.log("haloo ini play pause chart");
                // alert('haloo')
                if (activeAudioSource !== "chart") {
                    stopActiveAudio(); // Hentikan audio chart jika ada
                    activeAudioSource = "chart"; // Set audio aktif ke streaming
                }

                if (isStreamingPlaying) {
                    pauseStreaming();
                }

                if (currentChartId) {
                    if (AudioChart.paused) {
                        // Memulai audio jika tidak sedang diputar
                        AudioChart.play()
                            .then(() => {
                                playStatus[currentChartId].isPlaying = true;
                                updatePlayButtonState(); // Memperbarui status tombol play/pause
                            })
                            .catch((error) => {
                                console.error("Audio play error:", error);
                                alert("Failed to play the chart audio.");
                            });
                    } else {
                        // Menjeda audio jika sedang diputar
                        pauseSong(currentChartId); // Fungsi untuk menjeda lagu saat diputar
                        playStatus[currentChartId].isPlaying = false;
                        updatePlayButtonState(); // Memperbarui status tombol play/pause
                    }
                }
            });
        }
    }, 100); // Cek setiap 100ms hingga elemen ditemukan

    // Ketika audio dijeda, perbarui status dan ikon tombol
    if (AudioChart) {
        AudioChart.onplay = () => {
            if (currentChartId) {
                if (!playStatus[currentChartId]) {
                    playStatus[currentChartId] = {};
                }
                playStatus[currentChartId].isPlaying = true;
            }
            updatePlayButtonState();
        };

        AudioChart.onpause = () => {
            if (currentChartId && activeAudioSource === "chart") {
                playStatus[currentChartId].isPlaying = false;
                updatePlayButtonState();
            } else if (activeAudioSource === "streaming") {
                isStreamingPlaying = false;
                updatePlayPauseButtonStateS();
            }
        };
    }
    // ----------------------------
    // Podcast Functions
    // ----------------------------
    // Load podcast details on page load
    window.addEventListener("load", () => {
        if (IdP) {
            loadPodcastDetails(IdP);
        }
    });
    // Status play/pause untuk setiap podcast berdasarkan ID podcast
    let playPodcastStatus = {};
    let currentPodcastId = null; // Simpan ID podcast yang sedang dimainkan

    function changeIdPlayPausePodcast() {
        const playPauseBtn = document.querySelector(".play-pause");
        if (playPauseBtn) {
            playPauseBtn.id = "BtnPodcast"; // Set ID tombol
        }
    }
    function loadPodcastDetails(idP) {
        fetch(`/podcast/details/${idP}`)
            .then((response) => response.json())
            .then((data) => {
                if (data) {
                    musicName.innerHTML = data.judul_podcast;
                    musicArtist.innerHTML = data.genre_podcast;
                    Playimage.src = "./storage/" + data.image_podcast;
                    AudioPodcast.src = "./storage/" + data.file;
                    AudioPodcast.load(); // Load hanya saat pertama kali
                    playPodcastStatus[idP] = { isPlaying: false }; // Reset status
                    currentPodcastId = idP; // Set current podcast
                } else {
                    console.error("Podcast not found.");
                }
            })
            .catch((error) =>
                console.error("Failed to load podcast data:", error)
            );
    }

    function loadEpisode(idP, episode, direction) {
        fetch(`/podcast/${idP}/episode/${episode}/${direction}`)
            .then((response) => response.json())
            .then((data) => {
                if (data) {
                    musicName.innerHTML = data.judul_podcast;
                    musicArtist.innerHTML = data.genre_podcast;
                    Playimage.src = "./storage/" + data.image_podcast;
                    AudioPodcast.src = "./storage/" + data.file;
                    AudioPodcast.load();
                    playPodcastStatus[idP] = { isPlaying: false }; // Reset status
                } else {
                    console.error("Episode not found.");
                }
            })
            .catch((error) =>
                console.error("Failed to load episode data:", error)
            );
    }

    // Fungsi play podcast
    function playPodcast(idP) {
        if (activeAudioSource !== "podcast") {
            stopActiveAudio(); // Hentikan audio lain
            activeAudioSource = "podcast";
        }
        if (!playPodcastStatus[idP]?.isPlaying) {
            AudioPodcast.play()
                .then(() => {
                    playPodcastStatus[idP].isPlaying = true;
                    currentPodcastId = idP; // Update current podcast ID
                    updatePodcastPlayButtonState(idP);
                })
                .catch((error) => {
                    console.error("Audio play error:", error);
                });
        }

        startSpectrumAudio(AudioPodcast);
        proggresBarAudio(AudioPodcast);
    }

    // Fungsi pause podcast
    function pausePodcast(idP) {
        if (!AudioPodcast.paused) {
            AudioPodcast.pause();
            playPodcastStatus[idP].isPlaying = false;
            updatePodcastPlayButtonState(idP);
        }
    }

    // Update status tombol play/pause
    function updatePodcastPlayButtonState(idP) {
        document
            .querySelectorAll(".btn-play-DP, .play-pause#BtnPodcast")
            .forEach((button) => {
                const icon = button.querySelector("span");
                const buttonId = button.getAttribute("data-id");

                if (
                    buttonId === idP ||
                    button.classList.contains("play-pause")
                ) {
                    icon.textContent = playPodcastStatus[idP]?.isPlaying
                        ? "pause"
                        : "play_arrow";
                } else if (button.classList.contains("btn-play-DP")) {
                    icon.textContent = "play_arrow"; // Reset ikon tombol lainnya
                    button.classList.remove("active");
                }
            });
    }

    // Event listener untuk tombol .btn-play-DP
    document.querySelectorAll(".btn-play-DP").forEach((button) => {
        button.addEventListener("click", () => {
            changeIdPlayPausePodcast();
            if (isStreamingPlaying) {
                pauseStreaming();
            }
            const podcastId = button.getAttribute("data-id");
            if (!playPodcastStatus[podcastId]?.isPlaying) {
                playPodcast(podcastId);
            } else {
                pausePodcast(podcastId);
            }
        });
    });

    const intervalIdPodcast = setInterval(() => {
        const playPauseBtnChart = document.querySelector(
            ".play-pause#BtnPodcast"
        );

        if (playPauseBtnChart) {
            clearInterval(intervalIdPodcast); // Hentikan pengecekan setelah elemen ditemukan

            playPauseBtnChart.addEventListener("click", () => {
                console.log("haloo ini play pause chart");
                // alert('haloo')
                if (activeAudioSource !== "podcast") {
                    stopActiveAudio(); // Hentikan audio chart jika ada
                    activeAudioSource = "podcast"; // Set audio aktif ke streaming
                }

                if (isStreamingPlaying) {
                    pauseStreaming();
                }

                if (currentPodcastId) {
                    if (AudioPodcast.paused) {
                        playPodcast(currentPodcastId);
                    } else {
                        pausePodcast(currentPodcastId);
                    }
                }
            });
        }
    }, 100);

    // Update status ketika AudioPodcast dijeda atau dimainkan
    if (AudioPodcast) {
        AudioPodcast.onpause = () => {
            if (currentPodcastId) {
                playPodcastStatus[currentPodcastId].isPlaying = false;
                updatePodcastPlayButtonState(currentPodcastId);
            }
        };

        AudioPodcast.onplay = () => {
            if (currentPodcastId && activeAudioSource === "podcast") {
                playPodcastStatus[currentPodcastId].isPlaying = true;
                updatePodcastPlayButtonState(currentPodcastId);
            } else if (activeAudioSource === "streaming") {
                isStreamingPlaying = false;
                updatePlayPauseButtonStateS();
            }
        };
    }

    // Event listener untuk tombol next dan prev
    nextBtn.addEventListener("click", () => {
        eps++; // Increment episode number
        loadEpisode(podcastId, eps, "next");
    });

    prevBtn.addEventListener("click", () => {
        eps = Math.max(1, eps - 1); // Ensure eps doesn't go below 1
        loadEpisode(podcastId, eps, "previous");
    });

    function stopActiveAudio() {
        if (isStreamingPlaying) {
            pauseStreaming();
        }

        if (currentChartId) {
            pauseSong(currentChartId);
            currentChartId = null;
        }

        if (currentPodcastId) {
            pausePodcast(currentPodcastId);
            currentPodcastId = null;
        }

        // Resetkan status audio aktif
        activeAudioSource = null;
        updatePlayPauseButtonStateS(); // Update tombol play/pause streaming
        updatePlayButtonState(); // Update tombol play/pause chart
        updatePodcastPlayButtonState(currentPodcastId);
    }
    // ----------------------------
    // progress bar
    // ----------------------------
    function proggresBarAudio(Audio) {
        Audio.addEventListener("timeupdate", () => {
            if (Audio.duration) {
                const progressPercent =
                    (Audio.currentTime / Audio.duration) * 100;
                progressBar.style.width = `${progressPercent}%`; // Update progress bar width
                // updateAudioTimeDisplay();
            }
        });

        // Update progress bar based on audio time update
        // Seek functionality: Jump to clicked position on progress bar
        progressDetails.addEventListener("click", (event) => {
            const clickPosition = event.offsetX / progressDetails.clientWidth;
            Audio.currentTime = clickPosition * Audio.duration;
        });
    }
    // ----------------------------
    // Spectrum Audio Visualization
    // ----------------------------
    const svg = document.getElementById("visual");
    // const audio = AudioChart;
    const path = svg.querySelector("#layer1");

    // Gunakan satu instance AudioContext untuk semua audio
    const audioContext = new (window.AudioContext ||
        window.webkitAudioContext)();
    const analyser = audioContext.createAnalyser();
    analyser.fftSize = 2048;
    const bufferLength = analyser.frequencyBinCount;
    const dataArray = new Uint8Array(bufferLength);

    // Cache untuk MediaElementSourceNode
    const audioSourceMap = new Map();
    function startSpectrumAudio(audio) {
        function updateVisualization() {
            if (!audioSourceMap.has(audio)) {
                const source = audioContext.createMediaElementSource(audio);
                source.connect(analyser);
                analyser.connect(audioContext.destination);
                audioSourceMap.set(audio, source);
            }

            analyser.getByteFrequencyData(dataArray);

            const width = svg.clientWidth;
            const height = svg.clientHeight;

            const numPoints = 7; // Jumlah titik yang ditampilkan
            const step = width / (numPoints - 1);
            const waveHeight = height / 1.5; // Tinggi gelombang

            let newPath = `M0 ${height / 2}`;

            for (let i = 1; i < numPoints; i++) {
                const index = Math.floor(i * (bufferLength / numPoints));
                const amplitude = dataArray[index] || 0;
                const scaledAmplitude = (amplitude / 255) * waveHeight;

                const x = i * step;
                const y = height / 2 - scaledAmplitude;

                if (i > 0) {
                    const prevX = (i - 1) * step;
                    const prevY =
                        height / 2 -
                        ((dataArray[
                            Math.floor((i - 1) * (bufferLength / numPoints))
                        ] || 0) /
                            255) *
                            waveHeight;

                    const controlX1 = prevX + (x - prevX) * 0.4;
                    const controlY1 = prevY;
                    const controlX2 = prevX + (x - prevX) * 0.6;
                    const controlY2 = y;

                    newPath += `C${controlX1} ${controlY1}, ${controlX2} ${controlY2}, ${x} ${y}`;
                } else {
                    newPath += `L${x} ${y}`;
                }
            }

            newPath += `L${width} ${height / 2}`;
            path.setAttribute("d", newPath);
            requestAnimationFrame(updateVisualization);
        }

        // Mulai visualisasi saat audio diputar
        audio.addEventListener("play", () => {
            audioContext.resume().then(() => {
                updateVisualization();
            });
        });

        // Bersihkan SVG saat jendela diubah ukurannya
        window.addEventListener("resize", () => {
            path.setAttribute("d", "");
        });
    }
});

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