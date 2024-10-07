<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ARDAN PODCAST</title>
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
                <a class="link" href="/home">
                    <p>Home</p>
                </a>
                <a class="link" href="/podcast">
                    <p>Podcast</p>
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
                <a class="link-mobile" href="/">Home</a>
                <a class="link-mobile" href="/podcast">Podcast</a>
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
        @yield('content-podcast')
    </main>
    {{-- ------- --}}
    <div id="scrollToTopBtn"><img onclick="scrollToTop()" src="image/vinyl.png" alt="">
    </div>
    
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
    // document.querySelectorAll('.link').forEach(anchor => {
    //     anchor.addEventListener('click', function(e) {
    //         e.preventDefault();

    //         const target = document.querySelector(this.getAttribute('href'));
    //         const navbarHeight = document.querySelector('.navbar').offsetHeight;
    //         const targetTop = target.getBoundingClientRect().top + window.pageYOffset;

    //         // Sesuaikan posisi scroll dengan menambahkan offset height dari navbar
    //         window.scrollTo({
    //             top: targetTop - navbarHeight,
    //             behavior: 'smooth'
    //         });
    //     });
    // });

    // document.addEventListener('DOMContentLoaded', function() {
    //     const sections = document.querySelectorAll('section'); // Mengambil semua section
    //     const navLinks = document.querySelectorAll('.link'); // Mengambil semua link navbar

    //     // Fungsi untuk menghapus kelas 'active' dari semua link
    //     const removeActiveClasses = () => {
    //         navLinks.forEach(link => link.classList.remove('active'));
    //     };

    //     // Menggunakan IntersectionObserver untuk melacak setiap section
    //     const observer = new IntersectionObserver((entries) => {
    //         entries.forEach(entry => {
    //             if (entry.isIntersecting) {
    //                 removeActiveClasses();
    //                 const activeLink = document.querySelector(
    //                     `.link[href="#${entry.target.id}"]`);
    //                 activeLink.classList.add(
    //                     'active'); // Tambahkan kelas 'active' ke link yang sesuai
    //             }
    //         });
    //     }, {
    //         threshold: 0.6 // 60% dari section harus terlihat sebelum dianggap aktif
    //     });

    //     // Memantau setiap section
    //     sections.forEach(section => {
    //         observer.observe(section);
    //     });
    // });
    // // Toggle mobile menu on hamburger icon click
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
    // Tampilkan tombol saat pengguna scroll ke bawah
    window.onscroll = function() {
        var scrollToTopBtn = document.getElementById("scrollToTopBtn");
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            scrollToTopBtn.style.display = "block";
        } else {
            scrollToTopBtn.style.display = "none";
        }
    };

    // Fungsi untuk scroll ke atas
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: "smooth" // Scroll secara halus
        });
    }
</script>

</html>
