@extends('layout.main')
<base href="{{ url('/') }}/">

@push('meta-seo')
    <meta name="description" content="{{ $program->meta_description }}">
    <meta name="keyword" content="{{ $program->meta_keywords }}">
@endpush

@push('Style.css')
    <link rel="stylesheet" href="{{ asset('css/StyleContent/detailProgram.css?v=' . time()) }}">
    <link rel="stylesheet" href="{{ asset('css/ResponsiveStyle/responsivedetailProgram.css?v=' . time()) }}">
@endpush

@section('title', $program->meta_title)
@section('content')
    {{-- <section class="page-news-1">
        <div class="header-info-news">
            @foreach ($bannerInfo as $bannerInfoList)
                <div class="image-header-info-news">
                    <h2 class="title-header">#{{ $bannerInfoList->title_banner_info }}</h2>
                    <img class="banner-info" src="../storage/{{ $bannerInfoList->banner_info }}" alt=""
                        srcset="">
                </div>
            @endforeach
        </div>
    </section> --}}
    <section class="page-news-2">
        <div class="area-detail-program">
            <div class="content-detail-program">
                <div class="content-IN-kiri" id="style-3">
                    <div class="area-content-DP">
                        <div class="area-title-detail-program">
                            <h2 class="title-detail-program">{{ $program->judul_program }}</h2>
                        </div>
                        <div class="area-url-detail-program">
                            <h2 class="url-detail-program">
                                <a class="link-url-detail-program" href="{{ url('/') }}">Home</a> >
                                {{ str_replace('-', ' ', request()->segment(1)) }} >
                                {{ str_replace('-', ' ', $program->slug) }}
                            </h2>
                        </div>
                        <div class="area-span-detail-program">
                            <p class="text-span-detail-program">Program</p>
                        </div>
                        <div class="area-date-detail-program">
                            <p class="date-detail-program">
                                Pukul {{ $program->jam_mulai }} - {{ $program->jam_selesai }} Wib.
                            </p>
                        </div>
                        <div class="area-image-detail-program">
                            <img class="image-detail-program" src="../storage/{{ $program->image_program }}" alt="">
                        </div>
                        <div class="area-desk-detail-program">
                            {!! str($program->deskripsi_program)->sanitizeHtml() !!}
                        </div>
                        {{-- @if ($event->has_ticket)
                            <div class="area-ticket-event">
                                <div class="header-ticket-event">
                                    <h2 class="text-header-ticket-event">Get Ticket Now</h2>
                                </div>
                                <div class="area-text-ticket">
                                    <a class="link-text-ticket" href="{{ $event->ticket_url }}">
                                        <p class="text-ticket">Buy Now</p>
                                    </a>
                                </div>
                            </div>
                        @endif --}}
                    </div>
                    <div class="line-detail-info"></div>
                    <div class="area-programE">
                        <div class="header-programE">
                            <h2 class="title-programE">Program Ardan</h2>
                        </div>
                        <div class="content-programE">
                            @foreach ($programO as $programList)
                                <div class="box-programE" style="background-image: url('./storage/{{ $programList->image_program }}') "
                                    class="box-program" data-title="{{ $programList->judul_program }}"
                                    data-description="{{ $programList->deskripsi_pendek }}"
                                    data-time="{{ $programList->jam_mulai }} - {{ $programList->jam_selesai }}"
                                    data-slugP="{{ $programList->slug }}"
                                    data-deskP="{{ $programList->deskripsi_program }}"
                                    onclick="showPopup(this)"></div>
                            @endforeach
                        </div>
                    </div>
                    <div id="popup" class="popup" style="display: none;" onclick="closePopupOutside(event)">
                        <div class="popup-content">
                            <span class="close" onclick="closePopup()">&times;</span>
                            <div class="area-info-program">
                                <p class="desk-program">Program Description</p> <!-- Pastikan elemen ini ada -->
                                <h2 class="title-box-program">Program Title</h2> <!-- Pastikan elemen ini ada -->
                                <p class="jam-program">Program Time</p> <!-- Pastikan elemen ini ada -->
                                <a href="#" class="detail-link-program">
                                    <p class="link-program">See detail</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-IN-kanan">
                    <div class="area-streaming">
                        <div class="area-header-streaming">
                            <h2 class="title-streaming">Streaming</h2>
                        </div>
                        <div class="area-thumbnail">
                            <img class="image-streaming" src="./storage/{{ $streamAudio->image_stream }}">
                            <div class="btn-play-streaming" id="BtnStream" data-audio-src="{{ $streamAudio->stream_url }}">
                                <span class="material-symbols-rounded">play_arrow</span>
                            </div>

                            <!-- Ganti dengan MediaElement.js -->
                            {{-- <audio class="audio-streaming" id="audio-streaming" preload="auto" crossorigin="anonymous">
                                <source type="audio/mpeg" src="{{ $stream->stream_audio_url }}" />
                            </audio> --}}
                        </div>
                        <div class="line-streaming"></div>
                    </div>
                    <div class="area-news">
                        <div class="area-header-news">
                            <h2 class="header-news">Kategori Info</h2>
                        </div>
                        <div class="area-box-news">
                            @foreach ($kategoriInfo as $kategoriInfoList)
                                <div class="box-news">
                                    <a href="/info-tag/{{ $kategoriInfoList->nama_kategori }}">
                                        <div class="area-tag-news">
                                            <h3 class="tag-news">{{ $kategoriInfoList->nama_kategori }}</h3>
                                        </div>
                                        @if ($kategoriInfoList->info->isNotEmpty())
                                            <img class="image-news"
                                                src="{{ asset('storage/' . $kategoriInfoList->info->first()->image_info) }}"
                                                alt="">
                                        @else
                                            <p>Tidak ada info untuk tag ini.</p>
                                        @endif
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="line-news"></div>
                    </div>
                    <div class="line-news"></div>
                    <div class="area-top-news">
                        <div class="header-top-news">
                            <h1 class="title-top-news">Top News</h1>
                        </div>
                        <div class="content-top-news">
                            @foreach ($top_info as $topInfoList)
                                <a class="link-box-top-info" href="/info-detail/{{ $topInfoList->slug }}">
                                    <div class="box-top-info">
                                        <div class="area-top-image">
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
                    <div class="area-event">
                        <div class="area-header-event">
                            <h2 class="title-event">Event</h2>
                        </div>
                        <div class="area-event-bottom">
                            @foreach ($event_upcoming as $eventUpcomingList)
                                <div class="box-event"
                                    style="background-image: url('./storage/{{ $eventUpcomingList->image_event }}')"
                                    onclick="showPopupEvent(this)"
                                    data-description="{{ $eventUpcomingList->deskripsi_pendek }}"
                                    data-date="{{ \Carbon\Carbon::parse($eventUpcomingList->date_event)->format('d F Y') }}"
                                    data-slug="{{ $eventUpcomingList->slug }}" data-deskShort="{{ $eventUpcomingList->deskripsi_event }}">
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
                        <div id="popupEvent" class="popup-event" onclick="closePopupOutsideEvent(event)">
                            <div class="popup-content-event">
                                <div class="area-info-event">
                                    <p class="desk-event"></p>
                                    <h2 class="title-box-event"></h2>
                                    <a href="#" class="detail-link">
                                        <p class="link-event">See detail</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="area-see-more">
                            <a href="">
                                <h2 class="see-more">See More</h2>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="line-info-news"></div>
            
        </div>
    </section>
    <section class="page-news-3">
        <div class="area-info-artis">
            <div class="header-info-artis">
                <h2 class="title-info-artis">Info Artis</h2>
            </div>
            <div class="area-box-info-artis">
                @foreach ($artis as $berita)
                    <div class="box-artis">
                        <div class="area-image-artis">
                            <img class="image-artis" src="./storage/{{ $berita->image_artis }}" alt="">
                            <div class="area-header-artis">
                                <h2 class="name-artis">{{ $berita->nama }}</h2>
                            </div>
                        </div>
                        <div class="area-bio-artis">
                            <div class="area-judul-berita">
                                <p class="judul-berita">{{ $berita->judul_berita }}</p>
                            </div>
                            <div class="area-konten-berita">
                                <p class="desk-berita">{{ strip_tags($berita->ringkasan_berita) }}</p>
                                {{-- <p class="desk-berita">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a eros vitae lectus consequat vulputate.
                                    Sed scelerisque turpis a felis consequat, ac pretium libero facilisis. Quisque non varius neque.
                                    Integer facilisis nisi non risus fermentum, sed faucibus massa blandit.
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a eros vitae lectus consequat vulputate.
                                </p> --}}
                                <a href="/detail-info-artis/{{ $berita->slug }}">
                                    <span class="see-more-news">See More Details</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div id="popupArtis" class="popup-artis" onclick="closePopupOutsideArtis(event)">
                    <div class="popup-content-artis">
                        <span class="close" onclick="closePopupArtis()">&times;</span>
                        <div class="popUp-area-info-artis">
                            <div class="area-popup-header">
                                <h2 class="header-popup-artis">#Info Artis</h2>
                            </div>
                            <div class="area-judul-berita">
                                <p class="popUp-judul-berita"></p>
                            </div>
                            <div class="popUP-area-konten-berita" id="style-popUp-scroll">
                                <p class="popUp-desk-berita"></p>
                                {{-- <p class="desk-berita">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a eros vitae lectus consequat vulputate.
                                    Sed scelerisque turpis a felis consequat, ac pretium libero facilisis. Quisque non varius neque.
                                    Integer facilisis nisi non risus fermentum, sed faucibus massa blandit.
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a eros vitae lectus consequat vulputate.
                                </p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="line-info-artis"></div>
        </div>
    </section>
    <script src="{{ asset('js/detailProgram.js?v=' . time()) }}"></script>
@endsection
