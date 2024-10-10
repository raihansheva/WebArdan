

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