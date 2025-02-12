<!DOCTYPE html>
<html lang="en">

<head>
    <base href="{{ url('/') }}">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="icon" href="" sizes="any">
    <link rel="apple-touch-icon"
        href="./storage/{{ \App\Helpers\Settings::get('site_apple_touch_icon', 'Default Site Title') }}">
    {{-- <link rel="apple-touch-icon" sizes="57x57" href=""/assets/images/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href=""/assets/images/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href=""/assets/images/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href=""/assets/images/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href=""/assets/images/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href=""/assets/images/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href=""/assets/images/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href=""/assets/images/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href=""/assets/images/apple-icon-180x180.png"> --}}
    <link rel="manifest" href="">
    {{-- <link href="https://vjs.zencdn.net/7.10.2/video-js.css" rel="stylesheet"> --}}
    <!-- Mencegah highlight biru pada elemen klik -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">

    {{-- <meta name="apple-mobile-web-app-capable" content="yes"> --}}
    <link rel="icon" href="./storage/{{ \App\Helpers\Settings::get('site_icon', 'Default Site Title') }}">
    <title>@yield('title')</title>
    {{-- <title>{{ \App\Helpers\Settings::get('site_title', 'Default Site Title') }}</title> --}}

    @stack('meta-seo')
    <link rel="stylesheet" href="{{ asset('css/StyleMain/main.css?v=' . time()) }}">
    <link rel="stylesheet" href="{{ asset('css/StyleMain/responsiveMain.css?v=' . time()) }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mediaelement@4.2.7/build/mediaelementplayer.min.css">
    <link href="https://vjs.zencdn.net/8.16.1/video-js.css" rel="stylesheet" />

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    {{-- Style Page Content --}}
    @stack('Style.css')
    <style>
        .player-stream {
            pointer-events: none;
        }
    </style>
</head>

<body>
    <!-- Popup Modal -->
    <div id="popup-ads" class="popup-ads-container">
        <div id="imageAds" class="popup-content-ads">
            <a id="linkAds" href="">
                <img id="image-ads" class="image-ads" src="" alt="Popup Ads">
            </a>
            <button id="btn-link" class="btn-link" style="display: none;"><a id="linkAdsBtn" href="">Click
                    Me</a></button>
        </div>
        <!-- Ikon close -->
        <div id="close-icon" class="close-icon" style="display: none;">&times;</div>
    </div>


    {{-- navbar area --}}
    <nav class="navbar">
        <div class="area-kiri-navbar">
            <img class="image-brand" src="storage/{{ \App\Helpers\Settings::get('site_logo', 'null') }}" alt="">
        </div>
        <div class="area-kanan-navbar">
            <div class="menu-link-navbar">
                <a class="link" href="/">
                    <p>Home</p>
                </a>
                <div class="dropdown">
                    <a class="link dropText" id="dropdown-toggle">Media & Program<i class="arrow-down"></i></a>
                    <div class="dropdown-content" id="dropdown-menu">
                        @if (Request::is('/') || Request::is('/home'))
                            <a href="#program">Program</a>
                        @else
                            <a href="{{ url('/') }}#program">Program</a>
                        @endif
                        <div class="line"></div>
                        <a href="/info-news">Info News</a>
                        <div class="line"></div>
                        <a href="/event">Event</a>
                        <div class="line"></div>
                        <a href="/ardan-youtube">Playlist Youtube</a>
                        <div class="line"></div>
                        <a href="/podcast">Podcast</a>
                        <div class="line"></div>
                    </div>
                </div>
                @if (Request::is('/') || Request::is('/home'))
                    <a class="link" href="#announcer">
                        <p>Announcer</p>
                    </a>
                @else
                    <a class="link" href="{{ url('/') }}#announcer">
                        <p>Announcer</p>
                    </a>
                @endif
                @if (Request::is('/') || Request::is('/'))
                    <a class="link" href="#chart">
                        <p>Chart</p>
                    </a>
                @else
                    <a class="link" href="{{ url('/') }}#chart">
                        <p>Chart</p>
                    </a>
                @endif
                @if (Request::is('/') || Request::is('/'))
                    <a class="link" href="#schedule">
                        <p>Schedule</p>
                    </a>
                @else
                    <a class="link" href="{{ url('/') }}#schedule">
                        <p>Schedule</p>
                    </a>
                @endif
                <a class="link" href="#contact">
                    <p>Contact</p>
                </a>
            </div>
            @if ($sosmed)
                <div class="area-socmed">
                    @foreach ($sosmed as $sosmedList)
                        @if ($sosmedList->platform_name == 'Facebook')
                            <div class="kotak-socmed">
                                <a href="{{ $sosmedList->link_platform }}">
                                    <i class='bx bxl-facebook-square'></i>
                                </a>
                            </div>
                        @elseif ($sosmedList->platform_name == 'Instagram')
                            <div class="kotak-socmed">
                                <a href="{{ $sosmedList->link_platform }}">
                                    <i class='bx bxl-instagram'></i>
                                </a>
                            </div>
                        @elseif ($sosmedList->platform_name == 'Twitter')
                            <div class="kotak-socmed">
                                <a href="{{ $sosmedList->link_platform }}">
                                    <i class='bx bxl-twitter'></i>
                                </a>
                            </div>
                        @elseif ($sosmedList->platform_name == 'Youtube')
                            <div class="kotak-socmed">
                                <a href="{{ $sosmedList->link_platform }}">
                                    <i class='bx bxl-youtube'></i>
                                </a>
                            </div>
                        @else
                            <div class="kotak-socmed">
                                {{-- <i class='bx bxl-youtube'></i> --}}
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
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
                @if (Request::is('/') || Request::is('/home'))
                    <a class="link-mobile" href="#program">Program</a>
                @else
                    <a class="link-mobile" href="{{ url('home') }}#program">Program</a>
                @endif
                <a class="link-mobile" href="/info-news">Info News</a>
                <a class="link-mobile" href="/event">Event</a>
                <a class="link-mobile" href="/ardan-youtube">Playlist Youtube</a>
                <a class="link-mobile" href="/podcast">Podcast</a>
                @if (Request::is('/') || Request::is('/'))
                    <a class="link-mobile" href="#announcer">Announcer</a>
                @else
                    <a class="link-mobile" href="{{ url('') }}#announcer">Announcer</a>
                @endif
                <a class="link-mobile" href="/chart">Chart</a>
                @if (Request::is('/') || Request::is('/'))
                    <a class="link-mobile" href="#schedule">Schedule</a>
                @else
                    <a class="link-mobile" href="{{ url('') }}#schedule">Schedule</a>
                @endif
                <a class="link-mobile" href="#contact">Contact</a>
            </div>
            {{-- <div class="area-audio-mobile">
                <div class="area-image-audio-mobile">
                    <div class="image-audio-mobile">
                    </div>
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
                    <div class="play-pause play-pause-mobile" id="play-pause">
                        <span class="btn-play-mobile material-symbols-rounded">play_arrow</span>
                    </div>
                    <span class="material-symbols-rounded" id="next-mobile">skip_next</span>
                    <!-- <span class="material-symbols-rounded" id="shuffle">shuffle</span> -->
                </div>
                <audio src="music/music1.mp3" class="main-song-mobile" id="audio"></audio>
            </div> --}}
        </div>

    </nav>

    {{-- ------- --}}


    {{-- main content area --}}
    <main class="main">
        @yield('content')
    </main>
    {{-- ------- --}}
    <div id="scrollToTopBtn"><i onclick="scrollToTop()" class='bx bx-up-arrow-alt'></i>
    </div>
    {{-- audio player --}}
    <div class="audio-player-container">

        <svg id="visual" viewBox="0 0 900 600" width="1800" height="800" xmlns="http://www.w3.org/2000/svg">
            <path id="layer1" fill="#f8c301" stroke="#f8c301" stroke-width="2" stroke-linecap="round"></path>
        </svg>
        <div class="content">
            <div class="area-control-btn">
                <div class="control-btn" id="control-btn">
                    <span class="material-symbols-rounded" id="prev">skip_previous</span>
                    <div class="play-pause-stream" id="BtnStream">
                        <span class="btn-play material-symbols-rounded">play_arrow</span>
                    </div>
                    <div class="play-pause-chart" id="BtnChart">
                        <span class="btn-play material-symbols-rounded">play_arrow</span>
                    </div>
                    <div class="play-pause-podcast" id="BtnPodcast">
                        <span class="btn-play material-symbols-rounded">play_arrow</span>
                    </div>
                    <span class="material-symbols-rounded" id="next">skip_next</span>
                    <p class="icon-menu" id="show-hide-player"><i class='bx bx-menu'></i></span>
                        <!-- <span class="material-symbols-rounded" id="shuffle">shuffle</span> -->
                </div>
            </div>
            <div class="area-control-progres">
                <div class="image-wrapper">
                    <div class="music-image" id="image">
                        <img src="" alt="-" />
                    </div>
                </div>
                <div class="music-titles">
                    <p class="name"></p>
                    <p class="artist"></p>
                </div>
                <div class="area-line">
                    <div class="progress-details">
                        <div class="progress-bar">
                            <span></span>
                        </div>
                    </div>
                </div>
                {{-- <div class="music-titles">
                    <p class="name">Hamburger area</p>
                </div> --}}
            </div>

        </div>

        <audio src="" class="main-song" id="audio"></audio>
        {{-- <audio src="" class="main-song-streaming" id="audio-streaming"></audio> --}}
        <audio class="audio-streaming" id="audio-streaming" preload="auto" crossorigin="anonymous">
            <source type="audio/mpeg" src="{{ $streamAudio->stream_url }}" />
        </audio>
    </div>
    {{-- ------- --}}
    <footer class="footer" id="contact">
        <div class="top-footer">
            <div class="area-top-footer">
                <div class="group-top-footer">
                    <div class="area-group-kiri">
                        <div class="area-text-contact">
                            <h1 class="text-contact">CONTACT US : </h1>
                        </div>
                        <div class="area-text-name">
                            @if ($contact->text_1)
                                <p class="text-name">{{ $contact->text_1 }}</p>
                            @endif
                            @if ($contact->text_2)
                                <p class="text-name">{{ $contact->text_2 }}</p>
                            @endif
                        </div>
                        <div class="area-footer-address">
                            <p class="footer-address">WA : {{ $contact->no_telepon }}</p>
                            <p class="footer-address">🤝 : {{ $contact->email_collab }}</p>
                            <p class="footer-address">🎼 : {{ $contact->email_music }}</p>
                        </div>
                        <div class="area-footer-socmed">
                            <div class="kotak-socmed">
                                <i class='bx bxl-facebook-square'></i>
                            </div>
                            <div class="kotak-socmed">
                                <i class='bx bxl-instagram'></i>
                            </div>
                            <div class="kotak-socmed">
                                <i class='bx bxl-twitter'></i>
                            </div>
                            <div class="kotak-socmed">
                                <i class='bx bxl-youtube'></i>
                            </div>
                        </div>
                    </div>
                    @if ($applink)
                        <div class="area-group-tengah">
                            <div class="area-app-download">
                                <h1 class="text-app-download">Get it on :</h1>
                                <div class="area-footer-download">
                                    @foreach ($applink as $applinkList)
                                        <a href="{{ $applinkList->link_app }}">
                                            <div class="kotak-download">
                                                <img class="image-platform"
                                                    src="./storage/{{ $applinkList->app_image }}" alt="">
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="area-group-kanan">
                        <div class="area-partner">
                            <h1 class="text-partner">Our digital partner :</h1>
                            <div class="area-box-partner">
                                @foreach ($partner as $partnerList)
                                    <div class="partner">
                                        <img class="image-partner" src="./storage/{{ $partnerList->logo_partner }}"
                                            alt="">
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-footer">
            <h1 class="text-copyRight">{{ $copyright->text }} <a class="name-owners"
                    href="{{ $copyright->link_company }}">{{ $copyright->copyright_owners }}</a></h1>
        </div>
        <div class="bottom-footer-dummy">
            {{-- <h1 class="text-copyRight">{{$copyright->text}} <a class="name-owners" href="{{ $copyright->link_company }}">{{ $copyright->copyright_owners }}</a></h1> --}}
        </div>
    </footer>
</body>
<script src="{{ asset('js/main/playlist.js?v=' . time()) }}"></script>
<script src="{{ asset('js/main/mainLayout.js?v=' . time()) }}"></script>
{{-- <script src="js/main/streamingPlayer.js"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script> --}}
<script src="https://vjs.zencdn.net/8.16.1/video.min.js"></script>

{{-- <script src="https://cdn.jsdelivr.net/npm/videojs-contrib-hls@5.14.0/dist/videojs-contrib-hls.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/mediaelement@4.2.7/build/mediaelement-and-player.min.js" defer></script>

<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js" defer></script>
<script>
    const urlCek = window.location.pathname;
    console.log("Current Path:", urlCek);
    if (!urlCek.includes("detail-podcast") && !urlCek.includes("chart")) {
        document.addEventListener("DOMContentLoaded", () => {
            const btnPlayStream = document.querySelector(".btn-play-streaming");
            const btnPlayChart = document.querySelector(".btn-play-chart");
            const audioPlayerContainer = document.querySelector(".audio-player-container");

            // Pastikan audio player tersembunyi di awal
            audioPlayerContainer.style.opacity = "0";
            audioPlayerContainer.style.visibility = "hidden";

            // Fungsi untuk mengecek apakah elemen terlihat di viewport
            function isElementInViewport(el) {
                if (!el) return false; // Jika elemen tidak ditemukan
                const rect = el.getBoundingClientRect();
                return (
                    rect.top >= 0 &&
                    rect.left >= 0 &&
                    rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                    rect.right <= (window.innerWidth || document.documentElement.clientWidth)
                );
            }

            // Fungsi untuk mengatur visibilitas Audio Player
            function updateAudioPlayerVisibility() {
                if (btnPlayChart && isElementInViewport(btnPlayChart)) {
                    console.log("🎵 BtnChart terlihat, menampilkan audio player.");
                    audioPlayerContainer.style.opacity = "1";
                    audioPlayerContainer.style.visibility = "visible";
                } else if (btnPlayStream && isElementInViewport(btnPlayStream)) {
                    console.log("⛔ BtnStream terlihat, menyembunyikan audio player.");
                    audioPlayerContainer.style.opacity = "0";
                    audioPlayerContainer.style.visibility = "hidden";
                } else {
                    console.log("✅ Audio player tetap terlihat.");
                    audioPlayerContainer.style.opacity = "1";
                    audioPlayerContainer.style.visibility = "visible";
                }
            }


            // Panggil fungsi saat halaman dimuat
            updateAudioPlayerVisibility();

            // Pantau perubahan saat pengguna menggulir
            window.addEventListener("scroll", updateAudioPlayerVisibility);
        });
    }
    document.addEventListener("DOMContentLoaded", function() {
        const swiperContainers = [
            'swiper-xl',
            'swiper-xl-bottom',
            'swiper-l',
            'swiper-s'
        ];

        swiperContainers.forEach((id) => {
            const swiperContainer = document.getElementById(id);
            if (swiperContainer) {
                swiperContainer.classList.add('loaded');
            }
        });

        // // Fungsi untuk mendapatkan nama halaman saat ini
        // function getCurrentPage() {
        //     const path = window.location.pathname; // Mendapatkan path URL
        //     const page = path.split('/').pop(); // Mendapatkan bagian terakhir dari path
        //     return page || 'home'; // Default ke 'home' jika path kosong
        // }

        // // Fetch data popup
        // fetch('/api/popup')
        //     .then(response => {
        //         if (!response.ok) {
        //             throw new Error('Network response was not ok');
        //         }
        //         return response.json();
        //     })
        //     .then(data => {
        //         if (data) {
        //             const currentPage = getCurrentPage(); // Halaman saat ini
        //             if (data.page.includes(currentPage)) { // Cek apakah halaman ada dalam daftar
        //                 console.log(data);

        //                 // Set properti popup berdasarkan rasio gambar
        //                 const popupElement = document.getElementById('popup-ads');
        //                 const imageAdsElement = document.getElementById('imageAds');
        //                 document.getElementById('image-ads').src = './storage/' + data.images_ads;

        //                 if (data.image_ratio === "landscape") {
        //                     imageAdsElement.classList.add('landscape');
        //                     imageAdsElement.classList.remove('portrait');
        //                 } else if (data.image_ratio === "portrait") {
        //                     imageAdsElement.classList.add('portrait');
        //                     imageAdsElement.classList.remove('landscape');
        //                 }

        //                 // Tampilkan popup
        //                 popupElement.style.display = 'flex';

        //                 // Tentukan metode penutupan berdasarkan checkbox
        //                 const closeWithIcon = data.close_with_icon;
        //                 const closeWithClickAnywhere = data.close_with_click_anywhere;

        //                 if (closeWithClickAnywhere) {
        //                     popupElement.onclick = function(event) {
        //                         if (event.target === popupElement) {
        //                             closePopup();
        //                         }
        //                     };
        //                 } else {
        //                     popupElement.onclick = null; // Nonaktifkan klik di luar
        //                 }

        //                 // Jika bisa ditutup dengan ikon, pastikan ikon ada
        //                 if (closeWithIcon) {
        //                     const closeIcon = document.getElementById('close-icon');
        //                     closeIcon.style.display = 'block'; // Tampilkan ikon
        //                     closeIcon.onclick = closePopup;
        //                 } else {
        //                     document.getElementById('close-icon').style.display =
        //                         'none'; // Sembunyikan ikon
        //                 }
        //             }
        //         }
        //     })
        //     .catch(error => {
        //         console.error('Error fetching popup data:', error);
        //     });

        // // Menutup popup ketika area di luar popup (background) diklik
        // document.getElementById('popup-ads').onclick = function(event) {
        //     if (event.target === document.getElementById('popup-ads')) {
        //         closePopup();
        //     }
        // };

        // function closePopup() {
        //     document.getElementById('popup-ads').style.display = 'none';
        // }
        // Fungsi untuk mendapatkan nama halaman saat ini
        function getCurrentPage() {
            const path = window.location.pathname; // Mendapatkan path URL
            const page = path.split('/').pop(); // Mendapatkan bagian terakhir dari path
            return page || 'home'; // Default ke 'home' jika path kosong
        }

        // Fetch data popup
        fetch('/api/popup')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.showPopup && data.data) {
                    const popupData = data.data;
                    const currentPage = getCurrentPage(); // Halaman saat ini

                    if (popupData.page.includes(currentPage) || popupData.page.includes(
                            'all')) { // Cek apakah halaman ada dalam daftar
                        console.log(popupData);

                        // Set properti popup berdasarkan rasio gambar
                        const popupElement = document.getElementById('popup-ads');
                        const imageAdsElement = document.getElementById('imageAds');
                        // Logika has_button
                        const hasButton = popupData.has_button;
                        const anchorElement = document.getElementById('linkAds');
                        const buttonElement = document.getElementById('btn-link');
                        const anchorElementBtn = document.getElementById('linkAdsBtn');
                        document.getElementById('image-ads').src = './storage/' + popupData.images_ads;

                        const getTopLandscapeValue = () => {
                            if (window.matchMedia("(max-width: 320px)").matches) {
                                return '114%';
                            } else if (window.matchMedia("(max-width: 375px)").matches) {
                                return '112%';
                            } else if (window.matchMedia("(max-width: 480px)").matches) {
                                return '112%';
                            } else if (window.matchMedia("(max-width: 768px)").matches) {
                                return '109%';
                            } else if (window.matchMedia("(max-width: 1024px)").matches) {
                                return '108%';
                            } else {
                                return '110%';
                            }
                        };

                        const getTopPortraitValue = () => {
                            if (window.matchMedia("(max-width: 320px)").matches) {
                                return '109%';
                            } else if (window.matchMedia("(max-width: 375px)").matches) {
                                return '110%';
                            } else if (window.matchMedia("(max-width: 480px)").matches) {
                                return '109%';
                            } else if (window.matchMedia("(max-width: 768px)").matches) {
                                return '110%';
                            } else if (window.matchMedia("(max-width: 1024px)").matches) {
                                return '108%';
                            } else {
                                return '107%';
                            }
                        };

                        const topValueLandscape = getTopLandscapeValue();
                        const topValuePortrait = getTopPortraitValue();

                        if (popupData.image_ratio === "landscape") {
                            imageAdsElement.classList.add('landscape');
                            imageAdsElement.classList.remove('portrait');
                            buttonElement.style.top = topValueLandscape;
                        } else if (popupData.image_ratio === "portrait") {
                            imageAdsElement.classList.add('portrait');
                            buttonElement.style.top = topValuePortrait;
                            imageAdsElement.classList.remove('landscape');
                        }

                        // Definisikan fungsi di cakupan global
                        const getTRLandscapeValues = () => {
                            if (window.matchMedia("(max-width: 320px)").matches) {
                                return {
                                    topIconLandscape: '34%',
                                    rightIconLandscape: '3%'
                                };
                            } else if (window.matchMedia("(max-width: 375px)").matches) {
                                return {
                                    topIconLandscape: '31%',
                                    rightIconLandscape: '3%'
                                };
                            } else if (window.matchMedia("(max-width: 480px)").matches) {
                                return {
                                    topIconLandscape: '31%',
                                    rightIconLandscape: '8%'
                                };
                            } else if (window.matchMedia("(max-width: 768px)").matches) {
                                return {
                                    topIconLandscape: '21%',
                                    rightIconLandscape: '14%'
                                };
                            } else if (window.matchMedia("(max-width: 1024px)").matches) {
                                return {
                                    topIconLandscape: '20%',
                                    rightIconLandscape: '22%'
                                };
                            } else {
                                return {
                                    topIconLandscape: '23%',
                                    rightIconLandscape: '28%'
                                };
                            }
                        };

                        const getTRPortraitValues = () => {
                            if (window.matchMedia("(max-width: 320px)").matches) {
                                return {
                                    topIconPortrait: '30%',
                                    rightIconPortrait: '10%'
                                };
                            } else if (window.matchMedia("(max-width: 375px)").matches) {
                                return {
                                    topIconPortrait: '29%',
                                    rightIconPortrait: '14%'
                                };
                            } else if (window.matchMedia("(max-width: 480px)").matches) {
                                return {
                                    topIconPortrait: '27%',
                                    rightIconPortrait: '16%'
                                };
                            } else if (window.matchMedia("(max-width: 768px)").matches) {
                                return {
                                    topIconPortrait: '23%',
                                    rightIconPortrait: '28%'
                                };
                            } else if (window.matchMedia("(max-width: 1024px)").matches) {
                                return {
                                    topIconPortrait: '19%',
                                    rightIconPortrait: '31%'
                                };
                            } else {
                                return {
                                    topIconPortrait: '16%',
                                    rightIconPortrait: '32%'
                                };
                            }
                        };

                        // Tampilkan popup
                        popupElement.style.display = 'flex';
                        console.log(getTRPortraitValues);

                        // Tentukan metode penutupan berdasarkan checkbox
                        const closeWithIcon = popupData.close_with_icon;
                        const closeWithClickAnywhere = popupData.close_with_click_anywhere;

                        if (closeWithClickAnywhere) {
                            popupElement.onclick = function(event) {
                                if (event.target === popupElement) {
                                    closePopup();
                                }
                            };
                        } else {
                            popupElement.onclick = null; // Nonaktifkan klik di luar
                        }
                        if (popupData.image_ratio === "landscape") {
                            if (closeWithIcon) {
                                const closeIcon = document.getElementById('close-icon');
                                if (!closeIcon) {
                                    console.error("Element with ID 'close-icon' not found");
                                    return;
                                }

                                const {
                                    topIconPortrait,
                                    rightIconPortrait
                                } = getTRPortraitValues();
                                const {
                                    topIconLandscape,
                                    rightIconLandscape
                                } = getTRLandscapeValues();

                                closeIcon.style.display = 'block';
                                closeIcon.style.top = topIconLandscape;
                                closeIcon.style.right = rightIconLandscape;
                                closeIcon.onclick = closePopup;
                            } else {
                                document.getElementById('close-icon').style.display = 'none';
                            }
                        } else if (popupData.image_ratio === "portrait") {
                            if (closeWithIcon) {
                                const closeIcon = document.getElementById('close-icon');
                                if (!closeIcon) {
                                    console.error("Element with ID 'close-icon' not found");
                                    return;
                                }

                                const {
                                    topIconPortrait,
                                    rightIconPortrait
                                } = getTRPortraitValues();
                                const {
                                    topIconLandscape,
                                    rightIconLandscape
                                } = getTRLandscapeValues();

                                closeIcon.style.display = 'block';
                                closeIcon.style.top = topIconPortrait;
                                closeIcon.style.right = rightIconPortrait;
                                closeIcon.onclick = closePopup;
                            } else {
                                document.getElementById('close-icon').style.display = 'none';
                            }
                        }




                        if (hasButton) {
                            // imageAdsElement.style.display = 'none';
                            anchorElement.removeAttribute('href'); // Hilangkan link pada anchor
                            buttonElement.style.display = 'inline-block'; // Tampilkan tombol
                            anchorElementBtn.href = popupData.link_ads; // Set href ke link_ads
                        } else {
                            imageAdsElement.style.display = 'inline-block'; // Tampilkan gambar dalam anchor
                            anchorElement.href = popupData.link_ads; // Set href ke link_ads
                            buttonElement.style.display = 'none'; // Sembunyikan tombol
                            console.log(popupData.link_ads);

                        }
                    }
                }
            })
            .catch(error => {
                console.error('Error fetching popup data:', error);
            });

        // Fungsi untuk menutup popup
        function closePopup() {
            document.getElementById('popup-ads').style.display = 'none';
        }

    });
</script>

</html>
