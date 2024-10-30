// Menyimpan referensi elemen
const dropdownBtn = document.getElementById("dropdown-btn-playlist");
const playlistDropdown = document.getElementById("playlist-dropdown");
const container = document.querySelector(".video--container");

// ID Playlist Default
const defaultPlaylistId = "PLWB1T6z4qsVdtre5f9vbpkSobkTnPjOe3"; // Ganti dengan ID playlist default kamu

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

    dropdownItems.forEach(item => {
        item.addEventListener("click", (event) => {
            const playlistId = event.target.dataset.playlistId; // Ambil ID playlist
            const playlistName = event.target.dataset.playlistName; // Ambil nama playlist
            dropdownBtn.textContent = playlistName; // Ubah teks tombol
            fetchVideosByPlaylist(playlistId); // Ambil video dari playlist menggunakan ID
            playlistDropdown.style.display = "none"; // Sembunyikan dropdown
        });
    });
    
    // Fetch video dari playlist default saat halaman dimuat
    fetchVideosByPlaylist(defaultPlaylistId);

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

// Show video details in a popup
function showPopup(videoId, title, views, publishedAt) {
    const popupContainer = document.getElementById("video-popup");
    popupContainer.innerHTML = `
        <h2>${title}</h2>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/${videoId}" frameborder="0" allowfullscreen></iframe>
        <p>${views} views | Published on: ${publishedAt}</p>
        <button id="close-popup">Close</button>
    `;
    popupContainer.style.display = "block";

    document.getElementById("close-popup").onclick = function() {
        popupContainer.style.display = "none";
    };
}

// Helper function to format the published date
function formatDate(dateString) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    const date = new Date(dateString);
    return date.toLocaleDateString(undefined, options);
}

// Call the fetch function for the default playlist videos
fetchVideosByPlaylist(defaultPlaylistId);

// Close the popup
// document.getElementById("close-popup").addEventListener("click", () => {
//     document.getElementById("video-popup").style.display = "none";
// });

// // Mengambil video berdasarkan ID playlist default saat halaman dimuat
// document.addEventListener("DOMContentLoaded", () => {
//     fetchVideosByPlaylist(defaultPlaylistId);
// });
