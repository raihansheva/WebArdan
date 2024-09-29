// audio spectrum
const content = document.querySelector(".content"),
    Playimage = content.querySelector(".music-image img"),
    musicName = content.querySelector(".music-titles .name"),
    musicArtist = content.querySelector(".music-titles .artist"),
    Audio = document.querySelector(".main-song"),
    playBtn = document.querySelectorAll('.play-pause, .play-pause-mobile, .btn-play-streaming'), // Mengambil semua tombol play
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
playBtn.forEach(button => {
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
    playBtn.forEach(button => {
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
// ----------------------------------------------


// caraousel program
const tombolKiri = document.querySelector('.tombol-kiri');
const tombolKanan = document.querySelector('.tombol-kanan');
const areaContentBox = document.querySelector('.area-content-box-program');

const getScrollAmount = () => {
    if (window.matchMedia("(max-width: 480px)").matches) {
        return 360; 
    } else if (window.matchMedia("(max-width: 768px)").matches) {
        return 340;
    } else if (window.matchMedia("(max-width: 1024px)").matches) {
        return 310; 
    } else {
        return 330; 
    }
};

tombolKiri.addEventListener('click', () => {
    areaContentBox.scrollBy({
        left: -getScrollAmount(),
        behavior: 'smooth' 
    });
});

tombolKanan.addEventListener('click', () => {
    areaContentBox.scrollBy({
        left: getScrollAmount(), 
        behavior: 'smooth'
    });
});
// ---------------------------------------

// carousel announcer
const tombolKiriA = document.querySelector('.tombol-kiri-announcer');
const tombolKananA = document.querySelector('.tombol-kanan-announcer');
const areaContentBoxA = document.querySelector('.area-content-box-announcer');

const getScrollAmountA = () => {
    if (window.matchMedia("(max-width: 480px)").matches) {
        return 358;
    } else if (window.matchMedia("(max-width: 768px)").matches) {
        return 232; 
    } else if (window.matchMedia("(max-width: 1024px)").matches) {
        return 240; 
    } else {
        return 330;
    }
};


tombolKiriA.addEventListener('click', () => {
    areaContentBoxA.scrollBy({
        left: -getScrollAmountA(), 
        behavior: 'smooth'
    });
});

tombolKananA.addEventListener('click', () => {
    areaContentBoxA.scrollBy({
        left: getScrollAmountA(),
        behavior: 'smooth'
    });
});
// ----------------------------------------

// countdown event
const daysElement = document.getElementById('days');
const hoursElement = document.getElementById('hours');
const minutesElement = document.getElementById('minutes');
const secondsElement = document.getElementById('seconds');

const countdownDate = new Date('2024-10-5 23:59:59').getTime();

function updateCountdown() {
    const now = new Date().getTime();
    const timeRemaining = countdownDate - now;

    const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
    const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

    daysElement.innerText = days < 10 ? '0' + days : days;
    hoursElement.innerText = hours < 10 ? '0' + hours : hours;
    minutesElement.innerText = minutes < 10 ? '0' + minutes : minutes;
    secondsElement.innerText = seconds < 10 ? '0' + seconds : seconds;

    if (timeRemaining < 0) {
        clearInterval(countdownInterval);
        daysElement.innerText = "00";
        hoursElement.innerText = "00";
        minutesElement.innerText = "00";
        secondsElement.innerText = "00";
        alert('Countdown selesai!');
    }
}

const countdownInterval = setInterval(updateCountdown, 1000);
// ---------------------------------------


// card-streaming
const cardA = document.querySelector('.card-A');
const cardB = document.querySelector('.card-B');
const tontonSiaranBtnA = document.querySelector('.card-A .author');
const tontonSiaranBtnB = document.querySelector('.card-B .view-B');

cardA.style.display = 'block';
cardA.classList.add('show');

function showCard(card) {
    card.style.display = 'block';
    setTimeout(() => {
        card.classList.add('show');
        card.classList.remove('hide');
    }, 10);
}

function hideCard(card) {
    card.classList.remove('show');
    card.classList.add('hide');
    setTimeout(() => {
        card.style.display = 'none';
    }, 500);
}

tontonSiaranBtnA.addEventListener('click', function() {
    hideCard(cardA); 
    setTimeout(() => {
        showCard(cardB);
    }, 500);
});

tontonSiaranBtnB.addEventListener('click', function() {
    hideCard(cardB); 
    setTimeout(() => {
        showCard(cardA);
    }, 500); 
});

// youtube-player
var tag = document.createElement("script");
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName("script")[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    var player;
    var playlistID = document
      .getElementById("player")
      .getAttribute("data-pl");

    function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
            height: '360',
            width: '640',
            playerVars: {
                'listType': 'playlist',
                'list': playlistID
            },
            events: {
                'onReady': onPlayerReady
            }
        });
    }

    function onPlayerReady(event) {
        event.target.playVideo();
    }



