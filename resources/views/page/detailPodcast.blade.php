@extends('layout.main')
<link rel="stylesheet" href="css/StyleContent/detailPodcast.css">
<link rel="stylesheet" href="css/ResponsiveStyle/responsiveDetailPodcast.css">
@section('content')
    <section class="page-detail-1">
        <div class="area-detail-podcast">
            <div class="area-detail-kiri">
                <div class="area-image-DP">
                    <div class="card-DP">
                        <div class="card-DP-body">
                            <div class="btn-play-DP">
                                <span class="material-symbols-rounded">play_arrow</span>
                            </div>
                        </div>
                        <div class="card-DP-header">
                            <div class="DP-author">
                            </div>
                            <div class="DP-view" id="btn-tonton">
                                <p class="text-watchP">Tonton Podcast</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-DP-B">
                        <div class="card-body-DP-B">
                            <div class="video-container">
                                <div id="player-podcast" data-pl="PLFIM0718LjIVrOglQcS_ZHkT5T_27Cmea"></div>
                            </div>
                        </div>
                        <div class="card-DP-footer">
                            <div class="view-DP-B">
                                <p class="text-watchP-B">Dengar Podcast</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-detail-podcast">
                    <div class="content-detail-kiri">
                        <div class="area-header-DP">
                            <div class="area-detail-genre">
                                <h2 class="detail-genre">Comedy</h2>
                            </div>
                            <div class="area-detail-title-podcast">
                                <h2 class="detail-title">Podcast Aseek</h2>
                            </div>
                        </div>
                        <div class="area-desk-detail-podcast">
                            <p class="desk-podcast">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laboriosam
                                dolor
                                illo ipsum odit quia delectus non dicta praesentium magni necessitatibus vel soluta, nobis
                                voluptate eius!</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="area-detail-kanan">
                <div class="header-detail-kanan">
                    <h2 class="title-detail-kanan">Other Episode</h2>
                </div>
                <div class="area-episodeP" id="style-3">
                    <div class="card-episode">
                        <a href="/detail-podcast">
                            <div class="card-body-episode">
                                <div class="card-header-episode">
                                    <div class="genre-episode">
                                        <h1 class="title-genre-episode">Comedy</h1>
                                    </div>
                                    <div class="area-card-text-episode">
                                        <h1 class="card-text-podcast-episode">Podcast Aseek</h1>
                                    </div>
                                </div>
                                <div class="card-image-podcast-episode">

                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="card-episode">
                        <a href="/detail-podcast">
                            <div class="card-body-episode">
                                <div class="card-header-episode">
                                    <div class="genre-episode">
                                        <h1 class="title-genre-episode">Comedy</h1>
                                    </div>
                                    <div class="area-card-text-episode">
                                        <h1 class="card-text-podcast-episode">Podcast Aseek</h1>
                                    </div>
                                </div>
                                <div class="card-image-podcast-episode">

                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="card-episode">
                        <a href="/detail-podcast">
                            <div class="card-body-episode">
                                <div class="card-header-episode">
                                    <div class="genre-episode">
                                        <h1 class="title-genre-episode">Comedy</h1>
                                    </div>
                                    <div class="area-card-text-episode">
                                        <h1 class="card-text-podcast-episode">Podcast Aseek</h1>
                                    </div>
                                </div>
                                <div class="card-image-podcast-episode">

                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="card-episode">
                        <a href="/detail-podcast">
                            <div class="card-body-episode">
                                <div class="card-header-episode">
                                    <div class="genre-episode">
                                        <h1 class="title-genre-episode">Comedy</h1>
                                    </div>
                                    <div class="area-card-text-episode">
                                        <h1 class="card-text-podcast-episode">Podcast Aseek</h1>
                                    </div>
                                </div>
                                <div class="card-image-podcast-episode">

                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="card-episode">
                        <a href="/detail-podcast">
                            <div class="card-body-episode">
                                <div class="card-header-episode">
                                    <div class="genre-episode">
                                        <h1 class="title-genre-episode">Comedy</h1>
                                    </div>
                                    <div class="area-card-text-episode">
                                        <h1 class="card-text-podcast-episode">Podcast Aseek</h1>
                                    </div>
                                </div>
                                <div class="card-image-podcast-episode">

                                </div>
                            </div>
                        </a>
                    </div>

                </div>
                <div class="area-see-more">
                    <h2 class="text-see-more" id="toggleSeeMore">See more</h2>
                </div>
            </div>
        </div>
        <div class="line-detail-podcast"></div>
    </section>
    <section class="page-detail-2">
        <div class="area-other-podcast">
            <div class="area-content-OP">
                <div class="header-OP">
                    <h1 class="title-OP">Other Podcast</h1>
                </div>
                <div class="content-OP">
                    <div class="area-tombol-OP">
                        <div class="tombol-kiri-OP"></div>
                        <div class="tombol-kanan-OP"></div>
                    </div>
                    <div class="area-content-card-OP">
                        <div class="card-podcast">
                            <div class="card-body-podcast">
                                <div class="head-body-podcast">
                                    <div class="genre">
                                        <h1 class="title-genre">Comedy</h1>
                                    </div>
                                    <div class="area-card-text">
                                        <h1 class="card-text-podcast">Podcast Aseek</h1>
                                    </div>
                                </div>
                                <div class="card-image-podcast">

                                </div>
                            </div>
                            <div class="card-header-podcast">
                                <div class="author-podcast">
                                </div>
                                <a class="link-podcast" href="/detail-podcast">
                                    <div class="view-podcast">
                                        <p class="text-watch-podcast">View Podcast</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="card-podcast">
                            <div class="card-body-podcast">
                                <div class="head-body-podcast">
                                    <div class="genre">
                                        <h1 class="title-genre">Comedy</h1>
                                    </div>
                                    <div class="area-card-text">
                                        <h1 class="card-text-podcast">Podcast Aseek</h1>
                                    </div>
                                </div>
                                <div class="card-image-podcast">

                                </div>
                            </div>
                            <div class="card-header-podcast">
                                <div class="author-podcast">
                                </div>
                                <a class="link-podcast" href="/detail-podcast">
                                    <div class="view-podcast">
                                        <p class="text-watch-podcast">View Podcast</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="card-podcast">
                            <div class="card-body-podcast">
                                <div class="head-body-podcast">
                                    <div class="genre">
                                        <h1 class="title-genre">Comedy</h1>
                                    </div>
                                    <div class="area-card-text">
                                        <h1 class="card-text-podcast">Podcast Aseek</h1>
                                    </div>
                                </div>
                                <div class="card-image-podcast">

                                </div>
                            </div>
                            <div class="card-header-podcast">
                                <div class="author-podcast">
                                </div>
                                <a class="link-podcast" href="/detail-podcast">
                                    <div class="view-podcast">
                                        <p class="text-watch-podcast">View Podcast</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="card-podcast">
                            <div class="card-body-podcast">
                                <div class="head-body-podcast">
                                    <div class="genre">
                                        <h1 class="title-genre">Comedy</h1>
                                    </div>
                                    <div class="area-card-text">
                                        <h1 class="card-text-podcast">Podcast Aseek</h1>
                                    </div>
                                </div>
                                <div class="card-image-podcast">

                                </div>
                            </div>
                            <div class="card-header-podcast">
                                <div class="author-podcast">
                                </div>
                                <a class="link-podcast" href="/detail-podcast">
                                    <div class="view-podcast">
                                        <p class="text-watch-podcast">View Podcast</p>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="page-detail-3">
        <div class="area-video-news-stream">
            <div class="area-content-VNS">
                <div class="area-content-VNS-kiri">
                    <div class="header-content-kiri">
                        <h2 class="title-video">Video</h2>
                    </div>
                    <div class="content-kiri-video">
                        <div class="area-video-top">
                            <div class="box-video">
                                <div class="btn-play-video">
                                    <span class="material-symbols-rounded">play_arrow</span>
                                </div>
                            </div>
                            <div class="box-video">
                                <div class="btn-play-video">
                                    <span class="material-symbols-rounded">play_arrow</span>
                                </div>
                            </div>
                        </div>
                        <div class="area-video-mid">
                            <div class="box-video-mid">
                                <div class="btn-play-video-mid">
                                    <span class="material-symbols-rounded">play_arrow</span>
                                </div>
                            </div>
                        </div>
                        <div class="area-video-bottom">
                            <div class="box-video">
                                <div class="btn-play-video">
                                    <span class="material-symbols-rounded">play_arrow</span>
                                </div>
                            </div>
                            <div class="box-video">
                                <div class="btn-play-video">
                                    <span class="material-symbols-rounded">play_arrow</span>
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
                        <div class="box-streaming">
                            <a class="link-streaming" href="">
                                <div class="btn-play-streaming">
                                    <span class="material-symbols-rounded">play_arrow</span>
                                    {{-- <h2 class="text-streaming">Click Here</h2> --}}
                                </div>
                            </a>
                        </div>
                    </div>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </section>
    <script src="js/detailPodcast.js"></script>
@endsection
