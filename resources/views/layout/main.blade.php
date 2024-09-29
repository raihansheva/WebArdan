<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ARDAN</title>
    <link rel="stylesheet" href="css/StyleMain/main.css">
</head>

<body>
    {{-- navbar area --}}
    <nav class="navbar">
        <div class="area-kiri-navbar">
            <img class="image-brand" src="image/imageHeader/logoArdan.png" alt="">
        </div>
        <div class="area-kanan-navbar">
            <div class="menu-link-navbar">
                <a class="link" href="#home">
                    <p>Home</p>
                </a>
                <div class="dropdown">
                    <a class="link dropText" id="dropdown-toggle">Media & Program<i class="arrow-down"></i></a>
                    <div class="dropdown-content" id="dropdown-menu">
                        <a href="#program">Program</a>
                        <div class="line"></div>
                        <a href="#info-news">Info News</a>
                        <div class="line"></div>
                        <a href="#event">Event</a>
                        <div class="line"></div>
                        <a href="#">Playlist Youtube</a>
                        <div class="line"></div>
                        <a href="#">Podcast</a>
                        <div class="line"></div>
                    </div>
                </div>
                <a class="link" href="#announcer">
                    <p>Announcer</p>
                </a>
                <a class="link" href="#chart">
                    <p>Chart</p>
                </a>
                <a class="link" href="#schedule">
                    <p>Schedule</p>
                </a>
                <a class="link" href="#contact">
                    <p>Contact</p>
                </a>
            </div>
        </div>
        <!-- Hamburger Icon -->
        <div class="hamburger" id="hamburger-icon">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <!-- Mobile Menu -->
        <div class="mobile-menu" id="mobile-menu">
            <div class="close-menu" id="close-menu">
                &times; <!-- Symbol for 'X' close button -->
            </div>
            <div class="area-menu-mobile">
                <a class="link-mobile" href="#home">Home</a>
                <a class="link-mobile" href="#program">Program</a>
                <a class="link-mobile" href="#info-news">Info News</a>
                <a class="link-mobile" href="#event">Event</a>
                <a class="link-mobile" href="#s">Playlist Youtube</a>
                <a class="link-mobile" href="#s">Podcast</a>
                <a class="link-mobile" href="#announcer">Announcer</a>
                <a class="link-mobile" href="#chart">Chart</a>
                <a class="link-mobile" href="#schedule">Schedule</a>
                <a class="link-mobile" href="#contact">Contact</a>
            </div>
            <div class="area-audio-mobile">
                <div class="area-image-audio-mobile">
                    <div class="image-audio-mobile"></div>
                </div>
                <div class="area-line-progress-mobile">
                    <div class="progress-details-mobile">
                        <div class="progress-bar-mobile">
                            <span></span>
                        </div>
                    </div>
                </div>
                <div class="control-btn-mobile">
                    <!-- <span class="material-symbols-rounded" id="repeat">repeat</span> -->
                    <span class="material-symbols-rounded" id="prev-mobile">skip_previous</span>
                    <div class="play-pause-mobile">
                        <span class="btn-play-mobile material-symbols-rounded">play_arrow</span>
                    </div>
                    <span class="material-symbols-rounded" id="next-mobile">skip_next</span>
                    <!-- <span class="material-symbols-rounded" id="shuffle">shuffle</span> -->
                </div>
                <audio src="music/music1.mp3" class="main-song-mobile" id="audio"></audio>
            </div>
        </div>

    </nav>

    {{-- ------- --}}


    {{-- main content area --}}
    <main class="main">
        @yield('content')
    </main>
    {{-- ------- --}}

    <footer class="footer" id="contact">
        <div class="top-footer">
            <div class="area-kiri-footer">
                <div class="area-group-kiri">
                    <div class="area-text-contact">
                        <h1 class="text-contact">CONTACT US</h1>
                    </div>
                    <div class="area-footer-address">
                        <p class="footer-address">Email : example@gmail.com</p>
                        <p class="footer-address">Telepon : +62 085862839923 </p>
                        <p class="footer-address">Alamat :lorem ipsum dolor sit amet</p>
                    </div>
                </div>
            </div>
            <div class="area-kanan-footer">
                <div class="area-group-kanan">
                    <div class="area-text-socmed">
                        <h1 class="text-socmed">Social Media</h1>
                    </div>
                    <div class="area-footer-socmed">
                        <div class="kotak-socmed"></div>
                        <div class="kotak-socmed"></div>
                        <div class="kotak-socmed"></div>
                        <div class="kotak-socmed"></div>
                    </div>
                    <div class="area-text-socmed2">
                        <h1 class="text-socmed2">Get it on</h1>
                    </div>
                    <div class="area-footer-download">
                        <div class="kotak-download"></div>
                        <div class="kotak-download"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-footer">
            <h1 class="text-copyRight">CopyRight 2024</h1>
        </div>
    </footer>
</body>
<script>
    // function checkScreenSize() {
    //     // Cek apakah layar lebih kecil atau sama dengan 768px
    //     if (window.innerWidth <= 768) {
    //         // Ganti ID "play-pause" menjadi "play-pause-mobile"
    //         document.getElementById("play-pause").id = "play-pause-nonactive";
    //         document.getElementById("play-pause-m").id = "play-pause";
    //     } else {
    //         // Kembalikan ID "play-pause-mobile" menjadi "play-pause"
    //         var mobilePlayer = document.getElementById("play-pause");
    //         if (mobilePlayer) {
    //             mobilePlayer.id = "play-pause-m";
    //         }
    //         var mobilePlayer = document.getElementById("play-pause-nonactive");
    //         if (mobilePlayer) {
    //             mobilePlayer.id = "play-pause";
    //         }
    //     }
    // }

    // // Jalankan fungsi saat halaman dimuat dan ketika ukuran layar berubah
    // window.onload = checkScreenSize;
    // window.onresize = checkScreenSize;
    // JavaScript untuk toggle dropdown saat diklik
    document.getElementById('dropdown-toggle').addEventListener('click', function(event) {
        // Toggle class 'show' untuk menampilkan atau menyembunyikan dropdown
        document.getElementById('dropdown-menu').classList.toggle('show');

        // Mencegah link default jika ada di dropdown-text
        event.preventDefault();
    });

    // Tutup dropdown jika klik di luar dropdown
    window.onclick = function(event) {
        if (!event.target.matches('.arrow-down')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    };

    document.querySelectorAll('.link').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();

            const target = document.querySelector(this.getAttribute('href'));
            const navbarHeight = document.querySelector('.navbar').offsetHeight;
            const targetTop = target.getBoundingClientRect().top + window.pageYOffset;

            // Sesuaikan posisi scroll dengan menambahkan offset height dari navbar
            window.scrollTo({
                top: targetTop - navbarHeight,
                behavior: 'smooth'
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const sections = document.querySelectorAll('section'); // Mengambil semua section
        const navLinks = document.querySelectorAll('.link'); // Mengambil semua link navbar

        // Fungsi untuk menghapus kelas 'active' dari semua link
        const removeActiveClasses = () => {
            navLinks.forEach(link => link.classList.remove('active'));
        };

        // Menggunakan IntersectionObserver untuk melacak setiap section
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    removeActiveClasses();
                    const activeLink = document.querySelector(
                        `.link[href="#${entry.target.id}"]`);
                    activeLink.classList.add(
                        'active'); // Tambahkan kelas 'active' ke link yang sesuai
                }
            });
        }, {
            threshold: 0.6 // 60% dari section harus terlihat sebelum dianggap aktif
        });

        // Memantau setiap section
        sections.forEach(section => {
            observer.observe(section);
        });
    });
    // Toggle mobile menu on hamburger icon click
    document.getElementById("hamburger-icon").addEventListener("click", function() {
        const mobileMenu = document.getElementById("mobile-menu");
        mobileMenu.classList.toggle("active");
    });

    // Close the mobile menu on close icon click
    document.getElementById("close-menu").addEventListener("click", function() {
        const mobileMenu = document.getElementById("mobile-menu");
        mobileMenu.classList.remove("active");
    });

    // Close menu when clicking outside of the mobile menu
    document.addEventListener("click", function(event) {
        const mobileMenu = document.getElementById("mobile-menu");
        const hamburgerIcon = document.getElementById("hamburger-icon");

        const isClickInsideMenu = mobileMenu.contains(event.target);
        const isClickInsideHamburger = hamburgerIcon.contains(event.target);

        console.log("Clicked inside menu: ", isClickInsideMenu);
        console.log("Clicked inside hamburger: ", isClickInsideHamburger);

        if (!isClickInsideMenu && !isClickInsideHamburger && mobileMenu.classList.contains("active")) {
            console.log("Closing mobile menu"); // Check if this gets logged
            mobileMenu.classList.remove("active");
        }
    });
    // const AudioMobile = document.querySelector(".main-song-mobile"),
    //     playBtnMobile = document.querySelector(".play-pause-mobile"),
    //     playBtnIconMobile = document.querySelector(".btn-play-mobile"),
    //     prevBtnMobile = document.querySelector("#prev-mobile"),
    //     nextBtnMobile = document.querySelector("#next-mobile"),
    //     progressBarMobile = document.querySelector(".progress-bar-mobile span");

    // let indexM = 0; // Menggunakan variabel indexM untuk melacak lagu saat ini

    // const songsM = [{
    //         title: "Song 1",
    //         file: "music/music1.mp3"
    //     },
    //     {
    //         title: "Song 2",
    //         file: "music/music2.mp3"
    //     },
    //     {
    //         title: "Song 3",
    //         file: "music/music3.mp3"
    //     }
    // ];

    // // Memuat lagu berdasarkan indexM
    // function loadDataMobile(indexM) {
    //     const song = songsM[indexM];
    //     AudioMobile.src = song.file;
    //     updateProgressBarMobile(); // Mengupdate progress bar saat memuat lagu baru
    //     AudioMobile.currentTime = 0; // Reset waktu ke awal
    // }

    // // Memperbarui progress bar
    // function updateProgressBarMobile() {
    //     AudioMobile.addEventListener("timeupdate", () => {
    //         const duration = AudioMobile.duration; // Durasi audio
    //         const currentTime = AudioMobile.currentTime; // Waktu saat ini
    //         if (duration > 0) {
    //             const progressPercentage = (currentTime / duration) * 100; // Persentase kemajuan
    //             progressBarMobile.style.width = progressPercentage + '%'; // Mengatur lebar progress bar
    //         }
    //     });
    // }

    // // Memainkan lagu
    // function playSongMobile() {
    //     AudioMobile.play();
    //     playBtnIconMobile.innerHTML = "pause"; // Mengubah icon play ke pause
    // }

    // // Menjeda lagu
    // function pauseSongMobile() {
    //     AudioMobile.pause();
    //     playBtnIconMobile.innerHTML = "play_arrow"; // Mengubah icon pause ke play
    // }

    // // Toggle play/pause ketika tombol diklik
    // playBtnMobile.addEventListener("click", () => {
    //     if (AudioMobile.paused) {
    //         playSongMobile();
    //     } else {
    //         pauseSongMobile();
    //     }
    // });

    // // Tombol next untuk lagu selanjutnya
    // nextBtnMobile.addEventListener("click", () => {
    //     indexM++;
    //     if (indexM >= songsM.length) {
    //         indexM = 0; // Jika melebihi panjang array, kembali ke lagu pertama
    //     }
    //     loadDataMobile(indexM);
    //     playSongMobile();
    // });

    // // Tombol prev untuk lagu sebelumnya
    // prevBtnMobile.addEventListener("click", () => {
    //     indexM--;
    //     if (indexM < 0) {
    //         indexM = songsM.length - 1; // Jika kurang dari 0, kembali ke lagu terakhir
    //     }
    //     loadDataMobile(indexM);
    //     playSongMobile();
    // });

    // // Memuat lagu pertama saat halaman di-load
    // loadDataMobile(indexM);
</script>

</html>
