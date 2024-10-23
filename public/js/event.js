// // countdown event
// const daysElement = document.getElementById('days');
// const hoursElement = document.getElementById('hours');
// const minutesElement = document.getElementById('minutes');
// const secondsElement = document.getElementById('seconds');

// const countdownDate = new Date('2024-10-5 23:59:59').getTime();

// function updateCountdown() {
//     const now = new Date().getTime();
//     const timeRemaining = countdownDate - now;

//     const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
//     const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//     const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
//     const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

//     daysElement.innerText = days < 10 ? '0' + days : days;
//     hoursElement.innerText = hours < 10 ? '0' + hours : hours;
//     minutesElement.innerText = minutes < 10 ? '0' + minutes : minutes;
//     secondsElement.innerText = seconds < 10 ? '0' + seconds : seconds;

//     if (timeRemaining < 0) {
//         clearInterval(countdownInterval);
//         daysElement.innerText = "00";
//         hoursElement.innerText = "00";
//         minutesElement.innerText = "00";
//         secondsElement.innerText = "00";
//         alert('Countdown selesai!');
//     }
// }

// const countdownInterval = setInterval(updateCountdown, 1000);
// // ---------------------------------------


// pop up event
function showPopupEvent() {
    const popupEvent = document.getElementById("popupEvent");
    popupEvent.classList.add("muncul"); // Tambahkan kelas show untuk animasi muncul
    popupEvent.style.display = "flex"; // Tampilkan pop-up
}

function closePopupEvent() {
    const popupEvent = document.getElementById("popupEvent");
    popupEvent.classList.remove("muncul"); // Hilangkan kelas show
    popupEvent.classList.add("tutup"); // Tambahkan kelas hide untuk animasi keluar

    // Sembunyikan pop-up setelah animasi selesai
        popupEvent.style.display = "none";
        popupEvent.classList.remove("tutup"); // Reset kelas hide setelah pop-up hilang
}

function closePopupOutsideEvent(event) {
    if (event.target.id === "popupEvent") {
        closePopupEvent();
    }
}
// -----------


// pop up program
function showPopup() {
    document.getElementById("popup").style.display = "flex"; // Tampilkan pop-up
}

function closePopup() {
    document.getElementById("popup").style.display = "none"; // Sembunyikan pop-up
}

function closePopupOutside(event) {
    // Tutup pop-up hanya jika pengguna mengklik di luar konten
    if (event.target.id === "popup") {
        closePopup();
    }
}
// -----------