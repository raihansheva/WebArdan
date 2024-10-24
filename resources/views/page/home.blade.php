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
                    <div class="card-A">
                        <div class="card-body">
                            <div class="btn-play-streaming">
                                <span class="material-symbols-rounded">play_arrow</span>
                            </div>
                        </div>
                        <div class="card-header">
                            <div class="author">
                            </div>
                            <div class="view" id="btn-tonton">
                                <p class="text-watchS">Tonton Siaran</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-B">
                        <div class="card-body-B">
                            <div class="video-container">
                                <div id="player" data-pl="PLFIM0718LjIVrOglQcS_ZHkT5T_27Cmea"></div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="view-B">
                                <p class="text-watchS-B">Dengar Siaran</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contentS-kanan">
                    <div class="area-nextP">
                        <div class="area-title-nextP">
                            <p class="title-nextP"> Next Program</p>
                        </div>
                        <div class="area-thumbnail-nextP">

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
                    autoplay-disable-on-interaction="false" slides-per-view="4" space-between="20">
                    @foreach ($program as $programList)
                        <swiper-slide style="background-image: url('./storage/{{ $programList->image_program }}') "
                            class="box-program" data-title="{{ $programList->judul_program }}"
                            data-description="{{ $programList->deskripsi_program }}"
                            data-time="{{ $programList->jam_program }}" onclick="showPopup(this)">
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
    <section class="page-3" id="info-news">
        {{-- <svg class="svg-ornamen" width="1480" height="566" viewBox="0 0 1440 566" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path opacity = "0.55" d="M-159 31C45.8 203.8 337 467 749 203C1217 31 1510.33 333.667 1557 535" stroke="#FFDB00"
                stroke-width="61" stroke-linecap="round" />
        </svg>
        <svg class="svg-ornamen" width="1150" height="655" viewBox="0 0 1440 655" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path opacity = "0.55"
                d="M-100.976 542.218C197.047 639.853 633.29 799.288 796.239 275.389C1072.62 -169.111 1538.86 35.701 1722.37 248.688"
                stroke="#ff5b00" stroke-width="22" stroke-linecap="round" />
        </svg> --}}
        <div class="area-info-news">
            <div class="line-info"></div>
            <div class="area-content-info-news">
                <div class="area-content-info">
                    <div class="header-info">
                        <h1 class="title-info">Info</h1>
                    </div>
                    <div class="content-info">
                        @foreach ($info as $infoList)
                            <div class="box-info" style="background-image: url('./storage/{{ $infoList->image_info }}')">
                                <div class="area-tag-info">
                                    <h3 class="tag-info">#{{ $infoList->tag_info }}</h3>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="area-bottom-info">
                        <a href="/info-news">
                            <h1 class="title-bottom-info">Show more</h1>
                        </a>
                    </div>
                </div>
                <div class="area-content-news">
                    <div class="header-news">
                        <h1 class="title-news">Top Info</h1>
                    </div>
                    <div class="content-news">
                        @foreach ($top_info as $topInfoList)
                            <div class="box-news">
                                <div class="area-image">
                                    <img class="image-top-info" src="./storage/{{ $topInfoList->image_info }}" alt="">
                                </div>
                                <div class="area-text">
                                    <p class="desk-news">{{ $topInfoList->deskripsi_info }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
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
                                    <img src="./storage/{{ $podcastList->image_podcast }}" alt="" class="image-podcast">
                                </div>
                            </div>
                            <div class="card-header-podcast">
                                <div class="author-podcast">
                                </div>
                                <a class="link-podcast" href="/detail-podcast/{{ $podcastList->id }}">
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
                        @foreach($videos as $video)
                        <div class="box-video" data-video-id="{{ $video['snippet']['resourceId']['videoId'] }}">
                            <div class="btn-play-video" onclick="showPopupYT('{{ $video['snippet']['resourceId']['videoId'] }}')">
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
                        autoplay-disable-on-interaction="false" slides-per-view="5" space-between="20">
                        <swiper-slide class="box-announcer"></swiper-slide>
                        <swiper-slide class="box-announcer"></swiper-slide>
                        <swiper-slide class="box-announcer"></swiper-slide>
                        <swiper-slide class="box-announcer"></swiper-slide>
                        <swiper-slide class="box-announcer"></swiper-slide>
                        <swiper-slide class="box-announcer"></swiper-slide>
                    </swiper-container>
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
                            <div class="tab-chart active" data-tab="top-20">
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
                            </div>
                        </div>
                        <table class="chart" id="top-20">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>ARTIST</th>
                                    <th>-</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>John Doe</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jane Smith</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Michael Brown</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Emily Davis</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Emily Davis</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="chart hidden" id="flight-40">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>ARTIST</th>
                                    <th>-</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Artist A</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Artist B</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Artist C</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Artist D</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Artist D</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="chart hidden" id="indie-7">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>ARTIST</th>
                                    <th>-</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Indie Artist 1</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Indie Artist 2</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Indie Artist 3</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Indie Artist 4</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Indie Artist 5</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="chart hidden" id="persada-7">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>ARTIST</th>
                                    <th>-</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Persada Artist 1</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Persada Artist 2</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Persada Artist 3</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Persada Artist 4</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Persada Artist 5</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
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
                        <div class="box-artis"></div>
                        <div class="box-artis"></div>
                        <div class="box-artis"></div>
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
                    <div class="schedule" data-day="monday">
                        <p class="schedule-day">Monday</p>
                    </div>
                    <div class="schedule" data-day="tuesday">
                        <p class="schedule-day">Tuesday</p>
                    </div>
                    <div class="schedule" data-day="wednesday">
                        <p class="schedule-day">Wednesday</p>
                    </div>
                    <div class="schedule" data-day="thursday">
                        <p class="schedule-day">Thursday</p>
                    </div>
                    <div class="schedule" data-day="friday">
                        <p class="schedule-day">Friday</p>
                    </div>
                    <div class="schedule" data-day="saturday">
                        <p class="schedule-day">Saturday</p>
                    </div>
                    <div class="schedule" data-day="sunday">
                        <p class="schedule-day">Sunday</p>
                    </div>
                </div>
                <div class="content-schedule">
                    <div class="box-schedule" data-day="monday"></div>
                    <div class="box-schedule" data-day="tuesday"></div>
                    <div class="box-schedule" data-day="wednesday"></div>
                    <div class="box-schedule" data-day="thursday"></div>
                    <div class="box-schedule" data-day="friday"></div>
                    <div class="box-schedule" data-day="saturday"></div>
                    <div class="box-schedule" data-day="sunday"></div>
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
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
@endsection
