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
const audioSourceMap = new Map();

document.addEventListener("DOMContentLoaded", function () {
    let previousIsStreamingPlaying = null;
    let audioStream = document.getElementById("audio-streaming"); // Ambil elemen audio
    let isStreamingPlaying = false; // Status play/pause
    // Inisialisasi MediaElement.js tanpa kontrol default
    let mediaPlayer = new MediaElementPlayer("audio-streaming", {
        features: [],
        success: function (mediaElement, originalNode) {
            // console.log(originalNode);

            mediaElement.src = "https://stream.rcs.revma.com/ugpyzu9n5k3vv"; // URL proxy
            mediaElement.addEventListener("play", function () {
                isStreamingPlaying = true;
                startSpectrumAudio(AudioStream);
                updatePlayPauseButtonStateS();
            });

            mediaElement.addEventListener("pause", function () {
                isStreamingPlaying = false;
                updatePlayPauseButtonStateS();
            });
        },
    });

    // Jika Anda ingin menambahkan pengendalian play/pause manual
    // document.getElementById("BtnStream").addEventListener("click", function () {
    //     // Dapatkan elemen audio
    //     let audioStream = document.getElementById("audio-streaming");

    //     // Jika audio sedang diputar, hentikan. Jika berhenti, mulai memutar.
    //     if (isStreamingPlaying) {
    //         audioStream.pause(); // Menghentikan pemutaran
    //     } else {
    //         musicName.innerHTML = "Streaming Audio"; // Atur nama audio
    //         musicArtist.innerHTML = "Live Stream"; // Atur artis audio
    //         audioStream.play(); // Memulai pemutaran
    //     }
    // });

    // Fungsi untuk toggle play/pause pada audio streaming
    function toggleStreaming() {
        if (activeAudioSource !== "streaming") {
            stopActiveAudio(); // Hentikan audio lain
            activeAudioSource = "streaming"; // Set audio aktif ke streaming
        }

        if (isStreamingPlaying) {
            console.log("halooo ini pause dari audio floating");

            pauseStreaming();
        } else {
            musicName.innerHTML = "Streaming Audio"; // Atur nama audio
            musicArtist.innerHTML = "Live Stream"; // Atur artis audio
            playStreaming();
        }
    }

    // Fungsi untuk memutar audio streaming
    window.playStreaming = function () {
        let audioStream = document.getElementById("audio-streaming");

        if (!audioStream) {
            console.error("Audio element not found");
            return;
        }

        if (activeAudioSource !== "streaming") {
            stopActiveAudio(); // Hentikan audio lain
            activeAudioSource = "streaming";
        }

        const playPauseBtnC = document.querySelector(".play-pause-chart");
        if (playPauseBtnC) playPauseBtnC.style.display = "none";

        const playPauseBtnP = document.querySelector(".play-pause-podcast");
        if (playPauseBtnP) playPauseBtnP.style.display = "none";

        const playPauseBtnS = document.querySelector(".play-pause-stream");
        if (playPauseBtnS) playPauseBtnS.style.display = "block";

        // Jika audio belum dimainkan, langsung mainkan
        if (!isStreamingPlaying) {
            audioStream.play();
            isStreamingPlaying = true;

            // updatePlayPauseButtonStateS();
            // console.error("Error playing streaming audio:", error);
            // alert("Failed to play audio: " + error);
        }

        startSpectrumAudio(AudioStream);
        // proggresBarAudio(audioStream);
    };

    if (audioStream) {
        // Cek status audio dari localStorage
        const isPaused = localStorage.getItem("audioPaused") === "true";
        const currentTime =
            parseFloat(localStorage.getItem("audioCurrentTime")) || 0;

        // Jika audio tidak dalam keadaan pause, lanjutkan pemutaran
        if (!isPaused) {
            audioStream.currentTime = currentTime;
            audioStream
                .play()
                .catch((err) => console.error("Gagal memutar audio:", err));
            isStreamingPlaying = true;
            // Tentukan nama audio dan artis
            musicName.innerHTML = "Streaming Audio";
            musicArtist.innerHTML = "Live Stream";

            startSpectrumAudio(audioStream);
        }

        // Simpan status audio sebelum halaman ditutup atau berpindah
        window.addEventListener("beforeunload", () => {
            // Menyimpan status audio (apakah sedang dipause) dan waktu pemutaran ke localStorage
            localStorage.setItem("audioPaused", audioStream.paused);
            localStorage.setItem("audioCurrentTime", audioStream.currentTime);
        });
    }

    // Fungsi untuk menjeda audio streaming
    window.pauseStreaming = function () {
        let audioStream = document.getElementById("audio-streaming");
        audioStream.pause(); // Jeda audio streaming
        activeAudioSource = null; // Hapus status sumber aktif
        isStreamingPlaying = false;
        updatePlayPauseButtonStateS(); // Perbarui status tombol play/pause
    };

    // Memperbarui status tombol play/pause
    function updatePlayPauseButtonStateS() {
        if (isStreamingPlaying !== previousIsStreamingPlaying) {
            const playPauseButtons = document.querySelectorAll(
                ".btn-play-streaming , .play-pause-stream"
            );

            playPauseButtons.forEach((button) => {
                const icon = button.querySelector("span");
                if (icon) {
                    icon.textContent = isStreamingPlaying
                        ? "pause"
                        : "play_arrow";
                }
            });

            previousIsStreamingPlaying = isStreamingPlaying;
        }
    }

    // Event listener untuk tombol play/pause
    document.querySelectorAll(".btn-play-streaming").forEach((button) => {
        button.addEventListener("click", () => {
            let audioStream = document.getElementById("audio-streaming");

            // Jika audio sedang diputar, hentikan. Jika berhenti, mulai memutar.
            if (isStreamingPlaying) {
                pauseStreaming();
            } else {
                musicName.innerHTML = "Streaming Audio"; // Atur nama audio
                musicArtist.innerHTML = "Live Stream"; // Atur artis audio
                playStreaming();
                // startSpectrumAudio(AudioStream)
            }
        });
    });

    // Event listener untuk tombol umum play/pause
    const intervalId = setInterval(() => {
        const playPauseBtn = document.querySelector(".play-pause-stream");
        if (playPauseBtn) {
            clearInterval(intervalId);
            playPauseBtn.addEventListener("click", () => {
                if (isStreamingPlaying) {
                    pauseStreaming();
                } else {
                    musicName.innerHTML = "Streaming Audio"; // Atur nama audio
                    musicArtist.innerHTML = "Live Stream"; // Atur artis audio
                    playStreaming();
                    // startSpectrumAudio(AudioStream)
                }
            });
        }
    }, 100); // Periksa setiap 100ms untuk elemen yang tersedia

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
        const playPauseChart = document.querySelector(".play-pause-chart");
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

        const playPauseBtnS = document.querySelector(".play-pause-chart");
        playPauseBtnS.style.display = "block";

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
        // const playPauseBtnS = document.querySelector(".play-pause-chart");
        // playPauseBtnS.style.display = "none";
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
                const playPauseBtnS =
                    document.querySelector(".play-pause-stream");
                playPauseBtnS.style.display = "none";
            }
            const playPauseBtnS = document.querySelector(".play-pause-stream");
            playPauseBtnS.style.display = "none";

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
        const playPauseBtnChart = document.querySelector(".play-pause-chart");

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
                    console.log("ini harus pausee streaming");
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
    window.playPodcast = function (idP) {
        if (activeAudioSource !== "podcast") {
            stopActiveAudio(); // Hentikan audio lain
            activeAudioSource = "podcast";
        }

        const playPauseBtnP = document.querySelector(".play-pause-podcast");
        playPauseBtnP.style.display = "block";

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
    };

    // Fungsi pause podcast
    window.pausePodcast = function (idP) {
        if (!AudioPodcast.paused) {
            AudioPodcast.pause();
            playPodcastStatus[idP].isPlaying = false;
            updatePodcastPlayButtonState(idP);
        }
    };

    // Update status tombol play/pause
    function updatePodcastPlayButtonState(idP) {
        document
            .querySelectorAll(".btn-play-DP, .play-pause-podcast")
            .forEach((button) => {
                const icon = button.querySelector("span");
                const buttonId = button.getAttribute("data-id");

                if (
                    buttonId === idP ||
                    button.classList.contains("play-pause-podcast")
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
                const playPauseBtnP =
                    document.querySelector(".play-pause-stream");
                playPauseBtnP.style.display = "none";
            }

            const playPauseBtnS = document.querySelector(".play-pause-stream");
            playPauseBtnS.style.display = "none";

            const podcastId = button.getAttribute("data-id");
            if (!playPodcastStatus[podcastId]?.isPlaying) {
                playPodcast(podcastId);
            } else {
                pausePodcast(podcastId);
            }
        });
    });

    const intervalIdPodcast = setInterval(() => {
        const playPauseBtnChart = document.querySelector(".play-pause-podcast");

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
    function stopPodcast() {
        if (!AudioPodcast.paused) {
            AudioPodcast.pause(); // Hentikan audio yang sedang diputar
        }
        playPodcastStatus[currentPodcastId].isPlaying = false; // Reset status
        updatePodcastPlayButtonState(currentPodcastId); // Update status tombol play/pause
    }

    // Event listener untuk tombol next dan prev
    nextBtn.addEventListener("click", () => {
        stopPodcast();
        eps++; // Increment episode number
        loadEpisode(podcastId, eps, "next");
    });

    prevBtn.addEventListener("click", () => {
        stopPodcast();
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
        // const progressDetails = document.querySelector('.progress-details');
        // const progressBar = document.querySelector('.progress-bar');
        let isDragging = false;
        let isUserInteracting = false; // Flag to track user interaction

        // Update progress bar based on current time
        const updateProgressBar = () => {
            if (Audio.duration) {
                const progressPercent =
                    (Audio.currentTime / Audio.duration) * 100;
                progressBar.style.width = `${progressPercent}%`;
            }
        };

        const calculateNewTime = (event) => {
            const rect = progressDetails.getBoundingClientRect();
            const offsetX = event.clientX - rect.left;
            const progress = Math.min(Math.max(offsetX / rect.width, 0), 1);
            return progress * Audio.duration;
        };

        // Event listener untuk klik pada progress bar
        progressDetails.addEventListener("click", (event) => {
            if (Audio.duration) {
                const newTime = calculateNewTime(event);
                console.log("Click - New Time:", newTime);
                Audio.currentTime = newTime; // Set the current time
                updateProgressBar(); // Update the progress bar immediately
            }
        });

        // Event listener untuk mulai drag
        progressDetails.addEventListener("mousedown", (event) => {
            isDragging = true;
            isUserInteracting = true;
            const newTime = calculateNewTime(event);
            console.log("MouseDown - New Time:", newTime);
            Audio.currentTime = newTime; // Set the current time immediately
            updateProgressBar(); // Update the progress bar immediately
        });

        // Event listener untuk drag (mousemove)
        document.addEventListener("mousemove", (event) => {
            if (isDragging && Audio.duration) {
                const newTime = calculateNewTime(event);
                console.log("MouseMove - New Time:", newTime);
                Audio.currentTime = newTime; // Update current time while dragging
                updateProgressBar(); // Update progress bar during dragging
            }
        });

        // Event listener untuk berhenti drag
        document.addEventListener("mouseup", () => {
            if (isDragging) {
                isDragging = false;
                console.log("MouseUp - Dragging Ended");
            }
        });

        // Update progress bar saat timeupdate
        Audio.addEventListener("timeupdate", () => {
            if (!isUserInteracting) {
                updateProgressBar(); // Update progress bar automatically when user is not interacting
            }
        });

        // Reset user interaction flag when audio is paused or ended
        Audio.addEventListener("pause", () => {
            isUserInteracting = false;
        });

        Audio.addEventListener("ended", () => {
            isUserInteracting = false;
        });
    }

    // ----------------------------
    // Spectrum Audio Visualization
    // ----------------------------
    // ----------------------------
    // Spectrum Audio Visualization
    // ----------------------------

    function startSpectrumAudio(audio) {
        if (!(audio instanceof HTMLMediaElement)) {
            console.error("Invalid audio element:", audio);
            return;
        }

        // Ambil atau buat AudioContext
        let audioContext;
        if (!audioSourceMap.has(audio)) {
            audioContext = new (window.AudioContext ||
                window.webkitAudioContext)();
            const source = audioContext.createMediaElementSource(audio);
            const analyser = audioContext.createAnalyser();
            analyser.fftSize = 2048;

            source.connect(analyser);
            analyser.connect(audioContext.destination);

            audioSourceMap.set(audio, { audioContext, analyser });
        } else {
            const audioData = audioSourceMap.get(audio);
            audioContext = audioData.audioContext;
        }

        const { analyser } = audioSourceMap.get(audio);
        const dataArray = new Uint8Array(analyser.frequencyBinCount);

        const svg = document.getElementById("visual");
        const path = svg.querySelector("#layer1");

        function updateVisualization() {
            analyser.getByteFrequencyData(dataArray);

            const width = svg.clientWidth;
            const height = svg.clientHeight;

            const numPoints = 7;
            const step = width / (numPoints - 1);
            const waveHeight = height / 1.5;

            let newPath = `M0 ${height / 2}`;
            for (let i = 1; i < numPoints; i++) {
                const index = Math.floor(i * (dataArray.length / numPoints));
                const amplitude = dataArray[index] || 0;
                const scaledAmplitude = (amplitude / 255) * waveHeight;

                const x = i * step;
                const y = height / 2 - scaledAmplitude;

                if (i > 0) {
                    const prevX = (i - 1) * step;
                    const prevY =
                        height / 2 -
                        ((dataArray[
                            Math.floor((i - 1) * (dataArray.length / numPoints))
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

        audio.addEventListener("play", () => {
            audioContext.resume().then(() => {
                updateVisualization();
            });
        });

        audio.addEventListener("pause", () => {
            path.setAttribute("d", ""); // Reset visualisasi saat pause
        });

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
    const img = document.getElementById("image");

    const currentPage = window.location.pathname;

    if (currentPage.includes("detail-podcast")) {
        prevButton.style.display = "flex";
        nextButton.style.display = "flex";
    } else {
        prevButton.style.display = "none";
        nextButton.style.display = "none";
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
    if (!event.target.matches(".arrow-down , .dropText")) {
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
        mobileMenu.classList.toggle("nyala");
    });

const closeMenu = document.getElementById("close-menu") || null;

// Close the mobile menu on close icon click
if (closeMenu) {
    closeMenu.addEventListener("click", function () {
        const mobileMenu = document.getElementById("mobile-menu");
        if (mobileMenu) {
            mobileMenu.classList.remove("nyala");
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
        mobileMenu.classList.contains("nyala")
    ) {
        // console.log("Closing mobile menu");
        mobileMenu.classList.remove("nyala");
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

    // Ambil atribut dari elemen yang diklik
    const description = element.getAttribute("data-description");
    const date = element.getAttribute("data-date");
    const slug = element.getAttribute("data-slug");
    const deskShort = element.getAttribute("data-deskShort");

    console.log("Deskripsi:", description);
    console.log("Tanggal:", date);
    console.log("Slug :", slug);
    console.log("deskShort :", deskShort);

    // Update konten pop-up
    document.querySelector(".desk-event").textContent =
        description || "Deskripsi tidak tersedia";
    document.querySelector(".title-box-event").textContent =
        date || "Tanggal tidak tersedia";

    const detailLink = document.querySelector(".detail-link");

    if (description) {
        // Tampilkan detailLink jika deskShort ada
        detailLink.style.display = "block";
        detailLink.href = `/detail-event/${slug}`; // Update URL sesuai dengan slug
    } else {
        // Sembunyikan detailLink jika deskShort tidak ada
        detailLink.style.display = "none";
    }
}

function closePopupEvent() {
    const popupEvent = document.getElementById("popupEvent");
    popupEvent.classList.remove("muncul");
    popupEvent.classList.add("tutup");
    popupEvent.style.display = "none";
    popupEvent.classList.remove("tutup");
}

function closePopupOutsideEvent(event) {
    if (event.target.id === "popupEvent") {
        closePopupEvent();
    }
}

// -----------
