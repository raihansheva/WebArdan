import './bootstrap';
import Swiper from 'swiper/bundle';

async function fetchRealtimeData() {
    try {
        const response = await fetch('/analytics/realtime');
        if (!response.ok) throw new Error('Gagal mengambil data');
        
        const data = await response.json();
        console.log('Realtime Data:', data);

        // Contoh: Menampilkan jumlah user aktif di HTML
        document.getElementById('realtime-users').innerText = data.rows.length > 0 ? data.rows[0].metricValues[0].value : 0;
        
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}

// Panggil fungsi setiap 10 detik (untuk update realtime)
setInterval(fetchRealtimeData, 10000);

// Panggil saat halaman pertama kali dibuka
fetchRealtimeData();
