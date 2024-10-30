@extends('layout.main')
<link rel="stylesheet" href="css/StyleContent/youtube.css">
<link rel="stylesheet" href="css/ResponsiveStyle/responsiveYoutube.css">
@section('content')
    <section class="page-youtube-1">
        <div class="area-thumbnail-youtube">
            <div class="area-image-thumbnail">
                
            </div>
            <div class="area-title-thumbnail">
                <h2 class="title-thumbnail">ARDAN ON YOUTUBE</h2>
            </div>
        </div>
    </section>
    <section class="page-youtube-2">
        <div class="area-video-youtube">
            <div class="area-header-video">
                <p class="text-choose">Choose Playlist</p>
                <div class="area-input">
                    <div class="dropdownP">
                        <button id="dropdown-btn-playlist" class="dropdown-btn-search">Select Playlist</button>
                        <div id="playlist-dropdown" class="dropdown-playlist">
                            @foreach ($youtube as $youtubeList)
                            <p class="dropdown-item" data-playlist-id="{{ $youtubeList->link_youtube }}" data-playlist-name="{{ $youtubeList->nama_playlist }}">{{ $youtubeList->nama_playlist }}</p>
                        @endforeach
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
                                <img 
                                     src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                     srcset=""
                                     sizes="(max-width: 992px) 480px, 320px"
                                 >
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
                        <iframe id="youtubePlayer" width="560" height="315" src="" frameborder="0" allowfullscreen></iframe>
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
                            <div class="box-event-mid" onclick="showPopupEvent()">
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
                                            <h3 class="date-month">5 Oktober</h3>
                                            <h3 class="year">2024</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="area-event-bottom">
                            <div class="box-event" onclick="showPopupEvent()">
                                <div class="area-days-date-right">
                                    <div class="content-days-date-right">
                                        <div class="box-days-date-right">
                                            <h3 class="date-month-right">12 Oktober</h3>
                                            <h3 class="year-right">2024</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-event" onclick="showPopupEvent()">
                                <div class="area-days-date-right">
                                    <div class="content-days-date-right">
                                        <div class="box-days-date-right">
                                            <h3 class="date-month-right">12 Oktober</h3>
                                            <h3 class="year-right">2024</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="popupEvent" class="popup-event" onclick="closePopupOutsideEvent(event)">
                    <div class="popup-content-event">
                        <div class="area-info-event">
                            {{-- <span class="close" onclick="closePopup()">&times;</span> --}}
                            <p class="desk-event">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat quas
                                iste tenetur nihil accusantium ea quibusdam harum excepturi expedita debitis!</p>
                            <h2 class="title-box-event">5 Oktober 2024</h2>
                            <a href="/event">
                                <p class="link-event">See detail</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="area-content-VNS-kanan">
                    {{-- <div class="area-content-news"> --}}
                        <div class="header-news">
                            <h1 class="title-news">Recent News</h1>
                        </div>
                        <div class="content-news">
                            <div class="box-news">
                                <div class="area-image">
    
                                </div>
                                <div class="area-text">
                                    <p class="desk-news">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim
                                        voluptatem error molestias dicta minima? Voluptas!</p>
                                </div>
                            </div>
                            <div class="box-news">
                                <div class="area-image">
    
                                </div>
                                <div class="area-text">
                                    <p class="desk-news">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim
                                        voluptatem error molestias dicta minima? Voluptas!</p>
                                </div>
                            </div>
                            <div class="box-news">
                                <div class="area-image">
    
                                </div>
                                <div class="area-text">
                                    <p class="desk-news">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim
                                        voluptatem error molestias dicta minima? Voluptas!</p>
                                </div>
                            </div>
                            <div class="box-news">
                                <div class="area-image">
    
                                </div>
                                <div class="area-text">
                                    <p class="desk-news">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim
                                        voluptatem error molestias dicta minima? Voluptas!</p>
                                </div>
                            </div>
                            <div class="box-news">
                                <div class="area-image">
    
                                </div>
                                <div class="area-text">
                                    <p class="desk-news">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim
                                        voluptatem error molestias dicta minima? Voluptas!</p>
                                </div>
                            </div>
                        </div>
                    {{-- </div> --}}
                    {{-- <div class="area-content-streaming"> --}}
                        <div class="header-streaming">
                            <h2 class="title-streaming">Streaming</h2>
                        </div>
                        <div class="content-streaming">
                            <div class="box-streaming">
                                <div class="btn-play-streaming">
                                    <span class="material-symbols-rounded">play_arrow</span>
                                </div>
                            </div>
                        </div>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </section>
    <script src="js/youtube.js"></script>
@endsection
