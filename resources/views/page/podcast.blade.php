@extends('layout.main')

@push('meta-seo')
    <meta name="description" content="{{ \App\Helpers\Settings::get('site_description', 'Default Site Title') }}">
@endpush

@push('Style.css')
    <link rel="stylesheet" href="{{ asset('css/StyleContent/podcast.css?v=' . time()) }}">
    <link rel="stylesheet" href="{{ asset('css/ResponsiveStyle/responsivePodcast.css?v=' . time()) }}">
@endpush
@section('title', 'PODCAST | ' . \App\Helpers\Settings::get('site_title', 'Default Site Title'))
@section('content')
    <section class="page-podcast-1">
        @foreach ($bannerP as $bannerPList)
            <div class="area-header-podcast">
                <h2 class="title-header-podcast">{{ $bannerPList->title_banner_podcast }}</h2>
                <img class="banner-podcast" src="./storage/{{ $bannerPList->banner_podcast }}" alt="" srcset="">
            </div>
        @endforeach
    </section>
    <section class="page-podcast-2" id="podcast">
        <div class="area-card-podcast">
            <div class="header-card-podcast">
                <h2 class="title-header-card-podcast">Latest Podcast</h2>
            </div>
            <div class="line-podcast"></div>
            <div class="content-card-podcast">
                @foreach ($podcast as $podcastList)
                    <div class="card-podcast" data-slug="{{ $podcastList->slug }}">
                        <div class="card-body-podcast">
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
                        <div class="box-area-videoYT-kiri"
                            data-video-id="{{ $video['snippet']['resourceId']['videoId'] }}">
                            <img class="video-thumbnail"
                                src="https://img.youtube.com/vi/{{ $video['snippet']['resourceId']['videoId'] }}/hqdefault.jpg"
                                alt="Thumbnail">
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
                    <div class="box-area-videoYT-kanan"
                        data-video-id="{{ $video['snippet']['resourceId']['videoId'] }}">
                        <img class="video-thumbnail"
                            src="https://img.youtube.com/vi/{{ $video['snippet']['resourceId']['videoId'] }}/hqdefault.jpg"
                            alt="Thumbnail">
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
                        <img class="image-streaming" src="./storage/{{ $streamAudio->image_stream }}">
                        <div class="btn-play-streaming" id="BtnStream" data-audio-src="{{ $streamAudio->stream_url }}">
                            <span class="material-symbols-rounded">play_arrow</span>
                        </div>
                        {{-- <audio class="audio-streaming" id="audio-streaming" preload="auto">
                            <source type="audio/mpeg" src="{{ $stream->stream_audio_url }}" />
                        </audio> --}}
                    </div>
                </div>
            </div>
            <div class="area-content-SN-kanan">
                <div class="header-news">
                    <h1 class="title-news">Top Info</h1>
                </div>
                <div class="content-news">
                    @foreach ($topInfo as $topInfoList)
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
        </div>
    </div>
</section>
<script src="{{ asset('js/podcast.js?v=' . time()) }}"></script>
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
    });
</script>
@endsection
