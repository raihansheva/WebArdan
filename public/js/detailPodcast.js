// carousel card podcast
const tombolKiriOP = document.querySelector('.tombol-kiri-OP');
const tombolKananOP = document.querySelector('.tombol-kanan-OP');
const areaContentBoxOP = document.querySelector('.area-content-card-OP');

const getScrollAmountA = () => {
    if (window.matchMedia("(max-width: 480px)").matches) {
        return 358;
    } else if (window.matchMedia("(max-width: 768px)").matches) {
        return 380; 
    } else if (window.matchMedia("(max-width: 1024px)").matches) {
        return 400; 
    } else {
        return 480;
    }
};


tombolKiriOP.addEventListener('click', () => {
    areaContentBoxOP.scrollBy({
        left: -getScrollAmountA(), 
        behavior: 'smooth'
    });
});

tombolKananOP.addEventListener('click', () => {
    areaContentBoxOP.scrollBy({
        left: getScrollAmountA(),
        behavior: 'smooth'
    });
});
// -------------------------------OP