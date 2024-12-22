// carousel card podcast
const tombolKiriOP = document.querySelector(".tombol-kiri-OP");
const tombolKananOP = document.querySelector(".tombol-kanan-OP");
const areaContentBoxOP = document.querySelector(".area-content-card-OP");
const textidP = document.getElementById("idP");
const idP = textidP.textContent;

const getScrollAmountA = () => {
    if (window.matchMedia("(max-width: 375px)").matches) {
        return 316;
    } else if (window.matchMedia("(max-width: 480px)").matches) {
        return 365;
    } else if (window.matchMedia("(max-width: 768px)").matches) {
        return 350;
    } else if (window.matchMedia("(max-width: 1024px)").matches) {
        return 400;
    } else {
        return 480;
    }
};

tombolKiriOP.addEventListener("click", () => {
    areaContentBoxOP.scrollBy({
        left: -getScrollAmountA(),
        behavior: "smooth",
    });
});

tombolKananOP.addEventListener("click", () => {
    areaContentBoxOP.scrollBy({
        left: getScrollAmountA(),
        behavior: "smooth",
    });
});
// -------------------------------

const cardA = document.querySelector(".card-DP");
const cardB = document.querySelector(".card-DP-B");
const tontonSiaranBtnA = document.querySelector(".card-DP .DP-view");
const tontonSiaranBtnB = document.querySelector(".card-DP-B .view-DP-B");

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
    pausePodcast(idP)
    setTimeout(() => {
        showCard(cardB);
    }, 500);
});

tontonSiaranBtnB.addEventListener("click", function () {
    hideCard(cardB);
    setTimeout(() => {
        playPodcast(idP);
        showCard(cardA);
    }, 500);
});

// Load YouTube API
// var tag = document.createElement("script");
// tag.src = "https://www.youtube.com/iframe_api";
// var firstScriptTag = document.getElementsByTagName("script")[0];
// firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

// var player;
// var playlistID = document.getElementById("player-podcast").getAttribute("data-pl");

// function onYouTubeIframeAPIReady() {
//     player = new YT.Player("player-podcast", {
//         height: "800",
//         width: "640",
//         playerVars: {
//             listType: "playlist",
//             list: playlistID, // Playlist ID yang diambil dari atribut data
//         },
//         events: {
//             onReady: onPlayerReady,
//         },
//     });
// }

// Menambahkan thumbnail YouTube secara dinamis di belakang tombol play
document.querySelectorAll('.box-video, .box-video-mid').forEach(videoBox => {
    const videoId = videoBox.getAttribute('data-video-id');
    
    if (videoId) {
        // Membuat elemen img untuk thumbnail
        const thumbnailImg = document.createElement('img');
        thumbnailImg.classList.add('video-thumbnail');
        thumbnailImg.src = `https://img.youtube.com/vi/${videoId}/hqdefault.jpg`;
        thumbnailImg.alt = "Thumbnail";
        
        // Menyisipkan thumbnail ke dalam box-video atau box-video-mid
        videoBox.prepend(thumbnailImg);
    }
});

// Callback ketika player siap
function onPlayerReady(event) {
    // Anda dapat menambahkan logika tambahan saat player siap, jika diperlukan
}

const cards = document.querySelectorAll('.card-episode');
const seeMoreText = document.getElementById('toggleSeeMore');
let isExpanded = false;

function toggleCards() {
    if (isExpanded) {
        cards.forEach((card, index) => {
            if (index >= 4) card.classList.remove('visible');
        });
        seeMoreText.textContent = 'See more';
    } else {
        cards.forEach(card => card.classList.add('visible'));
        seeMoreText.textContent = 'See less';
    }
    isExpanded = !isExpanded;
}

function handleResize() {
    if (window.innerWidth <= 480) {
        cards.forEach((card, index) => {
            if (index < 4) card.classList.add('visible');
            else card.classList.remove('visible');
        });
        seeMoreText.style.display = cards.length > 4 ? 'block' : 'none';
    } else {
        // Reset state if window is larger than 480px
        cards.forEach(card => card.classList.add('visible'));
        seeMoreText.style.display = 'none';
        isExpanded = false;
        seeMoreText.textContent = 'See more';
    }
}

// Initial setup
handleResize();

// Add event listener for window resize
window.addEventListener('resize', handleResize);

// Add event listener for see more/see less toggle
seeMoreText.addEventListener('click', toggleCards);

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
        var popupContent = document.querySelector(".popup-content-yt");

        // Jika user klik di luar area .popup-content, tutup popup
        if (!popupContent.contains(event.target)) {
            hidePopup();
        }
    });


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

//     // Tombol "Dengar Siaran"
//     tontonSiaranBtnB.addEventListener("click", function () {
//         hideCard(cardB);
//         // Hentikan video
//         if (!video.paused) {
//             video.pause();
//             video.currentTime = 0; // Reset video ke awal
//         }
//         setTimeout(() => {
//             showCard(cardA);
//         }, 500);
//     });
// });