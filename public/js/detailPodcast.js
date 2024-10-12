// carousel card podcast
const tombolKiriOP = document.querySelector(".tombol-kiri-OP");
const tombolKananOP = document.querySelector(".tombol-kanan-OP");
const areaContentBoxOP = document.querySelector(".area-content-card-OP");

const getScrollAmountA = () => {
    if (window.matchMedia("(max-width: 480px)").matches) {
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
const tontonSiaranBtnA = document.querySelector(".card-DP .DP-author");
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
    setTimeout(() => {
        showCard(cardB);
    }, 500);
});

tontonSiaranBtnB.addEventListener("click", function () {
    hideCard(cardB);
    setTimeout(() => {
        showCard(cardA);
    }, 500);
});

// Load YouTube API
var tag = document.createElement("script");
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName("script")[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

var player;
var playlistID = document.getElementById("player-podcast").getAttribute("data-pl");

function onYouTubeIframeAPIReady() {
    player = new YT.Player("player-podcast", {
        height: "800",
        width: "640",
        playerVars: {
            listType: "playlist",
            list: playlistID, // Playlist ID yang diambil dari data attribute
        },
        events: {
            onReady: onPlayerReady,
        },
    });
}

function onPlayerReady(event) {
    // Autoplay dinonaktifkan untuk sementara
    // event.target.playVideo(); 
}


