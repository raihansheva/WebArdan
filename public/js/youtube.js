// Menyimpan referensi elemen
const dropdownBtn = document.getElementById("dropdown-btn-playlist");
const playlistDropdown = document.getElementById("playlist-dropdown");
const container = document.querySelector(".video--container");

// Fungsi untuk mengambil video berdasarkan ID playlist yang dipilih
function fetchVideosByPlaylist(playlistId) {
    // Clear existing videos in the container
    container.innerHTML = ""; 

    fetch(`https://youtube.googleapis.com/youtube/v3/playlistItems?part=snippet%2CcontentDetails&maxResults=10&playlistId=${playlistId}&key=${apiKey}`)
        .then(response => response.json())
        .then(data => {
            const videos = data.items;

            // Clone placeholders for each video
            videos.forEach((video, index) => {
                const videoId = video.contentDetails.videoId;

                if (!videoId) {
                    console.error("Video ID not found for:", video);
                    return;
                }

                const clone = placeholder.cloneNode(true);
                clone.id = `template__${index}`; // Use index for unique ID
                container.appendChild(clone); // Append clone to the container

                // Fetch video details for each video
                fetch(`https://youtube.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails%2Cstatistics&id=${videoId}&key=${apiKey}`)
                    .then(response => response.json())
                    .then(videoData => {
                        const videoDetails = videoData.items[0];
                        if (!videoDetails) {
                            console.error("Video details not found for:", videoId);
                            return;
                        }
                        const snippet = videoDetails.snippet;
                        const statistics = videoDetails.statistics;
                        const contentDetails = videoDetails.contentDetails;

                        // Update cloned video with data
                        const div = document.getElementById(`template__${index}`);
                        div.querySelector(".video").setAttribute("href", `https://youtu.be/${videoId}`);
                        div.querySelector(".video--thumbnail img").src = snippet.thumbnails.medium.url;
                        div.querySelector(".video--thumbnail__overlays span").textContent = formatDuration(contentDetails.duration);
                        div.querySelector(".video--details__avatar img").src = avatar;
                        div.querySelector(".video--details__title").textContent = snippet.title;
                        div.querySelector(".video--details__channelTitle").textContent = snippet.channelTitle;
                        div.querySelector(".video--details__meta-data-views").textContent = `${formatNumber(statistics.viewCount)} views`;
                        div.querySelector(".video--details__meta-data-published").textContent = formatDate(snippet.publishedAt);
                    })
                    .catch(error => console.error("Error fetching video details:", error));
            });
        })
        .catch(error => console.log("Error fetching playlist data:", error));
}

// Inisialisasi
document.addEventListener("DOMContentLoaded", () => {
    const dropdownItems = document.querySelectorAll(".dropdown-item");

    if (dropdownItems.length > 0) {
        // Ambil playlist ID dan nama dari elemen dropdown pertama
        const firstItem = dropdownItems[0];
        const initialPlaylistId = firstItem.dataset.playlistId;
        const initialPlaylistName = firstItem.dataset.playlistName;

        // Set teks tombol dropdown dan ambil video dari playlist pertama
        dropdownBtn.textContent = initialPlaylistName;
        fetchVideosByPlaylist(initialPlaylistId);
    }

    dropdownItems.forEach(item => {
        item.addEventListener("click", (event) => {
            const playlistId = event.target.dataset.playlistId; // Ambil ID playlist
            const playlistName = event.target.dataset.playlistName; // Ambil nama playlist
            dropdownBtn.textContent = playlistName; // Ubah teks tombol
            fetchVideosByPlaylist(playlistId); // Ambil video dari playlist menggunakan ID
            playlistDropdown.style.display = "none"; // Sembunyikan dropdown
        });
    });

    dropdownBtn.addEventListener("click", (event) => {
        const dropdown = playlistDropdown;
        dropdown.style.display = dropdown.style.display === "block" ? "none" : "block"; // Toggle dropdown
        event.stopPropagation(); // Mencegah event bubbling
    });

    document.addEventListener("click", () => {
        playlistDropdown.style.display = "none"; // Sembunyikan dropdown
    });
});

// Function untuk format angka
function formatNumber(input) {
    const ranges = [
        { divider: 1e9, suffix: "B" },
        { divider: 1e6, suffix: "M" },
        { divider: 1e3, suffix: "K" }
    ];
    for (let i = 0; i < ranges.length; i++) {
        if (input >= ranges[i].divider) {
            return (input / ranges[i].divider).toFixed(1) + ranges[i].suffix;
        }
    }
    return input.toString();
}

// Function untuk format durasi
function formatDuration(duration) {
    const match = duration.match(/PT(?:(\d+)H)?(?:(\d+)M)?(?:(\d+)S)?/);

    if (!match) {
        return "00:00"; // Jika format durasi tidak valid, kembalikan "00:00"
    }

    const hours = (parseInt(match[1]) || 0);
    const minutes = (parseInt(match[2]) || 0);
    const seconds = (parseInt(match[3]) || 0);

    const formattedMinutes = (minutes < 10 ? "0" + minutes : minutes);
    const formattedSeconds = (seconds < 10 ? "0" + seconds : seconds);

    return hours > 0 ? `${hours}:${formattedMinutes}:${formattedSeconds}` : `${formattedMinutes}:${formattedSeconds}`;
}

// Function untuk format tanggal
function formatDate(dateString) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    const date = new Date(dateString);
    return date.toLocaleDateString(undefined, options);
}


// Function untuk format durasi
function formatDuration(duration) {
    const match = duration.match(/PT(?:(\d+)H)?(?:(\d+)M)?(?:(\d+)S)?/);
    
    if (!match) {
        return "00:00"; // Jika format durasi tidak valid, kembalikan "00:00"
    }

    const hours = (parseInt(match[1]) || 0);
    const minutes = (parseInt(match[2]) || 0);
    const seconds = (parseInt(match[3]) || 0);

    const formattedMinutes = (minutes < 10 ? "0" + minutes : minutes);
    const formattedSeconds = (seconds < 10 ? "0" + seconds : seconds);

    return hours > 0 ? `${hours}:${formattedMinutes}:${formattedSeconds}` : `${formattedMinutes}:${formattedSeconds}`;
}

// YouTube API details
const username = "ardanradio1059FM"; // Ganti dengan username channel Anda
const apiKey = "AIzaSyB-c0ageJpHiB5RN73CIXLTDiAHsuEDTjs";

// URL untuk mendapatkan ID channel dan detailnya
const channelUrl = `https://youtube.googleapis.com/youtube/v3/channels?part=snippet%2Cstatistics&forUsername=${username}&key=${apiKey}`;

// Variabel untuk elemen HTML
// const container = document.querySelector(".video--container");
const placeholder = document.querySelector(".video--placeholder");
let avatar;

// Fetch channel avatar
fetch(channelUrl)
    .then(response => response.json())
    .then(data => {
        if (data.items.length > 0) {
            avatar = data.items[0].snippet.thumbnails.default.url;
        } else {
            console.error("Channel not found");
        }
    })
    .catch(error => console.log("Error fetching channel data:", error));

// // Fetch playlist videos
// function fetchDefaultPlaylistVideos() {
//     fetch(`https://youtube.googleapis.com/youtube/v3/playlistItems?part=snippet%2CcontentDetails&maxResults=10&playlistId=${defaultPlaylistId}&key=${apiKey}`)
//         .then(response => response.json())
//         .then(data => {
//             const videos = data.items;

//             // Clone placeholders untuk setiap video
//             for (let i = 1; i < videos.length; i++) {
//                 const clone = placeholder.cloneNode(true);
//                 clone.id = `template__${i}`;
//                 container.appendChild(clone);
//             }

//             // Populasi setiap video
//             videos.forEach((video, index) => {
//                 const videoId = video.contentDetails.videoId;
//                 const div = document.getElementById(`template__${index}`);

//                 if (!videoId) {
//                     console.error("Video ID not found for:", video);
//                     return;
//                 }

//                 // Fetch detail video
//                 fetch(`https://youtube.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails%2Cstatistics&id=${videoId}&key=${apiKey}`)
//                     .then(response => response.json())
//                     .then(videoData => {
//                         const videoDetails = videoData.items[0];
//                         if (!videoDetails) {
//                             console.error("Video details not found for:", videoId);
//                             return;
//                         }
//                         const snippet = videoDetails.snippet;
//                         const statistics = videoDetails.statistics;
//                         const contentDetails = videoDetails.contentDetails;

//                         // Update placeholder video dengan data
//                         div.querySelector(".video").setAttribute("href", `https://youtu.be/${videoId}`);
//                         div.querySelector(".video--thumbnail img").src = snippet.thumbnails.medium.url;
//                         div.querySelector(".video--thumbnail__overlays span").textContent = formatDuration(contentDetails.duration);
//                         div.querySelector(".video--details__avatar img").src = avatar;
//                         div.querySelector(".video--details__title").textContent = snippet.title;
//                         div.querySelector(".video--details__channelTitle").textContent = snippet.channelTitle;
//                         div.querySelector(".video--details__meta-data-views").textContent = `${formatNumber(statistics.viewCount)} views`;
//                         div.querySelector(".video--details__meta-data-published").textContent = formatDate(snippet.publishedAt);
//                     })
//                     .catch(error => console.error("Error fetching video details:", error));
//             });
//         })
//         .catch(error => console.log("Error fetching playlist data:", error));
// }

// // Panggil fungsi untuk mengambil video dari playlist default
// fetchDefaultPlaylistVideos();

// Function to check if the video is available
function checkVideoAvailability(videoId, title, views, publishedAt) {
    fetch(`https://youtube.googleapis.com/youtube/v3/videos?part=status&id=${videoId}&key=${apiKey}`)
        .then(response => response.json())
        .then(data => {
            if (data.items.length > 0 && data.items[0].status.embeddable) {
                // Video is available, show the popup
                showPopup(videoId, title, views, publishedAt);
            } else {
                alert("Sorry, this video is not available for playback.");
            }
        })
        .catch(error => {
            console.log("Error checking video availability:", error);
            alert("Error checking video availability.");
        });
}


// Menyimpan referensi elemen modal dan elemen iframe
const modal = document.getElementById("videoModal");
const youtubePlayer = document.getElementById("youtubePlayer");
const closeBtn = document.querySelector(".close");

// Fungsi untuk menampilkan modal dan memainkan video
// Membuka pop-up dengan video YouTube yang diminta
function showPopup(videoId, title, views, publishedAt) {
    const modal = document.getElementById("videoModal");
    const player = document.getElementById("youtubePlayer");

    // Update URL video di iframe
    player.src = `https://www.youtube.com/embed/${videoId}`;
    modal.style.display = "block"; // Menampilkan modal

    // Menutup pop-up saat tombol 'close' diklik
    const closeBtn = document.querySelector(".close");
    closeBtn.onclick = () => {
        modal.style.display = "none";
        player.src = ""; // Reset video untuk menghentikan pemutaran
    };

    // Menutup pop-up jika pengguna mengklik di luar area konten modal
    window.onclick = (event) => {
        if (event.target == modal) {
            modal.style.display = "none";
            player.src = ""; // Reset video
        }
    };
}

// Event listener untuk elemen video agar membuka pop-up saat diklik
document.querySelectorAll(".video").forEach(video => {
    video.addEventListener("click", (event) => {
        event.preventDefault(); // Mencegah redirect
        const videoId = video.getAttribute("href").split("youtu.be/")[1];
        const title = video.querySelector(".video--details__title").textContent;
        const views = video.querySelector(".video--details__meta-data-views").textContent;
        const publishedAt = video.querySelector(".video--details__meta-data-published").textContent;

        checkVideoAvailability(videoId, title, views, publishedAt);
    });
});

// Event listener untuk menutup modal saat tombol close ditekan
closeBtn.addEventListener("click", () => {
    modal.style.display = "none";
    youtubePlayer.src = ""; // Menghentikan video saat modal ditutup
});

// Event listener untuk menutup modal saat pengguna mengklik di luar konten modal
window.addEventListener("click", (event) => {
    if (event.target === modal) {
        modal.style.display = "none";
        youtubePlayer.src = ""; // Menghentikan video saat modal ditutup
    }
});

// Memodifikasi elemen video agar membuka modal saat diklik
container.addEventListener("click", (event) => {
    const videoElement = event.target.closest(".video");
    if (videoElement) {
        const videoId = videoElement.getAttribute("href").split("https://youtu.be/")[1];
        const title = videoElement.querySelector(".video--details__title").textContent;
        const views = videoElement.querySelector(".video--details__meta-data-views").textContent;
        const publishedAt = videoElement.querySelector(".video--details__meta-data-published").textContent;

        // Cek ketersediaan video sebelum menampilkan modal
        checkVideoAvailability(videoId, title, views, publishedAt);

        // Mencegah navigasi ke halaman YouTube
        event.preventDefault();
    }
});

function showPopupEvent(element) {
    console.log("Fungsi showPopupEvent dipanggil"); // Log ini akan menunjukkan apakah fungsi dipanggil
    const description = element.getAttribute("data-description");
    const date = element.getAttribute("data-date");
    const slug = element.getAttribute("data-slug"); // Ambil slug dari data attribute

    // Log untuk melihat nilai yang diambil
    console.log("Deskripsi:", description);
    console.log("Tanggal:", date);
    console.log("Slug:", slug);

    // Menampilkan data di dalam pop-up
    document.querySelector(".desk-event").textContent =
        description || "Deskripsi tidak tersedia";
    document.querySelector(".title-box-event").textContent =
        date || "Tanggal tidak tersedia";

    // Set href pada link "See detail"
    const detailLink = document.querySelector(".detail-link");
    detailLink.href = `/detail-event/${slug}`; // Update URL sesuai dengan slug

    // Menampilkan pop-up
    document.getElementById("popupEvent").style.display = "flex";
}

function closePopupEvent() {
    const popupEvent = document.getElementById("popupEvent");
    popupEvent.classList.remove("muncul"); // Hilangkan kelas show
    popupEvent.classList.add("tutup"); // Tambahkan kelas hide untuk animasi keluar
    popupEvent.style.display = "none";
    popupEvent.classList.remove("tutup"); // Reset kelas hide setelah pop-up hilang
}

function closePopupOutsideEvent(event) {
    if (event.target.id === "popupEvent") {
        closePopupEvent();
    }
}