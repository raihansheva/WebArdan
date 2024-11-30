@extends('layout.main')
<link rel="stylesheet" href="css/StyleContent/home.css">
<link rel="stylesheet" href="css/ResponsiveStyle/responsiveHome.css">
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@section('content')
    <section class="section-banner">
        <div class="area-banner">
            <swiper-container class="mySwiper" centered-slides="true" autoplay-delay="2000"
                autoplay-disable-on-interaction="false" loop="true">
                @foreach ($banner as $list)
                    <swiper-slide><img class="image-banner" src="./storage/{{ $list->image_banner }}"
                            alt=""></swiper-slide>
                @endforeach
            </swiper-container>
        </div>
    </section>
    <section class="page-1" id="home">
        <div class="area-streaming">
            <div class="header-streaming">
                <h1 class="title-streaming">ON AIR</h1>
            </div>
            <div class="content-streaming">
                <div class="contentS-kiri">
                    @foreach ($stream as $streamList)
                        <div class="card-A">
                            <div class="card-body">
                                <img class="image-streaming" src="./storage/{{ $streamList->image_stream }}">
                                <div class="btn-play-streaming" id="BtnStream"
                                    data-audio-src="{{ $streamList->stream_audio_url }}">
                                    <span class="material-symbols-rounded">play_arrow</span>
                                </div>

                                <!-- Ganti dengan MediaElement.js -->
                                <audio class="audio-streaming" id="audio-streaming" preload="auto" crossorigin="anonymous" >
                                    <source type="audio/mpeg" src="{{ $streamList->stream_audio_url }}" />
                                </audio>
                            </div>
                            <div class="card-header">
                                <div class="view" id="btn-tonton">
                                    <p class="text-watchS">Tonton Siaran</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-B">
                            <div class="card-body-B">
                                <div class="video-container">
                                    <!-- Elemen video untuk memutar HLS -->
                                    <video id="hlsPlayer" controls width="640" height="360"></video>
                                </div>
                                <!-- Elemen untuk menyimpan URL HLS menggunakan data-pl -->
                                <div id="player" data-pl="{{ $streamList->stream_video_url }}" style="display: none;">
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="view-B">
                                    <p class="text-watchS-B">Dengar Siaran</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="contentS-kanan">
                    {{-- @if ($streamUpcoming)
                        @foreach ($streamUpcoming as $streamUpcomingList) --}}
                    <div class="area-nextP">
                        <div class="area-title-nextP">
                            <p class="title-nextP"> Next Program</p>
                        </div>
                        <div class="area-thumbnail-nextP">
                            <img class="image-stream-upcoming" id="program-image" src="" alt="">
                        </div>
                    </div>
                    {{-- @endforeach
                    @else
                    @endif --}}
                </div>
            </div>
        </div>
    </section>
    <section class="page-3" id="info-news">
        <div class="area-info-news">
            <div class="line-info"></div>
            <div class="area-content-info-news">
                <div class="area-content-news">
                    <div class="header-news">
                        <h1 class="title-news">Top Info</h1>
                    </div>
                    <div class="content-news">
                        @foreach ($top_info as $topInfoList)
                            <a class="link-box-news" href="/info-detail/{{ $topInfoList->slug }}">
                                <div class="box-news">
                                    <div class="area-image">
                                        <img class="image-top-info" src="./storage/{{ $topInfoList->image_info }}"
                                            alt="">
                                    </div>
                                    <div class="area-text">
                                        <p class="desk-news">{{ $topInfoList->deskripsi_info }}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="area-content-info">
                    <div class="header-info">
                        <h1 class="title-info">More News</h1>
                    </div>
                    <div class="content-info">
                        @foreach ($taginfo as $tagInfoList)
                            <div class="box-info">
                                <a href="/info-tag/{{ $tagInfoList->nama_tag }}">
                                    <div class="area-tag-info">
                                        <h3 class="tag-info">#{{ $tagInfoList->nama_tag }}</h3>
                                    </div>
                                    @if ($tagInfoList->info->isNotEmpty())
                                        <img class="image-info"
                                            src="{{ asset('storage/' . $tagInfoList->info->first()->image_info) }}"
                                            alt="">
                                    @else
                                        <p>Tidak ada info untuk tag ini.</p>
                                    @endif
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="area-bottom-info">
                        <div class="box-title-bottom">
                            <a href="/info-news">
                                <h1 class="title-bottom-info">Show more</h1>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="page-2" id="program">
        <div class="area-program">
            <div class="area-header-program">
                <h1 class="title-program">PROGRAM</h1>
            </div>
            <div class="area-content-program">
                <div class="area-tombol">
                    <div class="tombol-kiri"></div>
                    <div class="tombol-kanan"></div>
                </div>
                <swiper-container class="area-content-box-program" loop="true" autoplay-delay="2500"
                    autoplay-disable-on-interaction="false"
                    breakpoints='{
                        "480": { "slidesPerView": 1 },
                        "768": { "slidesPerView": 2 },
                        "1024": { "slidesPerView": 3 },
                        "1280": { "slidesPerView": 4 },
                        "2560": { "slidesPerView" : 4}
                    }'
                    space-between="20">
                    @foreach ($program as $programList)
                        <swiper-slide style="background-image: url('./storage/{{ $programList->image_program }}') "
                            class="box-program" data-title="{{ $programList->judul_program }}"
                            data-description="{{ $programList->deskripsi_program }}"
                            data-time="{{ $programList->jam_mulai }} - {{ $programList->jam_selesai }}"
                            onclick="showPopup(this)">
                            {{-- <img src="./storage/{{ $programList->image_program }}" alt=""> --}}
                        </swiper-slide>
                    @endforeach
                </swiper-container>
            </div>
        </div>
        <div id="popup" class="popup" style="display: none;" onclick="closePopupOutside(event)">
            <div class="popup-content">
                <span class="close" onclick="closePopup()">&times;</span>
                <div class="area-info-program">
                    <p class="desk-program">Program Description</p> <!-- Pastikan elemen ini ada -->
                    <h2 class="title-box-program">Program Title</h2> <!-- Pastikan elemen ini ada -->
                    <p class="jam-program">Program Time</p> <!-- Pastikan elemen ini ada -->
                </div>
            </div>
        </div>
    </section>

    <section class="page-ig-twitter" id="ig-twitter">
        <div class="area-ig-twitter">
            <div class="line-ig-twitter"></div>
            <div class="area-content-ig-twitter">
                <div class="area-content-feed-instagram">
                    <div class="header-feed-instagram">
                        <h1 class="title-feed-instagram">Feed Instagram</h1>
                    </div>
                    <div class="content-feed-instagram">
                        {{-- <div class="area-tombol">
                            <div class="tombol-kiri"></div>
                            <div class="tombol-kanan"></div>
                        </div> --}}
                        <swiper-container class="area-content-box-feed-instagram" loop="true" autoplay-delay="2500"
                            autoplay-disable-on-interaction="false"
                            breakpoints='{
                                    "480": { "slidesPerView": 1 },
                                    "768": { "slidesPerView": 3 },
                                    "1024": { "slidesPerView": 3 },
                                    "1280": { "slidesPerView": 4 },
                                    "2560": { "slidesPerView" : 4}
                                }'
                            space-between="20">
                            <swiper-slide class="box-feed-instagram" data-title="" data-description="" data-time=""
                                onclick="showPopupFeed(this)">
                            </swiper-slide>
                            <swiper-slide class="box-feed-instagram" data-title="" data-description="" data-time=""
                                onclick="showPopupFeed(this)">
                            </swiper-slide>
                            <swiper-slide class="box-feed-instagram" data-title="" data-description="" data-time=""
                                onclick="showPopupFeed(this)">
                            </swiper-slide>
                            <swiper-slide class="box-feed-instagram" data-title="" data-description="" data-time=""
                                onclick="showPopupFeed(this)">
                            </swiper-slide>
                            <swiper-slide class="box-feed-instagram" data-title="" data-description="" data-time=""
                                onclick="showPopupFeed(this)">
                            </swiper-slide>
                            <swiper-slide class="box-feed-instagram" data-title="" data-description="" data-time=""
                                onclick="showPopupFeed(this)">
                            </swiper-slide>
                            <swiper-slide class="box-feed-instagram" data-title="" data-description="" data-time=""
                                onclick="showPopupFeed(this)">
                            </swiper-slide>
                        </swiper-container>
                    </div>
                </div>
                <div id="popupFeed" class="popup-feed" style="display: none;" onclick="closePopupOutsideFeed(event)">
                    <div class="popup-content-feed">
                        <span class="close" onclick="closePopupFeed()">&times;</span>
                        <div class="area-info-feed">

                        </div>
                    </div>
                </div>
                <div class="area-content-twitter">
                    {{-- <div class="header-news">
                        <h1 class="title-news">Top Info</h1>
                    </div>
                    <div class="content-news">
                        @foreach ($top_info as $topInfoList)
                            <div class="box-news">
                                <div class="area-image">
                                    <img class="image-top-info" src="./storage/{{ $topInfoList->image_info }}"
                                        alt="">
                                </div>
                                <div class="area-text">
                                    <p class="desk-news">{{ $topInfoList->deskripsi_info }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div> --}}
                </div>
            </div>
        </div>
    </section>

    <section class="page-4" id="event">
        <div class="area-event">
            <div class="line-event"></div>
            <div class="header-event">
                <h1 class="title-event">EVENT</h1>
            </div>
            <div class="area-content-event">
                <div class="area-content-event-kiri">
                    @foreach ($event_soon as $eventSoonList)
                        <div class="content-event-CD" onclick="showPopupEvent(this)"
                            data-description="{{ $eventSoonList->deskripsi_event }}"
                            data-date="{{ \Carbon\Carbon::parse($eventSoonList->date_event)->format('d F Y') }}"
                            style="background-image: url('./storage/{{ $eventSoonList->image_event }}')">
                            <span id="dataTime" style="display: none">{{ $eventSoonList->time_countdown }}</span>
                            <div class="area-countdown">
                                <div class="countdown">
                                    <div class="time-countdown">
                                        <h2 class="timer" id="days"></h2>
                                        <span class="title-timer">Days</span>
                                    </div>
                                    <div class="time-countdown">
                                        <h2 class="timer" id="hours"></h2>
                                        <span class="title-timer">Hours</span>
                                    </div>
                                    <div class="time-countdown">
                                        <h2 class="timer" id="minutes"></h2>
                                        <span class="title-timer">Minutes</span>
                                    </div>
                                    <div class="time-countdown">
                                        <h2 class="timer" id="seconds"></h2>
                                        <span class="title-timer">Second</span>
                                    </div>
                                </div>
                                <div class="area-days-date">
                                    <div class="box-days-date">
                                        <h3 class="date-month">
                                            {{ \Carbon\Carbon::parse($eventSoonList->date_event)->format('d F Y') }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="area-content-event-kanan">
                    @foreach ($event_upcoming as $eventUpcomingList)
                        <div class="content-event"
                            style="background-image: url('./storage/{{ $eventUpcomingList->image_event }}')"
                            onclick="showPopupEvent(this)" data-description="{{ $eventUpcomingList->deskripsi_event }}"
                            data-date="{{ \Carbon\Carbon::parse($eventUpcomingList->date_event)->format('d F Y') }}">
                            <div class="area-days-date-right">
                                <div class="content-days-date-right">
                                    <div class="box-days-date-right">
                                        <h3 class="date-month-right">
                                            {{ \Carbon\Carbon::parse($eventUpcomingList->date_event)->format('d F Y') }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div id="popupEvent" class="popup-event" onclick="closePopupOutsideEvent(event)">
                        <div class="popup-content-event">
                            <div class="area-info-event">
                                <p class="desk-event"></p>
                                <h2 class="title-box-event"></h2>
                                <a href="/event">
                                    <p class="link-event">See detail</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="page-5" id="podcast-video">
        <div class="area-podcast-video">
            <div class="area-content-PV">
                <div class="area-content-podcast">
                    <div class="header-podcast">
                        <div class="area-title-podcast">
                            <h1 class="title-podcast">Podcast</h1>
                            <img class="logo-podcast" src="image/podcast.png" alt="">
                        </div>
                        <div class="area-text-podcast">
                            <a href="/podcast">
                                <h1 class="text-podcast">Other podcast</h1>
                            </a>
                        </div>
                    </div>
                    <div class="content-podcast">
                        @foreach ($podcast as $podcastList)
                            <div class="card-podcast">
                                <div class="card-body-podcast">
                                    <div class="head-body-podcast">
                                        <div class="genre">
                                            <h1 class="title-genre">{{ $podcastList->genre_podcast }}</h1>
                                        </div>
                                        <div class="area-card-text">
                                            <h1 class="card-text-podcast">{{ $podcastList->judul_podcast }}</h1>
                                        </div>
                                    </div>
                                    <div class="card-image-podcast">
                                        <img src="./storage/{{ $podcastList->image_podcast }}" alt=""
                                            class="image-podcast">
                                    </div>
                                </div>
                                <div class="card-header-podcast">
                                    <div class="author-podcast">
                                    </div>
                                    <a class="link-podcast" href="/detail-podcast/{{ $podcastList->slug }}">
                                        <div class="view-podcast">
                                            <p class="text-watch-podcast">View Podcast</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="line-PV"></div>
                <div class="area-content-video">
                    <div class="area-header-video">
                        <h1 class="title-video">Youtube Video</h1>
                    </div>
                    <div class="content-video" id="content-video">
                        @foreach ($videos as $video)
                            <div class="box-video" data-video-id="{{ $video['snippet']['resourceId']['videoId'] }}">
                                <img class="video-thumbnail"
                                    src="https://img.youtube.com/vi/{{ $video['snippet']['resourceId']['videoId'] }}/hqdefault.jpg"
                                    alt="Thumbnail">
                                <div class="btn-play-video"
                                    onclick="showPopupYT('{{ $video['snippet']['resourceId']['videoId'] }}')">
                                    <span class="material-symbols-rounded">play_arrow</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="popup-player-yt" id="popup-player" style="display:none;">
                        <div class="popup-content-yt">
                            {{-- <span id="close-popup" onclick="hidePopup()">X</span> --}}
                            <div id="player-yt"></div>
                        </div>
                    </div>
                    <div class="link-text-video">
                        <a href="/ardan-youtube">
                            <h1 class="text-video">See more</h1>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
    <section class="page-6" id="announcer">
        <div class="area-announcer">
            {{-- <div class="area-svg">
                <!-- SVG default untuk media lebih dari 1024px -->
                <svg class="svg-large" width="434" height="667" viewBox="0 0 434 667" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.5015 596.014L17.5015 46.9919" stroke="#FFDB00" stroke-width="35"
                        stroke-linecap="round" />
                    <path d="M68.0015 610L67.5265 18.0004" stroke="#FFDB00" stroke-width="35" stroke-linecap="round" />
                    <path d="M123.501 604.001L123.501 64.0012" stroke="#FFDB00" stroke-width="35"
                        stroke-linecap="round" />
                    <path d="M181.001 627.003L181.001 47.0032" stroke="#FFDB00" stroke-width="35"
                        stroke-linecap="round" />
                    <path d="M251.255 590L251.255 27.0034" stroke="#FFDB00" stroke-width="35" stroke-linecap="round" />
                    <path d="M309.001 616L309.001 47.0005" stroke="#FFDB00" stroke-width="35" stroke-linecap="round" />
                    <path d="M371.001 649L371.001 62.0005" stroke="#FFDB00" stroke-width="35" stroke-linecap="round" />
                    <path d="M415.533 610.001L415.533 81.9948" stroke="#FFDB00" stroke-width="35"
                        stroke-linecap="round" />
                </svg>

                <!-- SVG untuk media dengan ukuran 1024px atau kurang -->
                <svg class="svg-small" width="332" height="510" viewBox="0 0 332 510" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 455.526L14 36.1455" stroke="#FFDB00" stroke-width="26.7353" stroke-linecap="round" />
                    <path d="M52.5752 466.209L52.2124 14" stroke="#FFDB00" stroke-width="26.7353"
                        stroke-linecap="round" />
                    <path d="M94.9697 461.626L94.9697 49.1384" stroke="#FFDB00" stroke-width="26.7353"
                        stroke-linecap="round" />
                    <path d="M138.892 479.197L138.892 36.1542" stroke="#FFDB00" stroke-width="26.7353"
                        stroke-linecap="round" />
                    <path d="M192.557 450.932V20.8771" stroke="#FFDB00" stroke-width="26.7353" stroke-linecap="round" />
                    <path d="M236.667 470.792L236.667 36.1521" stroke="#FFDB00" stroke-width="26.7353"
                        stroke-linecap="round" />
                    <path d="M284.027 496L284.027 47.6102" stroke="#FFDB00" stroke-width="26.7353"
                        stroke-linecap="round" />
                    <path d="M318.043 466.209L318.043 62.8831" stroke="#FFDB00" stroke-width="26.7353"
                        stroke-linecap="round" />
                </svg>

                <svg class="svg-small-mobile" width="259" height="452" viewBox="0 0 259 452" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 404.892L11 30.7564" stroke="#FFDB00" stroke-width="20.8121" stroke-linecap="round" />
                    <path d="M41.0288 414.423L40.7464 10.9999" stroke="#FFDB00" stroke-width="20.8121"
                        stroke-linecap="round" />
                    <path d="M74.0308 410.335L74.0308 42.3475" stroke="#FFDB00" stroke-width="20.8121"
                        stroke-linecap="round" />
                    <path d="M108.222 426.01L108.222 30.7641" stroke="#FFDB00" stroke-width="20.8121"
                        stroke-linecap="round" />
                    <path d="M149.998 400.794V17.1352" stroke="#FFDB00" stroke-width="20.8121" stroke-linecap="round" />
                    <path d="M184.335 418.512L184.335 30.7623" stroke="#FFDB00" stroke-width="20.8121"
                        stroke-linecap="round" />
                    <path d="M221.203 441L221.203 40.9842" stroke="#FFDB00" stroke-width="20.8121"
                        stroke-linecap="round" />
                    <path d="M247.683 414.423L247.683 54.6094" stroke="#FFDB00" stroke-width="20.8121"
                        stroke-linecap="round" />
                </svg>
            </div> --}}
            <div class="area-content-announcer">
                {{-- <img class="logo-announcer" src="image/micAnnouncer.png" alt=""> --}}
                <div class="header-announcer">
                    <h1 class="title-announcer">Announcer</h1>
                </div>
                <div class="content-announcer">
                    <div class="area-tombol-announcer">
                        <div class="tombol-kiri-announcer"></div>
                        <div class="tombol-kanan-announcer"></div>
                    </div>
                    <swiper-container class="area-content-box-announcer" loop="true" autoplay-delay="2500"
                        autoplay-disable-on-interaction="false"
                        breakpoints='{
                        "320": { "slidesPerView": 1 },
                        "375": { "slidesPerView": 1 },
                        "480": { "slidesPerView": 1 },
                        "768": { "slidesPerView": 2 },
                        "1024": { "slidesPerView": 3 },
                        "1280": { "slidesPerView": 5 },
                        "2560": { "slidesPerView" : 5}
                    }'
                        space-between="20">
                        @foreach ($announcer as $announcerList)
                            <swiper-slide class="box-announcer" data-bio="{{ strip_tags($announcerList->bio) }}"
                                data-image="./storage/{{ $announcerList->image_announcer }}"
                                data-name="{{ $announcerList->name_announcer }}"
                                data-ig="{{ $announcerList->link_instagram }}"
                                data-tiktok="{{ $announcerList->link_tiktok }}"
                                data-twitter="{{ $announcerList->link_twitter }}" style="background-image: url('')"
                                onclick="showPopupAnnouncer(this)
                            ">
                                <img class="image-announcer" src="./storage/{{ $announcerList->image_announcer }}"
                                    alt="">
                                <div class="area-profile-announcer">
                                    {{-- @if ($announcerList->link_instagram)
                                        <a href="{{ $announcerList->link_instagram }}" target="_blank">
                                            <i class='bx bxl-instagram'></i>
                                        </a>
                                    @endif

                                    @if ($announcerList->link_facebook)
                                        <a href="{{ $announcerList->link_facebook }}" target="_blank">
                                            <i class='bx bxl-facebook'></i>
                                        </a>
                                    @endif

                                    @if ($announcerList->link_twitter)
                                        <a href="{{ $announcerList->link_twitter }}" target="_blank">
                                            <i class='bx bxl-twitter'></i>
                                        </a>
                                    @endif --}}
                                    {{-- <div class="area-name-announcer"> --}}
                                    {{-- <h3 class="name-announcer">{{ $announcerList->name_announcer }}</h3> --}}
                                    {{-- </div> --}}
                                </div>
                            </swiper-slide>
                        @endforeach
                    </swiper-container>
                    <div id="popupAnnouncer" class="popup-announcer" style="display: none;"
                        onclick="closePopupOutsideAnnouncer(event)">
                        <div class="popup-content-announcer">
                            <span class="close" onclick="closePopupAnnouncer()">&times;</span>
                            <div class="area-info-announcer">
                                <div class="area-IA-kiri">
                                    <img class="popUp-image-announcer" src="" alt="">
                                </div>
                                <div class="area-IA-kanan">
                                    <div class="area-name-announcer">
                                        <h3 class="title-name-announcer">Nama :</h3>
                                        <h3 class="name-announcer"></h3>
                                    </div>
                                    <div class="area-sosmed">
                                        <h3 class="title-sosmed">Social Media :</h3>
                                        <div class="area-profile-announcer">
                                            <a href="" target="_blank" data-social="instagram">
                                                <i class='bx bxl-instagram'></i>
                                            </a>
                                            <a href="" target="_blank" data-social="tiktok">
                                                <i class='bx bxl-tiktok'></i>
                                            </a>
                                            <a href="" target="_blank" data-social="twitter">
                                                <i class='bx bxl-twitter'></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="area-bio">
                                        <h3 class="title-bio">Bio :</h3>
                                        <div class="content-bio">
                                            <p class="bio-announcer"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <section class="page-7" id="chart">
        <div class="line-announcer"></div>
        <div class="area-chart-artis">
            <div class="area-content-chart-artis">
                <div class="area-content-chart">
                    <div class="content-chart">
                        <div class="header-chart">
                            <h1 class="title-chart">ARDAN CHART</h1>
                        </div>
                        <div class="area-top-chart">
                            {{-- <div class="tab-chart active" data-tab="top-20">
                                <h3 class="text-tab">TOP 20</h3>
                            </div>
                            <div class="tab-chart" data-tab="flight-40">
                                <h3 class="text-tab">FLIGTH 40</h3>
                            </div>
                            <div class="tab-chart" data-tab="indie-7">
                                <h3 class="text-tab">INDIE 7</h3>
                            </div>
                            <div class="tab-chart" data-tab="persada-7">
                                <h3 class="text-tab">PERSADA 7</h3>
                            </div> --}}
                            @foreach ($kategori as $kategoriList)
                                <div class="tab-chart {{ $loop->first ? 'active' : '' }}"
                                    data-tab="{{ $kategoriList->id }}">
                                    <h3 class="text-tab">{{ strtoupper($kategoriList->nama_kategori) }}</h3>
                                </div>
                            @endforeach
                        </div>
                        @foreach ($kategori as $kategoriList)
                            <table class="chart {{ $loop->first ? '' : 'hidden' }}" id="{{ $kategoriList->id }}">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>ARTIST</th>
                                        <th>-</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kategoriList->charts as $index => $chart)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $chart->name }}</td>
                                            <td>
                                                <div class="btn-play-chart"
                                                    data-audio-src="./storage/{{ $chart->link_audio }}"
                                                    data-name="{{ $chart->name }}"
                                                    data-kategori="{{ $kategoriList->nama_kategori }}"
                                                    data-id="{{ $kategoriList->id }}">
                                                    <span class="material-symbols-rounded">play_arrow</span>
                                                </div>
                                                <audio src="" id="audio-chart" class="audio-chart"></audio>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endforeach
                        <div class="bottom-chart">
                            <a href="/chart">
                                <div class="area-btn-chart">
                                    <h1 class="text-btn-chart">All Chart</h1>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="area-content-artis">
                    <div class="header-artis">
                        <h1 class="title-artis">INFO ARTIS</h1>
                    </div>
                    <div class="content-artis">
                        @foreach ($artis as $artisList)
                            <a href="{{ url('info-news') }}#info-artis">
                                <div class="box-artis">
                                    <img class="image-artis" src="./storage/{{ $artisList->image_artis }}"
                                        alt="">
                                    <div class="area-bio-artis">
                                        <div class="artis-name">
                                            <p class="nama">{{ $artisList->judul_berita }}</p>
                                        </div>
                                        {{-- <div class="artis-bio">
                                            <p class="bio">{{ $artisList->bio }}</p>
                                        </div> --}}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                        {{-- <div id="popupArtis" class="popup-artis" style="display: none;"
                            onclick="closePopupOutsideArtis(event)">
                            <div class="popup-content-artis">
                                <span class="close" onclick="closePopupArtis()">&times;</span>
                                <div class="area-info-artis">

                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="page-8" id="schedule">
        <div class="area-schedule">
            <div class="area-content-schedule">
                <div class="header-schedule">
                    <h1 class="title-schedule">Schedule</h1>
                </div>
                <div class="top-content-schedule">
                    <div class="schedule" data-day="senin">
                        <p class="schedule-day">Monday</p>
                    </div>
                    <div class="schedule" data-day="selasa">
                        <p class="schedule-day">Tuesday</p>
                    </div>
                    <div class="schedule" data-day="rabu">
                        <p class="schedule-day">Wednesday</p>
                    </div>
                    <div class="schedule" data-day="kamis">
                        <p class="schedule-day">Thursday</p>
                    </div>
                    <div class="schedule" data-day="jumat">
                        <p class="schedule-day">Friday</p>
                    </div>
                    <div class="schedule" data-day="sabtu">
                        <p class="schedule-day">Saturday</p>
                    </div>
                    <div class="schedule" data-day="minggu">
                        <p class="schedule-day">Sunday</p>
                    </div>
                </div>
                <div class="content-schedule">
                    @foreach ($schedule as $scheduleList)
                        <div class="box-schedule hidden" data-day="{{ strtolower($scheduleList->hari) }}">
                            <img class="image-schedule-program"
                                src="./storage/{{ $scheduleList->program->image_program }}" alt="">
                            <div class="area-bio-schedule">
                                <div class="bio-schedule">
                                    <h4 class="nama-programS">{{ $scheduleList->program->judul_program }}</h4>
                                    <p class="jam-programS">Jam: {{ $scheduleList->jam_mulai }} -
                                        {{ $scheduleList->jam_selesai }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>



    {{-- audio player --}}
    {{-- <div class="audio-player-container">
        <svg id="visual" viewBox="0 0 900 600" width="1200" height="600" xmlns="http://www.w3.org/2000/svg">
            <path id="layer1" fill="#FF004D" stroke="#FF004D" stroke-width="2" stroke-linecap="round"></path>
        </svg>
        <div class="content">
            <div class="control-btn">
                <!-- <span class="material-symbols-rounded" id="repeat">repeat</span> -->
                <span class="material-symbols-rounded" id="prev">skip_previous</span>
                <div class="play-pause" id="play-pause">
                    <span class="btn-play material-symbols-rounded">play_arrow</span>
                </div>
                <span class="material-symbols-rounded" id="next">skip_next</span>
                <!-- <span class="material-symbols-rounded" id="shuffle">shuffle</span> -->
            </div>
            <div class="image-wrapper">
                <div class="music-image">
                    <img src="images/img1.jpg" />
                </div>
            </div>
            <div class="music-titles">
                <p class="name">Title music</p>
                <p class="artist">Titke music</p>
            </div>
            <div class="area-line">
                <div class="progress-details">
                    <div class="progress-bar">
                        <span></span>
                    </div>
                    <!-- <div class="time">
                                            <span class="current">0:00</span>
                                            <span class="final">5:30</span>
                                          </div> -->
                </div>
            </div>
            <div class="music-titles">
                <p class="name">Hamburger area</p>
            </div>
        </div>

        <audio src="music/music1.mp3" class="main-song" id="audio"></audio>
    </div> --}}
    {{-- ------- --}}
    {{-- <script src="js/playlist.js"></script> --}}
    <script src="js/home.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
    <script>
        // Function to fetch the next program's image
        async function fetchNextProgramImage() {
            try {
                const response = await fetch('/api/next-program-image');
                const data = await response.json();

                // Update the image source
                const programImage = document.getElementById('program-image');
                programImage.src = data.image; // Path langsung dari API
            } catch (error) {
                console.error('Error fetching next program image:', error);
            }
        }

        // Fetch image every 1 minute
        fetchNextProgramImage(); // Initial fetch
        setInterval(fetchNextProgramImage, 60000); // Refresh every 60 seconds
    </script>
@endsection
