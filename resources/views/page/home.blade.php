@extends('layout.main')
<link rel="stylesheet" href="css/StyleContent/home.css">
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@section('content')
    <section class="page-1">
        <div class="area-streaming">
            <div class="header-streaming">
                <h1 class="title-streaming">ON AIR</h1>
            </div>
            <div class="content-streaming">
                <div class="contentS-kiri">
                    <div class="card">
                        <div class="card-body">
                            <div class="btn-play">

                            </div>
                        </div>
                        <div class="card-header">
                            <div class="author">
                            </div>
                            <div class="view">
                                <p class="text-watchS">Tonton Siaran</p>
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
    <section class="page-2">
        <div class="area-program">
            <div class="area-header-program">
                <h1 class="title-program">PROGRAM</h1>
            </div>
            <div class="area-content-program">
                <div class="area-tombol">
                    <div class="tombol-kiri"></div>
                    <div class="tombol-kanan"></div>
                </div>
                <div class="area-content-box-program">
                    <div class="box-program"></div>
                    <div class="box-program"></div>
                    <div class="box-program"></div>
                    <div class="box-program"></div>
                    <div class="box-program"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="page-3">
        <div class="area-info-news">
            <div class="line-info"></div>
            <div class="area-content-info-news">
                <div class="area-content-info">
                    <div class="header-info">
                        <h1 class="title-info">Info</h1>
                    </div>
                    <div class="content-info">
                        <div class="box-info"></div>
                        <div class="box-info"></div>
                        <div class="box-info"></div>
                        <div class="box-info"></div>
                        <div class="box-info"></div>
                        <div class="box-info"></div>
                        <div class="box-info"></div>
                        <div class="box-info"></div>
                        <div class="box-info"></div>
                    </div>
                    <div class="area-bottom-info">
                        <h1 class="title-bottom-info">Show more</h1>
                    </div>
                </div>
                <div class="area-content-news">
                    <div class="header-news">
                        <h1 class="title-news">Top News</h1>
                    </div>
                    <div class="content-news">
                        <div class="box-news">
                            <div class="area-image">
                                
                            </div>
                            <div class="area-text">
                                <p class="desk-news">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim voluptatem error molestias dicta minima? Voluptas!</p>
                            </div>
                        </div>
                        <div class="box-news">
                            <div class="area-image">
                                
                            </div>
                            <div class="area-text">
                                <p class="desk-news">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim voluptatem error molestias dicta minima? Voluptas!</p>
                            </div>
                        </div>
                        <div class="box-news">
                            <div class="area-image">
                                
                            </div>
                            <div class="area-text">
                                <p class="desk-news">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim voluptatem error molestias dicta minima? Voluptas!</p>
                            </div>
                        </div>
                        <div class="box-news">
                            <div class="area-image">
                                
                            </div>
                            <div class="area-text">
                                <p class="desk-news">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim voluptatem error molestias dicta minima? Voluptas!</p>
                            </div>
                        </div>
                        <div class="box-news">
                            <div class="area-image">
                                
                            </div>
                            <div class="area-text">
                                <p class="desk-news">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim voluptatem error molestias dicta minima? Voluptas!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="audio-player-container">
        <svg id="visual" viewBox="0 0 900 600" width="1200" height="600" xmlns="http://www.w3.org/2000/svg">
            <path id="layer1" fill="#FF004D" stroke="#FF004D" stroke-width="2" stroke-linecap="round"></path>
        </svg>
        <div class="content">
            <div class="control-btn">
                <!-- <span class="material-symbols-rounded" id="repeat">repeat</span> -->
                <span class="material-symbols-rounded" id="prev">skip_previous</span>
                <div class="play-pause">
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
    </div>
    <script src="js/playlist.js"></script>
    <script src="js/home.js"></script>
@endsection