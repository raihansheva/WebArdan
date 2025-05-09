@extends('layout.main')
<base href="{{ url('/') }}/">
@push('meta-seo')
    <meta name="description" content="{{ $detail_podcast->meta_description }}">
    <meta name="keyword" content="{{ $detail_podcast->meta_keyword }}">
@endpush

@push('Style.css')
    <link rel="stylesheet" href="{{ asset('css/StyleContent/detailPodcast.css?v=' . time()) }}">
    <link rel="stylesheet" href="{{ asset('css/ResponsiveStyle/responsiveDetailPodcast.css?v=' . time()) }}">
@endpush
<link href="https://vjs.zencdn.net/8.16.1/video-js.css" rel="stylesheet" />

@section('title', 'PODCAST | ' . $detail_podcast->meta_title)

@section('content')
    <section class="page-detail-1">
        <div class="area-detail-podcast">
            <div class="area-detail-kiri">
                <div class="area-image-DP">
                    <div class="card-DP">
                        <div class="card-DP-body">
                            <img class="image-podcast-detail" src="./storage/{{ $detail_podcast->image_podcast }}"
                                alt="" srcset="">
                            <div class="btn-play-DP" data-audio-src="./storage/{{ $detail_podcast->file }}"
                                data-id="{{ $detail_podcast->id }}">
                                <span class="material-symbols-rounded">play_arrow</span>
                                <p style="display: none;" id="id_podcast">{{ $detail_podcast->podcast_id }}</p>
                                <p style="display: none;" id="idP">{{ $detail_podcast->id }}</p>
                            </div>
                            <audio src="./storage/{{ $detail_podcast->file }}" id="audio-podcast" preload="metadata"></audio>
                        </div>
                        <div class="card-DP-header">
                            {{-- <div class="DP-author">
                            </div> --}}
                            <div class="DP-view" id="btn-tonton">
                                <p class="text-watchP">Watch <i class='bx bx-video'></i></p>
                            </div>
                        </div>
                    </div>
                    <div class="card-DP-B">
                        <div class="card-body-DP-B">
                            <div class="video-container">
                                @if (!empty($detail_podcast->link_podcast))
                                    <div id="player" data-link="{{ $detail_podcast->link_podcast }}"></div>
                                @elseif (!empty($youtubeId))
                                    {{-- Gunakan Video.js untuk YouTube --}}
                                    {{-- <video id="PlayerVid" class="video-js vjs-default-skin" controls preload="auto"
                                        data-setup='{"techOrder": ["youtube"], "sources": [{"type": "video/youtube", "src": "https://www.youtube.com/watch?v={{ $youtubeId }}"}]}'>
                                    </video> --}}

                                    {{-- Alternatif: Gunakan iframe YouTube --}}
                                    {{-- <iframe class="iframe-yt" src="https://www.youtube.com/embed/{{ $youtubeId }}"
                                        frameborder="0" allowfullscreen>
                                    </iframe> --}}
                                    <div class="iframe-yt" id="player-podcast-yt"
                                        data-link-youtube="https://www.youtube.com/embed/{{ $youtubeId }}"></div>
                                @elseif (!empty($detail_podcast->file_video))
                                    <div id="player" data-link="./storage/{{ $detail_podcast->file_video }}"></div>
                                @endif
                                {{-- @if (!empty($detail_podcast->link_podcast))
                                    <video id="PlayerVid" class="video-js" controls preload="auto" poster="">
                                        <source src="https://youtu.be/yBwnU7eQqDs?si=INQbh5OsLRfRN6Xe" />
                                    </video>
                                    <video id="PlayerVid" class="video-js" controls preload="auto" poster=""
                                        data-setup='{"techOrder": ["youtube"], "sources": [{"src": "https://youtu.be/yBwnU7eQqDs?si=INQbh5OsLRfRN6Xe", "type": "video/youtube"}]}'>
                                    </video>
                                @else
                                    <p>Streaming URL tidak tersedia.</p>
                                @endif --}}
                            </div>

                        </div>
                        <div class="card-DP-footer">
                            <div class="view-DP-B">
                                <p class="text-watchP-B">Hear <i class='bx bx-microphone'></i></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-detail-podcast">
                    <div class="content-detail-kiri">
                        <div class="area-header-DP">
                            <div class="area-detail-genre">
                                @if (is_array($detail_podcast->genre_podcast))
                                    @foreach ($detail_podcast->genre_podcast as $genre)
                                        <h2 class="detail-genre">{{ $genre }}</h2>
                                    @endforeach
                                @else
                                    <h2 class="detail-genre">-</h2>
                                @endif
                            </div>
                            <div class="area-detail-title-podcast">
                                <h2 class="detail-title">{{ $detail_podcast->judul_podcast }}</h2>
                            </div>
                        </div>
                        <div class="area-desk-detail-podcast">
                            {!! str($detail_podcast->deskripsi_podcast)->sanitizeHtml() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="area-detail-kanan">
                <div class="header-detail-kanan">
                    <h2 class="title-detail-kanan">Other Episode</h2>
                </div>
                <div class="area-episodeP" id="style-3">
                    @if ($eps_group && $eps_group->isNotEmpty())
                        @foreach ($eps_group as $epsgroupList)
                            <div class="card-episode">
                                <a href="/detail-podcast/{{ $epsgroupList->slug }}">
                                    <div class="card-body-episode">
                                        <div class="card-header-episode">
                                            <div class="genre-episode">
                                                @if (is_array($epsgroupList->genre_podcast))
                                                    @foreach ($epsgroupList->genre_podcast as $genre)
                                                        <h1 class="title-genre-episode">{{ $genre }}
                                                        </h1>
                                                    @endforeach
                                                @else
                                                    <h1 class="title-genre-episode">-</h1>
                                                @endif
                                            </div>
                                            <div class="area-card-text-episode">
                                                <h1 class="card-text-podcast-episode">{{ $epsgroupList->judul_podcast }}
                                                </h1>
                                            </div>
                                        </div>
                                        <div class="card-image-podcast-episode">
                                            <img src="./storage/{{ $epsgroupList->image_podcast }}" alt=""
                                                class="image-podcast">
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <p>Data tidak tersedia</p>
                    @endif
                </div>
                <div class="area-see-more">
                    <h2 class="text-see-more" id="toggleSeeMore">See more</h2>
                </div>
            </div>
        </div>
        {{--  --}}
        <div class="line-detail-podcast"></div>
    </section>
    <section class="section-banner {{ $banner->where('position', 'middle')->count() > 0 ? '' : 'hidden' }}">
        <div class="area-banner">
            <swiper-container class="mySwiper" id="swiper-xl" centered-slides="true" autoplay-delay="2000"
                autoplay-disable-on-interaction="false" loop="true">
                @foreach ($banner->where('position', 'middle') as $list)
                    <swiper-slide><a class="link-ads-banner" href="{{ $list->link_ads }}">
                            <img class="image-banner" src="{{ asset('storage/' . $list->image_banner) }}" alt=""
                                loading="lazy">
                        </a></swiper-slide>
                @endforeach
            </swiper-container>
        </div>
    </section>
    <section class="page-detail-2">
        <div class="area-other-podcast">
            <div class="area-content-OP">
                <div class="header-OP">
                    <h1 class="title-OP">Other Podcast</h1>
                </div>
                <div class="content-OP">
                    <swiper-container class="area-content-card-OP" loop="true" autoplay-delay="2500"
                        autoplay-disable-on-interaction="false"
                        breakpoints='{
                        "480": { "slidesPerView": 1 },
                        "768": { "slidesPerView": 2 },
                        "1024": { "slidesPerView": 3 },
                        "1280": { "slidesPerView": 3 },
                        "2560": { "slidesPerView" : 4}
                    }'
                        space-between="20">
                        @foreach ($all_podcast as $allpodcastList)
                            <swiper-slide>
                                <div class="card-podcast" data-slug="{{ $allpodcastList->slug }}">
                                    <div class="card-body-podcast">
                                        <div class="head-body-podcast">
                                            <div class="genre">
                                                @if (is_array($allpodcastList->genre_podcast))
                                                    @foreach ($allpodcastList->genre_podcast as $genre)
                                                        <h1 class="title-genre">{{ $genre }}</h1>
                                                    @endforeach
                                                @else
                                                    <h1 class="title-genre">-</h1>
                                                @endif
                                            </div>
                                            <div class="area-card-text">
                                                <h1 class="card-text-podcast">{{ $allpodcastList->judul_podcast }}</h1>
                                            </div>
                                        </div>
                                        <div class="card-image-podcast">
                                            <img src="./storage/{{ $allpodcastList->image_podcast }}" alt=""
                                                class="image-podcast">
                                        </div>
                                    </div>
                                    <div class="card-header-podcast">
                                        <div class="author-podcast">
                                        </div>
                                        <a class="link-podcast" href="/detail-podcast/{{ $allpodcastList->slug }}">
                                            <div class="view-podcast">
                                                <p class="text-watch-podcast">View Podcast</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </swiper-slide>
                        @endforeach
                    </swiper-container>
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
                            @foreach (collect($videos)->slice(0, 2) as $video)
                                <div class="box-video" data-video-id="{{ $video['videoUrl'] }}">
                                    <img class="video-thumbnail"
                                        src="https://img.youtube.com/vi/{{ $video['videoId'] }}/hqdefault.jpg"
                                        alt="Thumbnail">
                                    <div class="btn-play-video" onclick="showPopupYT('{{ $video['videoUrl'] }}')">
                                        <span class="material-symbols-rounded">play_arrow</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="area-video-mid">
                            @foreach (collect($videos)->slice(2, 1) as $video)
                                <div class="box-video-mid" data-video-id="{{ $video['videoUrl'] }}">
                                    <img class="video-thumbnail"
                                        src="https://img.youtube.com/vi/{{ $video['videoId'] }}/hqdefault.jpg"
                                        alt="Thumbnail">
                                    <div class="btn-play-video-mid" onclick="showPopupYT('{{ $video['videoUrl'] }}')">
                                        <span class="material-symbols-rounded">play_arrow</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="area-video-bottom">
                            @foreach (collect($videos)->slice(3, 2) as $video)
                                <div class="box-video" data-video-id="{{ $video['videoUrl'] }}">
                                    <img class="video-thumbnail"
                                        src="https://img.youtube.com/vi/{{ $video['videoId'] }}/hqdefault.jpg"
                                        alt="Thumbnail">
                                    <div class="btn-play-video" onclick="showPopupYT('{{ $video['videoUrl'] }}')">
                                        <span class="material-symbols-rounded">play_arrow</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="popup-player-yt" id="popup-player" style="display:none;">
                    <div class="popup-content-yt">
                        {{-- <span id="close-popup" onclick="hidePopup()">X</span> --}}
                        <div id="player-yt"></div>
                    </div>
                </div>
                <div class="area-content-VNS-kanan">
                    <div class="area-content-news">
                        <div class="header-news">
                            <h1 class="title-news">Top News</h1>
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
                                                <h2 class="tag-top-info">{{ $topInfoList->tagInfo->nama_kategori }}</h2>

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
    <script src="{{ asset('js/detailPodcast.js?v=' . time()) }}"></script>
    <script src="{{ asset('js/playerjsPodcast.js?v=' . time()) }}"></script>
    <script src="https://www.youtube.com/iframe_api"></script>
    <script src="https://vjs.zencdn.net/8.16.1/video.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/videojs-youtube/dist/Youtube.min.js"></script>
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

            // const player = videojs('PlayerVid', {
            //     controls: true,
            //     autoplay: false,
            //     preload: 'auto',
            //     fluid: true,
            //     aspectRatio: '16:9',
            //     sources: [{
            //         src: 'https://youtu.be/yBwnU7eQqDs?si=INQbh5OsLRfRN6Xe',
            //         type: 'video/youtube', // Tipe untuk YouTube
            //     }, ],
            // });

            // pjs
            const playerElement = document.getElementById("player");
            const streamURL = playerElement ? playerElement.getAttribute("data-link") : null;
            // const imageStream = playerElement.getAttribute("data-poster");

            window.playerPJS = new Playerjs({
                id: "player", // ID elemen target
                file: streamURL, // URL streaming dari data-link
                // poster: imageStream, // Poster dari data-poster
            });

            // youtube api podcast
            const playerYoutube = document.getElementById("player-podcast-yt");
            const ytURL = playerYoutube ?
                playerYoutube.getAttribute("data-link-youtube") :
                null;

            let playerYT;

            if (ytURL) {
                // Membuat URL lengkap berdasarkan ytURL
                const urlLengkap = ytURL.split("/")[4]; // Mengambil ID dari URL
                playerYT = new YT.Player("player-podcast-yt", {
                    height: "360",
                    width: "640",
                    videoId: urlLengkap, // Menggunakan ID video saja
                    events: {
                        onReady: function(event) {
                            console.log("Player ready");
                        },
                    },
                });
            } else {
                console.log("URL video tidak ditemukan.");
            }

            // console.log("playerYT:", playerYT);
            // ------------------

            tontonSiaranBtnA.addEventListener("click", function() {
                hideCard(cardA);
                pausePodcast(idP)
                playerYT.playVideo();
                setTimeout(() => {
                    showCard(cardB);
                }, 500);
            });

            tontonSiaranBtnB.addEventListener("click", function() {
                hideCard(cardB);
                // playerYT.pause();
                setTimeout(() => {
                    playPodcast(idP);
                    showCard(cardA);
                }, 500);
            });

            // const youtubeId = "{{ $youtubeId }}"; // ID YouTube dari Blade

            // if (youtubeId) {
            //     const player = videojs('PlayerVid'); // Inisialisasi pemutar video.js
            //     player.ready(function() {
            //         // Menambahkan YouTube sebagai sumber video di video.js
            //         player.src({
            //             type: 'video/youtube',
            //             src: `https://www.youtube.com/watch?v=${youtubeId}`,
            //         });
            //     });
            // }

        });
    </script>
@endsection
