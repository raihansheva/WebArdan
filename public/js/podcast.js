

document.getElementById('toggleBtn').addEventListener('click', function() {
    // Ambil semua card
    const cards = document.querySelectorAll('.card-podcast');
    // Cek teks tombol saat ini
    const isSeeMore = this.textContent === 'See more';

    if (isSeeMore) {
        // Tampilkan semua card jika tombol "See more"
        cards.forEach(card => {
            card.style.display = 'block';
        });
        // Ubah teks tombol menjadi "See less"
        this.textContent = 'See less';
    } else {
        // Sembunyikan semua card kecuali 6 pertama jika tombol "See less"
        cards.forEach((card, index) => {
            card.style.display = index < 6 ? 'block' : 'none';
        });
        // Ubah teks tombol menjadi "See more"
        this.textContent = 'See more';
    }
});

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