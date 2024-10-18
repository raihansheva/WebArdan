const playlists = [
    { id: 1, name: 'Chill Vibes' },
    { id: 2, name: 'Top Hits 2024' },
    { id: 3, name: 'Workout Playlist' },
    { id: 4, name: 'Classical Essentials' },
    { id: 5, name: 'Indie Favorites' },
];

const dropdownButton = document.getElementById('dropdown-btn-playlist');
const playlistDropdown = document.getElementById('playlist-dropdown');
const searchInput = document.getElementById('search-input');

// Menampilkan daftar playlist di dropdown
function displayPlaylists(filteredPlaylists) {
    playlistDropdown.innerHTML = '';
    filteredPlaylists.forEach(playlist => {
        const div = document.createElement('div');
        div.textContent = playlist.name;
        div.onclick = () => {
            dropdownButton.textContent = playlist.name; // Menampilkan nama playlist yang dipilih
            playlistDropdown.style.display = 'none'; // Menutup dropdown
        };
        playlistDropdown.appendChild(div);
    });
}

// Fungsi untuk menyaring playlist berdasarkan input
function filterPlaylists() {
    const query = searchInput.value.toLowerCase();
    const filteredPlaylists = playlists.filter(playlist => 
        playlist.name.toLowerCase().includes(query)
    );
    displayPlaylists(filteredPlaylists);
}

// Menampilkan semua playlist saat halaman dimuat
displayPlaylists(playlists);

// Menampilkan atau menyembunyikan dropdown saat tombol diklik
dropdownButton.onclick = () => {
    playlistDropdown.style.display = playlistDropdown.style.display === 'block' ? 'none' : 'block';
};

// Menyembunyikan dropdown saat klik di luar
window.onclick = (event) => {
    if (!event.target.matches('#dropdown-button')) {
        playlistDropdown.style.display = 'none';
    }
};
