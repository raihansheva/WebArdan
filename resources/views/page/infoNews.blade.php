@extends('layout.main')
<link rel="stylesheet" href="css/StyleContent/infoNews.css">
<link rel="stylesheet" href="css/ResponsiveStyle/responsiveInfoNews.css">
@section('content')
    <section class="page-news-1">
        <div class="header-info-news">
            @foreach ($bannerInfo as $bannerInfoList)
                <div class="image-header-info-news">
                    <h2 class="title-header">#{{ $bannerInfoList->title_banner_info }}</h2>
                    <img class="banner-info" src="../storage/{{ $bannerInfoList->banner_info }}" alt=""
                        srcset="">
                </div>
            @endforeach
        </div>
    </section>
    <section class="page-news-2">
        <div class="area-info-news">
            <div class="content-info-news">
                <div class="content-IN-kiri" id="style-3">
                    @foreach ($info as $infoList)
                        <div class="box-info">
                            <div class="content-box-info">
                                <div class="area-image-info">
                                    <img class="image-info" src="../storage/{{ $infoList->image_info }}" alt="">
                                </div>
                                <div class="area-info">
                                    <div class="area-tagar-info">
                                        <h2 class="tagar-info">#{{ $infoList->tagInfo->nama_tag }}</h2>
                                    </div>
                                    <div class="area-title-info">
                                        <h2 class="title-info">{{ $infoList->judul_info }}</h2>
                                    </div>
                                    <div class="area-desk-info">
                                        <p class="desk-info">{{ $infoList->deskripsi_info }}</p>
                                    </div>
                                    <div class="area-date-info">
                                        <p class="date-info">{{ $infoList->date_info }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="area-bottom-box-info">
                    <h2 class="title-bottom" onclick="toggleBoxes()">See more</h2>
                </div>

                <div class="content-IN-kanan">
                    <div class="area-news">
                        <div class="area-header-news">
                            <h2 class="header-news">Tag Info</h2>
                        </div>
                        <div class="area-box-news">
                            @foreach ($taginfo as $tagInfoList)
                                <div class="box-news">
                                    <a href="/info-tag/{{ $tagInfoList->nama_tag }}">
                                        <div class="area-tag-news">
                                            <h3 class="tag-news">#{{ $tagInfoList->nama_tag }}</h3>
                                        </div>
                                        @if ($tagInfoList->info->isNotEmpty())
                                            <img class="image-news"
                                                src="{{ asset('storage/' . $tagInfoList->info->first()->image_info) }}"
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
                    <div class="area-streaming">
                        <div class="area-header-streaming">
                            <h2 class="title-streaming">Streaming</h2>
                        </div>
                        <div class="area-thumbnail">
                            <a class="link-streaming" href="">
                                <div class="btn-play-streaming">
                                    <span class="material-symbols-rounded">play_arrow</span>
                                </div>
                            </a>
                        </div>
                        <div class="line-streaming"></div>
                    </div>
                    <div class="area-top-news">
                        <div class="header-top-news">
                            <h1 class="title-top-news">Top News</h1>
                        </div>
                        <div class="content-top-news">
                            @foreach ($top_info as $topInfoList)
                                <div class="box-top-news">
                                    <div class="area-top-image">
                                        <img class="image-top-info" src="./storage/{{ $topInfoList->image_info }}"
                                            alt="">
                                    </div>
                                    <div class="area-top-text">
                                        <p class="desk-top-news">{{ $topInfoList->deskripsi_info }}</p>
                                    </div>
                                </div>
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
                                    data-description="{{ $eventUpcomingList->deskripsi_event }}"
                                    data-date="{{ \Carbon\Carbon::parse($eventUpcomingList->date_event)->format('d F Y') }}">
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
                                    <a href="/event">
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
                @foreach ($artis as $artisList)
                    <div class="box-artis">
                        <img class="image-artis" src="./storage/{{ $artisList->image_artis }}" alt="">
                        <div class="area-bio-artis">
                            <div class="artis-name">
                                <p class="nama">{{ $artisList->nama }}</p>
                            </div>
                            <div class="artis-bio">
                                <p class="bio">{{ $artisList->bio }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="line-info-artis"></div>
        </div>
    </section>
    <script src="js/infoNews.js"></script>
@endsection
