<div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mediaelement@4.2.7/build/mediaelementplayer.min.css">
    <!-- Tombol Play/Pause -->
    <div class="btn-play-streaming" id="BtnStream" data-audio-src="https://stream.rcs.revma.com/ugpyzu9n5k3vv">
        <span class="material-symbols-rounded">play_arrow</span>
    </div>

    <!-- Elemen Audio -->
    <audio class="audio-streaming" id="audio-streaming" preload="auto" crossorigin="anonymous">
        <source type="audio/mpeg" src="https://stream.rcs.revma.com/ugpyzu9n5k3vv" />
    </audio>

    <script>
        let previousIsStreamingPlaying = null;
        let audioStream = document.getElementById("audio-streaming"); // Ambil elemen audio
        let isStreamingPlaying = false; // Status play/pause
        // Inisialisasi MediaElement.js tanpa kontrol default
        let mediaPlayer = new MediaElementPlayer("audio-streaming", {
            features: [],
            success: function(mediaElement, originalNode) {
                // console.log(originalNode);

                mediaElement.src = "https://stream.rcs.revma.com/ugpyzu9n5k3vv"; // URL proxy
                mediaElement.addEventListener("play", function() {
                    isStreamingPlaying = true;
                    startSpectrumAudio(AudioStream);
                    updatePlayPauseButtonStateS();
                });

                mediaElement.addEventListener("pause", function() {
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
                pauseStreaming();
            } else {
                musicName.innerHTML = "Streaming Audio"; // Atur nama audio
                musicArtist.innerHTML = "Live Stream"; // Atur artis audio
                playStreaming();
            }
        }

        // Fungsi untuk memutar audio streaming
        window.playStreaming = function() {
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
                // isStreamingPlaying = true;

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
            const currentTime = parseFloat(localStorage.getItem("audioCurrentTime")) || 0;

            // Jika audio tidak dalam keadaan pause, lanjutkan pemutaran
            if (!isPaused) {
                audioStream.currentTime = currentTime;
                audioStream
                    .play()
                    .catch((err) => console.error("Gagal memutar audio:", err));

                // Tentukan nama audio dan artis
                musicName.innerHTML = "Streaming Audio";
                musicArtist.innerHTML = "Live Stream";
            }

            // Simpan status audio sebelum halaman ditutup atau berpindah
            window.addEventListener("beforeunload", () => {
                // Menyimpan status audio (apakah sedang dipause) dan waktu pemutaran ke localStorage
                localStorage.setItem("audioPaused", audioStream.paused);
                localStorage.setItem("audioCurrentTime", audioStream.currentTime);
            });
        }


        // Fungsi untuk menjeda audio streaming
        window.pauseStreaming = function() {
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
                        icon.textContent = isStreamingPlaying ?
                            "pause" :
                            "play_arrow";
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
                playPauseBtn.addEventListener("click", toggleStreaming);
            }
        }, 100); // Periksa setiap 100ms untuk elemen yang tersedia
    </script>
</div>
