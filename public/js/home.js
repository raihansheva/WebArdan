// audio spectrum
const content = document.querySelector(".content"),
    Playimage = content.querySelector(".music-image img"),
    musicName = content.querySelector(".music-titles .name"),
    musicArtist = content.querySelector(".music-titles .artist"),
    Audio = document.querySelector(".main-song"),
    playBtn = content.querySelector(".play-pause"),
    playBtnIcon = content.querySelector(".play-pause span"),
    prevBtn = content.querySelector("#prev"),
    nextBtn = content.querySelector("#next"),
    progressBar = content.querySelector(".progress-bar"),
    progressDetails = content.querySelector(".progress-details"),
    repeatBtn = content.querySelector("#repeat"),
    Shuffle = content.querySelector("#shuffle");

let index = 1;

window.addEventListener("load", () => {
    loadData(index);
});

function loadData(indexValue) {
    musicName.innerHTML = songs[indexValue - 1].name;
    musicArtist.innerHTML = songs[indexValue - 1].artist;
    Playimage.src = "images/" + songs[indexValue - 1].img + ".jpg";
    Audio.src = "music/" + songs[indexValue - 1].audio + ".mp3";
}

playBtn.addEventListener("click", () => {
    const isMusicPaused = content.classList.contains("paused");
    if (isMusicPaused) {
        pauseSong();
    } else {
        playSong();
    }
});

function playSong() {
    content.classList.add("paused");
    playBtnIcon.innerHTML = "pause";
    Audio.play();
}

function pauseSong() {
    content.classList.remove("paused");
    playBtnIcon.innerHTML = "play_arrow";
    Audio.pause();
}

nextBtn.addEventListener("click", () => {
    nextSong();
});

prevBtn.addEventListener("click", () => {
    prevSong();
});

function nextSong() {
    index++;
    if (index > songs.length) {
        index = 1;
    } else {
        index = index;
    }
    loadData(index);
    playSong();
}

function prevSong() {
    index--;
    if (index <= 0) {
        index = songs.length;
    } else {
        index = index;
    }
    loadData(index);
    playSong();
}

Audio.addEventListener("timeupdate", (e) => {
    const initialTime = e.target.currentTime; // Get current music time
    const finalTime = e.target.duration; // Get music duration
    let BarWidth = (initialTime / finalTime) * 100;
    progressBar.style.width = BarWidth + "%";

    progressDetails.addEventListener("click", (e) => {
        let progressValue = progressDetails.clientWidth; // Get width of Progress Bar
        let clickedOffsetX = e.offsetX; // get offset x value
        let MusicDuration = Audio.duration; // get total music duration

        Audio.currentTime = (clickedOffsetX / progressValue) * MusicDuration;
    });

    //Timer Logic
    // Audio.addEventListener("loadeddata", () => {
    //   let finalTimeData = content.querySelector(".final");

    //   //Update finalDuration
    //   let AudioDuration = Audio.duration;
    //   let finalMinutes = Math.floor(AudioDuration / 60);
    //   let finalSeconds = Math.floor(AudioDuration % 60);
    //   if (finalSeconds < 10) {
    //     finalSeconds = "0" + finalSeconds;
    //   }
    //   finalTimeData.innerText = finalMinutes + ":" + finalSeconds;
    // });

    // //Update Current Duration
    // let currentTimeData = content.querySelector(".current");
    // let CurrentTime = Audio.currentTime;
    // let currentMinutes = Math.floor(CurrentTime / 60);
    // let currentSeconds = Math.floor(CurrentTime % 60);
    // if (currentSeconds < 10) {
    //   currentSeconds = "0" + currentSeconds;
    // }
    // currentTimeData.innerText = currentMinutes + ":" + currentSeconds;

    // //repeat button logic
    // repeatBtn.addEventListener("click", () => {
    //   Audio.currentTime = 0;
    // });
});

//Shuffle Logic
// Shuffle.addEventListener("click", () => {
//   var randIndex = Math.floor(Math.random() * songs.length) + 1; // Select random betwn 1 and song array length
//   loadData(randIndex);
//   playSong();
// });

Audio.addEventListener("ended", () => {
    index++;
    if (index > songs.length) {
        index = 1;
    }
    loadData(index);
    playSong();
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

    const numPoints = 7;
    const step = width / (numPoints - 1);

    let newPath = `M0 ${height / 2}`;

    for (let i = 1; i < numPoints; i++) {
        const index = Math.floor(i * (bufferLength / numPoints));
        const amplitude = dataArray[index] || 0;
        const scaledAmplitude = (amplitude / 255) * (height / 2);

        const x = i * step;
        const y = height / 2 - scaledAmplitude;

        if (i > 0) {
            const prevX = (i - 1) * step;
            const prevY =
                height / 2 -
                ((dataArray[Math.floor((i - 1) * (bufferLength / numPoints))] ||
                    0) /
                    255) *
                    (height / 2);

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

audio.addEventListener("play", () => {
    audioContext.resume().then(() => {
        updateVisualization();
    });
});

window.addEventListener("resize", () => {
    path.setAttribute("d", "");
});

// caraousel program
const tombolKiri = document.querySelector('.tombol-kiri');
const tombolKanan = document.querySelector('.tombol-kanan');
const areaContentBox = document.querySelector('.area-content-box-program');

// Menggeser ke kiri
tombolKiri.addEventListener('click', () => {
    areaContentBox.scrollBy({
        left: -330, // Geser 300px ke kiri
        behavior: 'smooth' // Animasi smooth saat menggeser
    });
});

// Menggeser ke kanan
tombolKanan.addEventListener('click', () => {
    areaContentBox.scrollBy({
        left: 330, // Geser 300px ke kanan
        behavior: 'smooth' // Animasi smooth saat menggeser
    });
});


// timer
// Mengambil elemen HTML
const daysElement = document.getElementById('days');
const hoursElement = document.getElementById('hours');
const minutesElement = document.getElementById('minutes');
const secondsElement = document.getElementById('seconds');

// Atur tanggal dan waktu target (format: 'YYYY-MM-DD HH:MM:SS')
const countdownDate = new Date('2024-10-5 23:59:59').getTime();

// Fungsi untuk memperbarui countdown setiap detik
function updateCountdown() {
    const now = new Date().getTime();
    const timeRemaining = countdownDate - now;

    // Hitung jumlah hari, jam, menit, dan detik yang tersisa
    const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
    const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

    // Tampilkan hasil ke elemen HTML
    daysElement.innerText = days < 10 ? '0' + days : days;
    hoursElement.innerText = hours < 10 ? '0' + hours : hours;
    minutesElement.innerText = minutes < 10 ? '0' + minutes : minutes;
    secondsElement.innerText = seconds < 10 ? '0' + seconds : seconds;

    // Jika waktu sudah habis, tampilkan pesan
    if (timeRemaining < 0) {
        clearInterval(countdownInterval);
        daysElement.innerText = "00";
        hoursElement.innerText = "00";
        minutesElement.innerText = "00";
        secondsElement.innerText = "00";
        alert('Countdown selesai!');
    }
}

// Memperbarui countdown setiap 1 detik (1000 ms)
const countdownInterval = setInterval(updateCountdown, 1000);


