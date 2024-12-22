@extends('layout.main')

@section('title', \App\Helpers\Settings::get('site_title', 'Default Site Title'))

@push('meta-seo')
    <meta name="description" content="{{ \App\Helpers\Settings::get('site_description', 'Default Site Title') }}">
    <meta name="keyword" content="{{ \App\Helpers\Settings::get('site_keyword', 'Default Site Title') }}">
@endpush

@push('Style.css')
    <link rel="stylesheet" href="{{ asset('css/StyleContent/home.css?v=' . time()) }}">
    <link rel="stylesheet" href="{{ asset('css/ResponsiveStyle/responsiveHome.css?v=' . time()) }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endpush

@livewireStyles
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
                {{-- <h1 class="title-streaming">ON AIR</h1> --}}
                <img src="../image/giphy.gif" alt="GIF Image" width="140" height="140">
                {{-- <p><a href="https://giphy.com/stickers/RTLNL-transparent-A2cYA4qIR4XasAYORu">via GIPHY</a></p> --}}
            </div>
            <div class="content-streaming">
                <div class="contentS-kiri">
                    {{-- @foreach ($stream as $streamList) --}}
                    <div class="card-A">
                        <div class="card-body">
                            <img class="image-streaming" src="./storage/{{ $streamAudio->image_stream }}">
                            <div class="btn-play-streaming" id="BtnStream" data-audio-src="{{ $streamAudio->stream_url }}">
                                <span class="material-symbols-rounded">play_arrow</span>
                            </div>

                            <!-- Ganti dengan MediaElement.js -->
                            {{-- <audio class="audio-streaming" id="audio-streaming" preload="auto" crossorigin="anonymous">
                                    <source type="audio/mpeg" src="{{ $streamList->stream_audio_url }}" />
                                </audio> --}}
                            {{-- <livewire:audio-player /> --}}
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
                                <!-- Video.js Player -->
                                @if (!empty($streamVideo->stream_url))
                                    <video id="videoPlayer" class="video-js" controls preload="auto"
                                        poster="./storage/{{ $streamVideo->image_stream }}" data-setup='{"fluid": true}'>
                                        <source src="{{ $streamVideo->stream_url }}" type="application/x-mpegURL" />
                                    </video>
                                @else
                                    <p>Streaming URL tidak tersedia.</p>
                                @endif
                                {{-- <video id="videoPlayer" class="video-js vjs-default-skin" controls width="640"
                                    height="360" data-setup='{}'>
                                    <!-- Format HLS untuk stream -->
                                    <source src="{{ $streamVideo->stream_url }}" type="application/x-mpegURL">
                                    <!-- HLS stream -->
                                    <p class="vjs-no-js">Untuk melihat video ini, aktifkan JavaScript atau gunakan browser
                                        lain yang mendukung HTML5.</p>
                                </video> --}}
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="view-B">
                                <p class="text-watchS-B">Dengar Siaran</p>
                            </div>
                        </div>
                    </div>
                    {{-- @endforeach --}}
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
                    <div class="area-top-info">
                        <div class="header-top-info">
                            <h1 class="title-top-info">Top Info</h1>
                        </div>
                        <div class="content-top-info">
                            @foreach ($top_info as $topInfoList)
                                <a class="link-box-top-info" href="/info-detail/{{ $topInfoList->slug }}">
                                    <div class="box-top-info">
                                        <div class="area-image-top-info">
                                            <img class="image-top-info" src="./storage/{{ $topInfoList->image_info }}"
                                                alt="">
                                        </div>
                                        <div class="line-top-info"></div>
                                        <div class="area-text-desk-top-info">
                                            <div class="area-tag">
                                                <p class="tag-top-info">{{ $topInfoList->tagInfo->nama_kategori }}</p>
                                            </div>
                                            <div class="area-text">
                                                <p class="desk-top-info">{{ $topInfoList->judul_info }}</p>
                                            </div>
                                            <div class="area-date">
                                                <p class="date-top-info">
                                                    {{ \Carbon\Carbon::parse($topInfoList->date_info)->translatedFormat('l, d F Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="header-news">
                        <h1 class="title-news">Info</h1>
                    </div>
                    <div class="content-news">
                        @foreach ($info as $InfoList)
                            <a class="link-box-news" href="/info-detail/{{ $InfoList->slug }}">
                                <div class="box-news">
                                    <div class="area-image">
                                        <img class="image-info" src="./storage/{{ $InfoList->image_info }}" alt="">
                                    </div>
                                    <div class="area-text-desk">
                                        <div class="area-tag">
                                            <p class="tag-news">{{ $InfoList->tagInfo->nama_kategori }}</p>
                                        </div>
                                        <div class="area-text">
                                            <p class="desk-news">{{ $InfoList->judul_info }}</p>
                                        </div>
                                        <div class="area-date">
                                            <p class="date-news">
                                                {{ \Carbon\Carbon::parse($InfoList->date_info)->translatedFormat('l, d F Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                </div>
                <div class="area-content-info">
                    <div class="area-trending-info">
                        <div class="header-trending-info">
                            <h1 class="title-trending-info">Trending Info</h1>
                        </div>
                        <div class="content-trending-info">
                            @foreach ($trending_info as $trendingInfoList)
                                <a class="link-box-trending-info" href="/info-detail/{{ $trendingInfoList->slug }}">
                                    <div class="box-trending-info">
                                        {{-- <div class="area-image-trending-info">
                                            <img class="image-trending-info" src="./storage/{{ $trendingInfoList->image_info }}"
                                                alt="">
                                        </div> --}}
                                        <div class="line-trending-info"></div>
                                        <div class="area-text-desk-trending-info">
                                            <div class="area-tag">
                                                <p class="tag-trending-info">
                                                    {{ $trendingInfoList->tagInfo->nama_kategori }}</p>
                                            </div>
                                            <div class="area-text">
                                                <p class="desk-trending-info">{{ $trendingInfoList->judul_info }}</p>
                                            </div>
                                            <div class="area-date">
                                                <p class="date-trending-info">
                                                    {{ \Carbon\Carbon::parse($trendingInfoList->date_info)->translatedFormat('l, d F Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="header-info">
                        <h1 class="title-info">Kategori Info</h1>
                    </div>
                    <div class="content-info">
                        @foreach ($kategoriInfo as $kategoriInfoList)
                            <div class="box-info">
                                <a href="/info-tag/{{ $kategoriInfoList->nama_kategori }}">
                                    <div class="area-tag-info">

                                        <h3 class="tag-info">#{{ $kategoriInfoList->nama_kategori }}</h3>
                                    </div>
                                    @if ($kategoriInfoList->info->isNotEmpty())
                                        <img class="image-info"
                                            src="{{ asset('storage/' . $kategoriInfoList->info->first()->image_info) }}"
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
                            data-description="{{ $programList->deskripsi_pendek }}"
                            data-time="{{ $programList->jam_mulai }} - {{ $programList->jam_selesai }}"
                            data-slugP="{{ $programList->slug }}" data-deskP="{{ $programList->deskripsi_program }}"
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
                    <a href="#" class="detail-link-program">
                        <p class="link-program">See detail</p>
                    </a>
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
                            data-description="{{ $eventSoonList->deskripsi_pendek }}"
                            data-date="{{ \Carbon\Carbon::parse($eventSoonList->date_event)->format('d F Y') }}"
                            style="background-image: url('./storage/{{ $eventSoonList->image_event }}')"
                            data-slug="{{ $eventSoonList->slug }}"
                            data-deskShort="{{ $eventSoonList->deskripsi_event }}">
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
                            onclick="showPopupEvent(this)" data-description="{{ $eventUpcomingList->deskripsi_pendek }}"
                            data-date="{{ \Carbon\Carbon::parse($eventUpcomingList->date_event)->format('d F Y') }}"
                            data-slug="{{ $eventUpcomingList->slug }}"
                            data-deskShort="{{ $eventUpcomingList->deskripsi_event }}">
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
                                <a href="#" class="detail-link">
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
                            <div class="card-podcast" data-slug="{{ $podcastList->slug }}">
                                <div class="card-body-podcast">
                                    {{-- <a class="link-podcast" href="/detail-podcast/{{ $podcastList->slug }}"> --}}
                                    <div class="head-body-podcast">
                                        <div class="genre">
                                            @if (is_array($podcastList->genre_podcast))
                                                @foreach ($podcastList->genre_podcast as $genre)
                                                    <h1 class="title-genre">{{ $genre }}</h1>
                                                @endforeach
                                            @else
                                                <h1 class="title-genre">-</h1>
                                            @endif
                                        </div>
                                        <div class="area-card-text">
                                            <h1 class="card-text-podcast">{{ $podcastList->judul_podcast }}</h1>
                                        </div>
                                    </div>
                                    <div class="card-image-podcast">
                                        <img src="./storage/{{ $podcastList->image_podcast }}" alt=""
                                            class="image-podcast">
                                    </div>
                                    {{-- </a> --}}
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
    {{-- <br> --}}
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
                        "425": { "slidesPerView": 2 },
                        "480": { "slidesPerView": 2 },
                        "768": { "slidesPerView": 3 },
                        "1024": { "slidesPerView": 4 },
                        "1280": { "slidesPerView": 5 },
                        "1960": { "slidesPerView": 5 },
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
                            <a href="/detail-info-artis/{{ $artisList->slug }}">
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
                        <div class="area-bottom-artis">
                            <div class="box-title-bottom-artis">
                                <a href="/info-artis">
                                    <h1 class="title-bottom-artis">See More</h1>
                                </a>
                            </div>
                        </div>
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
            <div class="top-content-schedule-mobile">
                <button id="prevDay" class="nav-button"><i class='bx bx-chevron-left'></i></button>
                <p id="currentDay" class="schedule-day-mobile"></p>
                <button id="nextDay" class="nav-button"><i class='bx bx-chevron-right'></i></i></button>
            </div>
            <div class="content-schedule-mobile">
                @foreach ($schedule as $scheduleList)
                    <div class="box-schedule-mobile hidden" data-day="{{ strtolower($scheduleList->hari) }}">
                        <img class="image-schedule-program" src="./storage/{{ $scheduleList->program->image_program }}"
                            alt="">
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
    @livewireScripts
    <script src="{{ asset('js/home.js?v=' . time()) }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Pilih semua elemen dengan class "card-podcast"
            const podcastCards = document.querySelectorAll(".card-podcast");

            podcastCards.forEach((card) => {
                card.addEventListener("click", () => {
                    // Ambil slug dari atribut data-slug
                    const slug = card.getAttribute("data-slug");

                    if (slug) {
                        // Redirect user ke halaman detail podcast sesuai slug
                        window.location.href = `/detail-podcast/${slug}`;
                    }
                });
            });

            var player = videojs("videoPlayer", {
                controls: true,
                autoplay: false,
                preload: "auto",
                fluid: true, // Membuat player fleksibel mengikuti ukuran kontainer
                aspectRatio: "16:9", // Rasio aspek untuk menjaga proporsi
                responsive: true,
            });

            let userInteracted = false; // Flag untuk memastikan interaksi pengguna pertama kali
            let isManualPiPActive = false; // Flag untuk melacak jika PiP diaktifkan secara manual

            // Deteksi apakah perangkat adalah iOS
            const isIOS = /iPhone|iPad|iPod/.test(navigator.userAgent) && !window.MSStream;

            // Fungsi untuk mengecek apakah elemen terlihat di viewport
            function isElementInViewport(el) {
                if (!el) return false;
                const rect = el.getBoundingClientRect();
                return rect.top >= 0 && rect.bottom <= window.innerHeight;
            }

            // Fungsi untuk mengaktifkan PiP jika video tidak terlihat dan PiP belum aktif
            async function activatePiPIfNeeded() {
                const videoElement = player.el().querySelector('video'); // Dapatkan elemen video dari player
                if (!videoElement) {
                    console.error("Video element tidak ditemukan");
                    return; // Keluar jika video element tidak ditemukan
                }

                // Jika perangkat adalah iOS, tidak mengaktifkan PiP otomatis
                if (isIOS) {
                    console.log("PiP otomatis tidak didukung di iOS");
                    return;
                }

                // Pastikan interaksi pengguna sudah terjadi, PiP belum aktif secara manual, dan video tidak terlihat
                if (
                    userInteracted &&
                    !isManualPiPActive &&
                    !document.pictureInPictureElement &&
                    !isElementInViewport(videoElement)
                ) {
                    if (!videoElement.paused) {
                        try {
                            await videoElement.requestPictureInPicture();
                            console.log("PiP diaktifkan otomatis");
                        } catch (err) {
                            console.error("Gagal mengaktifkan PiP:", err);
                        }
                    }
                }
            }

            // Fungsi untuk keluar dari PiP jika video kembali terlihat
            async function exitPiPIfNeeded() {
                const videoElement = player.el().querySelector('video'); // Dapatkan elemen video dari player
                if (document.pictureInPictureElement && videoElement && isElementInViewport(videoElement)) {
                    try {
                        await document.exitPictureInPicture();
                        console.log("Keluar dari PiP");
                    } catch (err) {
                        console.error("Gagal keluar dari PiP:", err);
                    }
                }
            }

            // Fungsi untuk menangani interaksi pengguna pertama kali
            function handleUserInteraction() {
                if (!userInteracted) {
                    userInteracted = true;
                    console.log("Interaksi pertama terdeteksi");
                }
            }

            // Fungsi untuk menangani event Picture-in-Picture
            function handlePiPEvents(videoElement) {
                videoElement.addEventListener("enterpictureinpicture", () => {
                    isManualPiPActive = true; // Menandai bahwa PiP diaktifkan secara manual
                    console.log("PiP diaktifkan secara manual");
                });

                videoElement.addEventListener("leavepictureinpicture", () => {
                    isManualPiPActive = false; // Menandai bahwa PiP tidak lagi aktif secara manual
                    console.log("PiP dimatikan");
                });
            }

            // Menambahkan event listener untuk interaksi pengguna pertama kali
            player.on("play", handleUserInteraction); // Gunakan event "play" dari Video.js

            // Menambahkan event listener untuk PiP
            const videoElement = player.el().querySelector('video');
            if (videoElement) {
                handlePiPEvents(videoElement);
            }

            // Panggil fungsi saat halaman dimuat, scroll, atau resize
            document.addEventListener("DOMContentLoaded", () => {
                activatePiPIfNeeded(); // Pastikan PiP diaktifkan jika video tidak terlihat
            });

            // Event listener untuk menangani scroll dan resize
            window.addEventListener("scroll", () => {
                activatePiPIfNeeded(); // Aktifkan PiP saat video tidak terlihat dan sedang diputar
                exitPiPIfNeeded(); // Keluar dari PiP jika video terlihat
            });

            window.addEventListener("resize", () => {
                activatePiPIfNeeded(); // Aktifkan PiP saat ukuran viewport berubah
                exitPiPIfNeeded(); // Keluar dari PiP jika video terlihat
            });

            // Tambahkan event listener untuk touch pada perangkat mobile
            if ("ontouchstart" in window) {
                window.addEventListener("touchstart", () => {
                    if (!userInteracted) {
                        handleUserInteraction();
                    }
                });
            }




            // Tombol "Tonton Siaran"
            tontonSiaranBtnA.addEventListener("click", function() {
                hideCard(cardA);
                pauseStreaming();
                setTimeout(() => {
                    player.play();
                    // handleUserInteraction();
                    showCard(cardB);
                }, 500);
            });

            // Tombol "Dengar Siaran"
            tontonSiaranBtnB.addEventListener("click", function() {
                hideCard(cardB);
                // Hentikan video
                player.pause();
                playStreaming();
                setTimeout(() => {
                    showCard(cardA);
                }, 500);
            });


        });
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
