const musicNameStreaming = content.querySelector(".music-titles .name"),
    musicArtistStreaming = content.querySelector(".music-titles .artist"),
    AudioStreaming = document.querySelector(".main-song-streaming"),
    playBtnStreaming = document.querySelectorAll(
        ".play-pause, .btn-play-streaming"
    );

// Global Variables
let isStreamingPlaying = false;
let lastStreamingSrc = null;

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

    window.playStreaming = function () {
        if (!isStreamingPlaying) {
            AudioStreaming.play()
                .then(() => {
                    stopChartAudio(); // Pastikan audio chart dihentikan
                    isStreamingPlaying = true;
                    updatePlayPauseButtonState();
                })
                .catch((error) => console.error("Error playing streaming audio:", error));
        }
    };

    window.pauseStreaming = function () {
        if (isStreamingPlaying) {
            AudioStreaming.pause();
            isStreamingPlaying = false;
            updatePlayPauseButtonState();
        }
    };

    function updatePlayPauseButtonState() {
        document.querySelectorAll(".btn-play-streaming, .play-pause").forEach((button) => {
            const icon = button.querySelector("span");
            if (isStreamingPlaying || !AudioStreaming.paused) {
                icon.textContent = "pause"; // Menampilkan ikon pause
            } else {
                icon.textContent = "play_arrow"; // Menampilkan ikon play
            }
        });
    }

    function stopChartAudio() {
        if (currentChartId) {
            playStatus[currentChartId] = { isPlaying: false };
            currentChartId = null;
        }
        updatePlayPauseButtonState();
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
                AudioStreaming.src = streamingSrc;
                AudioStreaming.crossOrigin = "anonymous";
                lastStreamingSrc = streamingSrc;
                AudioStreaming.load();

                AudioStreaming.oncanplay = () => {
                    musicNameStreaming.innerHTML = streamName;
                    musicArtistStreaming.innerHTML = streamArtist;
                    playStreaming();
                };
            } else {
                pauseStreaming();
            }
        } else {
            console.error("Streaming source not found.");
        }
    }

    document.querySelectorAll(".play-pause").forEach((button) => {
        button.addEventListener("click", toggleStreaming);
    });
});


// ----------------------------
// progress bar
// ----------------------------

// Update progress bar based on audio time update
// AudioStreaming.addEventListener("timeupdate", () => {
//     if (AudioStreaming.duration) {
//         const progressPercent = (AudioStreaming.currentTime / AudioStreaming.duration) * 100;
//         progressBar.style.width = `${progressPercent}%`; // Update progress bar width
//         // updateAudioTimeDisplay();
//     }
// });

// // Seek functionality: Jump to clicked position on progress bar
// progressDetails.addEventListener("click", (event) => {
//     const clickPosition = event.offsetX / progressDetails.clientWidth;
//     AudioStreaming.currentTime = clickPosition * AudioStreaming.duration;
// });
// ----------------------------
// Spectrum Audio Visualization
const svgStreaming = document.getElementById("visual");
const audioStreaming = AudioStreaming;
const pathStreaming = svgStreaming.querySelector("#layer1");

const audioContextStreaming = new (window.AudioContext || window.webkitAudioContext)();
const analyserStreaming = audioContextStreaming.createAnalyser();
analyserStreaming.fftSize = 2048;
const bufferLengthStreaming = analyserStreaming.frequencyBinCount;
const dataArrayStreaming = new Uint8Array(bufferLengthStreaming);

const sourceStreaming = audioContextStreaming.createMediaElementSource(audioStreaming);
sourceStreaming.connect(analyserStreaming);
analyserStreaming.connect(audioContextStreaming.destination);

function updateVisualizationStreaming() {
    analyserStreaming.getByteFrequencyData(dataArrayStreaming);

    const widthStreaming = svgStreaming.clientWidth;
    const heightStreaming = svgStreaming.clientHeight;

    const numPointsStreaming = 7; // Jumlah titik yang ditampilkan
    const stepStreaming = widthStreaming / (numPointsStreaming - 1);

    const waveHeightStreaming = heightStreaming / 1.5; // Tinggi gelombang, dapat diatur sesuai kebutuhan

    let newPathStreaming = `M0 ${heightStreaming / 2}`;

    for (let i = 1; i < numPointsStreaming; i++) {
        const indexStreaming = Math.floor(i * (bufferLengthStreaming / numPointsStreaming));
        const amplitudeStreaming = dataArrayStreaming[indexStreaming] || 0;
        const scaledAmplitudeStreaming = (amplitudeStreaming / 255) * waveHeightStreaming; // Menggunakan waveHeightStreaming

        const xStreaming = i * stepStreaming;
        const yStreaming = heightStreaming / 2 - scaledAmplitudeStreaming;

        if (i > 0) {
            const prevXStreaming = (i - 1) * stepStreaming;
            const prevYStreaming =
                heightStreaming / 2 -
                ((dataArrayStreaming[Math.floor((i - 1) * (bufferLengthStreaming / numPointsStreaming))] ||
                    0) /
                    255) *
                    waveHeightStreaming; // Menggunakan waveHeightStreaming

            // Menghitung kontrol titik untuk kurva Bezier
            const controlX1Streaming = prevXStreaming + (xStreaming - prevXStreaming) * 0.4;
            const controlY1Streaming = prevYStreaming;
            const controlX2Streaming = prevXStreaming + (xStreaming - prevXStreaming) * 0.6;
            const controlY2Streaming = yStreaming;

            // Menambahkan kurva Bezier
            newPathStreaming += `C${controlX1Streaming} ${controlY1Streaming}, ${controlX2Streaming} ${controlY2Streaming}, ${xStreaming} ${yStreaming}`;
        } else {
            newPathStreaming += `L${xStreaming} ${yStreaming}`;
        }
    }

    newPathStreaming += `L${widthStreaming} ${heightStreaming / 2}`;
    pathStreaming.setAttribute("d", newPathStreaming);
    requestAnimationFrame(updateVisualizationStreaming);
}

audioStreaming.addEventListener("play", () => {
    audioContextStreaming.resume().then(() => {
        updateVisualizationStreaming();
    });
});

window.addEventListener("resize", () => {
    pathStreaming.setAttribute("d", "");
});
