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
            </div>
            <div class="area-content-video">
                <div class="video-card">
                    <div class="thumbnail">
                        {{-- <img src="https://i.ytimg.com/vi/aqz-KE-bpKQ/maxresdefault.jpg" alt="Video Thumbnail"> --}}
                    </div>
                    <div class="video-info">
                        <div class="channel-logo">
                            <img src="https://via.placeholder.com/40" alt="Channel Logo">
                        </div>
                        <div class="video-details">
                            <h4 class="video-title">Sample YouTube Video Title Sample YouTube Video Title</h4>
                            <p class="channel-name">Channel Name</p>
                            <p class="views">1M views • 2 days ago</p>
                        </div>
                    </div>
                </div>
                <div class="video-card">
                    <div class="thumbnail">
                        {{-- <img src="https://i.ytimg.com/vi/aqz-KE-bpKQ/maxresdefault.jpg" alt="Video Thumbnail"> --}}
                    </div>
                    <div class="video-info">
                        <div class="channel-logo">
                            <img src="https://via.placeholder.com/40" alt="Channel Logo">
                        </div>
                        <div class="video-details">
                            <h4 class="video-title">Sample YouTube Video Title Sample YouTube Video Title</h4>
                            <p class="channel-name">Channel Name</p>
                            <p class="views">1M views • 2 days ago</p>
                        </div>
                    </div>
                </div>
                <div class="video-card">
                    <div class="thumbnail">
                        {{-- <img src="https://i.ytimg.com/vi/aqz-KE-bpKQ/maxresdefault.jpg" alt="Video Thumbnail"> --}}
                    </div>
                    <div class="video-info">
                        <div class="channel-logo">
                            <img src="https://via.placeholder.com/40" alt="Channel Logo">
                        </div>
                        <div class="video-details">
                            <h4 class="video-title">Sample YouTube Video Title Sample YouTube Video Title</h4>
                            <p class="channel-name">Channel Name</p>
                            <p class="views">1M views • 2 days ago</p>
                        </div>
                    </div>
                </div>
                <div class="video-card">
                    <div class="thumbnail">
                        {{-- <img src="https://i.ytimg.com/vi/aqz-KE-bpKQ/maxresdefault.jpg" alt="Video Thumbnail"> --}}
                    </div>
                    <div class="video-info">
                        <div class="channel-logo">
                            <img src="https://via.placeholder.com/40" alt="Channel Logo">
                        </div>
                        <div class="video-details">
                            <h4 class="video-title">Sample YouTube Video Title Sample YouTube Video Title</h4>
                            <p class="channel-name">Channel Name</p>
                            <p class="views">1M views • 2 days ago</p>
                        </div>
                    </div>
                </div>
            </div>
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
                            <div class="box-event-mid">
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
                            <div class="box-event">
                                <div class="area-days-date-right">
                                    <div class="content-days-date-right">
                                        <div class="box-days-date-right">
                                            <h3 class="date-month-right">12 Oktober</h3>
                                            <h3 class="year-right">2024</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-event">
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
                            <div class="box-streaming"></div>
                        </div>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </section>
    <script src="js/youtube.js"></script>
@endsection
