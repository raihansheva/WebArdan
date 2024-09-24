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
    <div class="audio-player-container">
        <!-- <svg id="visual" viewBox="0 0 900 600" xmlns="http://www.w3.org/2000/svg">
              <path id="wave" fill="#0066FF" stroke-linecap="round" stroke-linejoin="miter"></path>
          </svg> -->
        <svg id="visual" viewBox="0 0 900 600" width="1200" height="600" xmlns="http://www.w3.org/2000/svg">
            <!-- Layer 1 -->
            <path id="layer1" fill="#fa7268" stroke="#fa7268" stroke-width="2" stroke-linecap="round"></path>
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
{{--  --}}