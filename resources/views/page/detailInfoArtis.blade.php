@extends('layout.main')
<base href="{{ url('/') }}/">

@push('meta-seo')
    <meta name="description" content="{{ $artis->meta_description }}">
    <meta name="keyword" content="{{ $artis->meta_keywords }}">
@endpush

@push('Style.css')
    <link rel="stylesheet" href="{{ asset('css/StyleContent/detailInfoArtis.css?v=' . time()) }}">
    <link rel="stylesheet" href="{{ asset('css/ResponsiveStyle/responsivedetailInfoArtis.css?v=' . time()) }}">
@endpush

@section('title', $artis->meta_title)
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
        <div class="area-info-news">
            <div class="content-info-news">
                <div class="content-IN-kiri" id="style-3">
                    <div class="area-info">
                        <div class="area-url-info">
                            <h2 class="url-info">
                                <a class="link-url-info" href="{{ url('/') }}">Home</a> >
                                {{ str_replace('-', ' ', request()->segment(1)) }} >
                                {{ str_replace('-', ' ', $artis->slug) }}
                            </h2>
                        </div>
                        <div class="area-span-info">
                            <p class="text-span-info">Info Artis </p>
                        </div>
                        <div class="area-title-info">
                            <h2 class="title-info">{{ $artis->judul_berita }}</h2>
                        </div>
                        <div class="area-date-info">
                            <p class="date-info">
                                {{ \Carbon\Carbon::parse($artis->tanggal_dibuat)->translatedFormat('l, d F Y') }}
                            </p>
                        </div>
                        <div class="area-image-info">
                            <img class="image-info" src="../storage/{{ $artis->image_artis }}" alt="">
                        </div>
                        <div class="area-desk-info">
                            {!! str($artis->konten_berita)->sanitizeHtml() !!}
                        </div>

                        {{-- <div class="area-tagar-info">
                            <div class="header-tagar">
                                <h2 class="text-header-tagar">Tags</h2>
                            </div>
                            <div class="area-text-tagar">
                                @if (is_array($info->tag_info))
                                    @foreach ($info->tag_info as $tag)
                                        <h2 class="tagar-info">#{{ $tag }}</h2>
                                    @endforeach
                                @else
                                    <h2 class="tagar-info">#-</h2>
                                @endif
                            </div>
                        </div> --}}
                    </div>
                    <div class="line-detail-info"></div>
                    <div class="area-info-artis">
                        <div class="header-info-artis">
                            <h2 class="title-info-artis">Info Artis Lainnya</h2>
                        </div>
                        <div class="area-box-info-artis">
                            @foreach ($artisO as $beritaO)
                                <div class="box-artis">
                                    <div class="area-image-artis">
                                        <img class="image-artis" src="./storage/{{ $beritaO->image_artis }}" alt="">
                                        <div class="area-header-artis">
                                            <h2 class="name-artis">{{ $beritaO->nama_artis }}</h2>
                                        </div>
                                    </div>
                                    <div class="area-bio-artis">
                                        <div class="area-judul-berita">
                                            <p class="judul-berita">{{ $beritaO->judul_berita }}</p>
                                        </div>
                                        <div class="area-konten-berita">
                                            <p class="desk-berita">{{ strip_tags($beritaO->ringkasan_berita) }}</p>
                                            {{-- <p class="desk-berita">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a eros vitae lectus consequat vulputate.
                                                Sed scelerisque turpis a felis consequat, ac pretium libero facilisis. Quisque non varius neque.
                                                Integer facilisis nisi non risus fermentum, sed faucibus massa blandit.
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a eros vitae lectus consequat vulputate.
                                            </p> --}}
                                            {{-- <span class="see-more-news" data-judul-berita="{{ $berita->judul_berita }}"
                                                data-desk-berita="{{ strip_tags($berita->konten_berita) }}"
                                                onclick="showPopupArtis(this)">See More Details</span> --}}
                                            <a href="/detail-info-artis/{{ $beritaO->slug }}">
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
                        <section class="section-banner-full-small {{ $banner->where('position', 'bottom_detail')->count() > 0 ? '' : 'hidden' }}">
                            <div class="area-banner-full-small">
                                <swiper-container class="mySwiper" id="swiper-l" centered-slides="true" autoplay-delay="2000"
                                    autoplay-disable-on-interaction="false" loop="true">
                                    @foreach ($banner->where('position', 'bottom_detail') as $list)
                                        <swiper-slide><a href="{{ $list->link_ads }}" class="link-ads-banner">
                                            <img class="image-banner" src="./storage/{{ $list->image_banner }}"
                                                alt="">
                                        </a></swiper-slide>
                                    @endforeach
                                </swiper-container>
                            </div>
                        </section>
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
                                    <a class="link-news" href="/info-kategori/{{ $kategoriInfoList->nama_kategori }}">
                                        <div class="area-tag-news">
                                            <h3 class="tag-news">{{ $kategoriInfoList->nama_kategori }}</h3>
                                        </div>
                                        {{-- @if ($kategoriInfoList->info->isNotEmpty())
                                            <img class="image-news"
                                                src="{{ asset('storage/' . $kategoriInfoList->info->first()->image_info) }}"
                                                alt="">
                                        @else
                                            <p>Tidak ada info untuk tag ini.</p>
                                        @endif --}}
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
                                    onclick="showPopupEvent(this)"
                                    data-description="{{ $eventUpcomingList->deskripsi_pendek }}"
                                    data-date="{{ \Carbon\Carbon::parse($eventUpcomingList->date_event)->format('d F Y') }}"
                                    data-slug="{{ $eventUpcomingList->slug }}" data-deskShort="{{ $eventUpcomingList->deskripsi_event }}">
                                    <img class="image-OV" src="./storage/{{ $eventUpcomingList->image_event }}" alt="">
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
                            <a href="/event">
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
        
    </section>
    <script src="{{ asset('js/infoArtis.js?v=' . time()) }}"></script>
@endsection
