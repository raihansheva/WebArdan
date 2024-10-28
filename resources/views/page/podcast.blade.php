@extends('layout.main')

<link rel="stylesheet" href="css/StyleContent/podcast.css">
<link rel="stylesheet" href="css/ResponsiveStyle/responsivePodcast.css">
@section('content')
    <section class="page-podcast-1">
        <div class="area-header-podcast">
            <h2 class="title-header-podcast">ARDAN PODCAST</h2>
        </div>
    </section>
    <section class="page-podcast-2" id="podcast">
        <div class="area-card-podcast">
            <div class="header-card-podcast">
                <h2 class="title-header-card-podcast">Latest Podcast</h2>
            </div>
            <div class="line-podcast"></div>
            <div class="content-card-podcast">
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
                            <a class="link-podcast" href="/detail-podcast/{{ $podcastList->slug }}">
                                <div class="view-podcast">
                                    <p class="text-watch-podcast">View Podcast</p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="area-bottom-card-podcast">
                <h2 class="title-bottom" id="toggleBtn">See more</h2>
            </div>
        </div>
    </section>
    <section class="page-podcast-3">
        <div class="area-videoYT">
            <div class="area-header-videoYT">
                <h2 class="title-videoYT">Video</h2>
            </div>
            <div class="area-content-videoYT">
                <div class="area-contentYT-kiri">
                    @foreach ($videos as $video)
                        <div class="box-area-videoYT-kiri" data-video-id="{{ $video['snippet']['resourceId']['videoId'] }}">
                            <div class="btn-play-videoYT-kiri"
                                onclick="showPopupYT('{{ $video['snippet']['resourceId']['videoId'] }}')">
                                <span class="material-symbols-rounded">play_arrow</span>
                            </div>
                        </div>
                        @break
                    @endforeach
                </div>
                <div class="area-contentYT-kanan">
                    @foreach (collect($videos)->slice(1, 2) as $video)
                        <div class="box-area-videoYT-kanan" data-video-id="{{ $video['snippet']['resourceId']['videoId'] }}">
                            <div class="btn-play-videoYT-kanan"
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
            </div>
        </div>
    </section>
    <section class="page-podcast-4">
        <div class="area-streaming-news">
            <div class="area-content-SN">
                <div class="area-content-SN-kiri">
                    <div class="header-SN-kiri">
                        <h2 class="title-SN-kiri">Streaming</h2>
                    </div>
                    <div class="content-SN-kiri">
                        <div class="box-streaming">
                            <div class="btn-play-streaming">
                                <span class="material-symbols-rounded">play_arrow</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="area-content-SN-kanan">
                    <div class="header-news">
                        <h1 class="title-news">Recent News</h1>
                    </div>
                    <div class="content-news">
                        @foreach ($topInfo as $topInfoList)
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="js/podcast.js"></script>
@endsection
