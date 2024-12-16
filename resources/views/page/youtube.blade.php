@extends('layout.main')
<link rel="stylesheet" href="{{ asset('css/StyleContent/youtube.css?v=' . time()) }}">
<link rel="stylesheet" href="{{ asset('css/ResponsiveStyle/responsiveYoutube.css?v=' . time()) }}">
@section('content')
    <section class="page-youtube-1">
        <div class="area-thumbnail-youtube">
            <div class="area-image-thumbnail">
                <img class="banner-youtube" src="./storage/{{ $bannerYT['banner_youtube'] }}" alt="" srcset="">
            </div>
            <div class="area-title-thumbnail">
                <h2 class="title-thumbnail">{{ $bannerYT['title_banner_youtube'] }}</h2>
            </div>
        </div>
    </section>
    <section class="page-youtube-2">
        <div class="area-video-youtube">
            <div class="area-header-video">
                <div class="area-select-dropdown">
                    <p class="text-choose">Pilih Playlist</p>
                    <div class="area-input">
                        <div class="dropdownP">
                            <button id="dropdown-btn-playlist" class="dropdown-btn-search">Select Playlist</button>
                            <div id="playlist-dropdown" class="dropdown-playlist">
                                @foreach ($youtube as $youtubeList)
                                    <p class="dropdown-item" data-playlist-id="{{ $youtubeList->link_youtube }}"
                                        data-playlist-name="{{ $youtubeList->nama_playlist }}">
                                        {{ $youtubeList->nama_playlist }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="area-content-video">
                <div class="row video--container">
                    <div id="template__0" class="video--placeholder video--wrapper">
                        <!-- This is our repeated component that we'll clone  -->
                        <a class="video" href="#" data-video-id="VIDEO_ID_HERE">
                            <div class="video--thumbnail">
                                <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                    srcset="" sizes="(max-width: 992px) 480px, 320px">
                                <div class="video--thumbnail__overlays">
                                    <span></span>
                                </div>
                            </div>
                            <div class="video--details">
                                <div class="video--details__avatar">
                                    <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==">
                                </div>
                                <div class="video--details__meta">
                                    <h3 class="video--details__title"></h3>
                                    <h4 class="video--details__channelTitle"></h4>
                                    <div class="video--details__meta-data">
                                        <div class="video--details__meta-data-views"></div>
                                        <time class="video--details__meta-data-published"></time>
                                    </div>
                                    <div class="video--details__meta-data-duration"></div>
                                </div>
                            </div>
                        </a>
                        <!-- end clone -->
                    </div>
                </div>

                <!-- Modal for YouTube Video -->
                <div id="videoModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <iframe id="youtubePlayer" width="560" height="315" src="" frameborder="0"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            <div class="line-VNS"></div>
        </div>
    </section>
    <section class="page-youtube-3">
        <div class="area-event-news-streaming">
            <div class="area-content-VNS">
                <div class="area-content-VNS-kiri">
                    <div class="header-content-kiri">
                        <h2 class="title-event">Event</h2>
                    </div>
                    <div class="content-kiri-event">
                        <div class="area-event-mid">
                            @foreach ($event_soon as $eventSoonList)
                                <div class="box-event-mid" onclick="showPopupEvent(this)"
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
                                                    {{ \Carbon\Carbon::parse($eventSoonList->date_event)->format('d F Y') }}
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="area-event-bottom">
                            @foreach ($event_upcoming as $eventUpcomingList)
                                <div class="box-event"
                                    style="background-image: url('./storage/{{ $eventUpcomingList->image_event }}')"
                                    onclick="showPopupEvent(this)"
                                    data-description="{{ $eventUpcomingList->deskripsi_pendek }}"
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
                        </div>
                    </div>
                </div>
                <div id="popupEvent" class="popup-event" onclick="closePopupOutsideEvent(event)">
                    <div class="popup-content-event">
                        <div class="area-info-event">
                            {{-- <span class="close" onclick="closePopup()">&times;</span> --}}
                            <p class="desk-event"></p>
                            <h2 class="title-box-event"></h2>
                            <a href="#" class="detail-link">
                                <p class="link-event">See detail</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="area-content-VNS-kanan">
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
                                        <div class="area-text-desk-top-info">
                                            <div class="area-tag">
                                                @if (is_array($topInfoList->tag_info))
                                                    @foreach ($topInfoList->tag_info as $tag)
                                                        <h2 class="tag-top-info">#{{ $tag }}</h2>
                                                    @endforeach
                                                @else
                                                    <h2 class="tag-top-info">#-</h2>
                                                @endif
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
                    <div class="area-content-streaming">
                        <div class="header-streaming">
                            <h2 class="title-streaming">Streaming</h2>
                        </div>
                        <div class="content-streaming">
                            <div class="box-streaming">
                                <img class="image-streaming" src="./storage/{{ $streamAudio->image_stream }}">
                                <div class="btn-play-streaming" id="BtnStream"
                                    data-audio-src="{{ $streamAudio->stream_url }}">
                                    <span class="material-symbols-rounded">play_arrow</span>
                                </div>
                                {{-- <audio class="audio-streaming" id="audio-streaming" preload="auto">
                                    <source type="audio/mpeg" src="{{ $stream->stream_audio_url }}" />
                                </audio> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/youtube.js?v=' . time()) }}"></script>
@endsection
