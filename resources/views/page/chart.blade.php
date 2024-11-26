@extends('layout.main')
<link rel="stylesheet" href="../css/StyleContent/chart.css">
<link rel="stylesheet" href="../css/ResponsiveStyle/responsiveChart.css">
@section('content')
    <section class="page-chart-1">
        <div class="area-chart">
            <div class="header-chart">
                <h2 class="title-chart">Ardan Chart</h2>
            </div>
            <div class="content-chart">
                <div class="area-top-chart">
                    @foreach ($kategori as $kategoriList)
                        <div class="tab-chart {{ $loop->first ? 'active' : '' }}" data-tab="{{ $kategoriList->id }}">
                            <h3 class="text-tab">{{ strtoupper($kategoriList->nama_kategori) }}</h3>
                        </div>
                    @endforeach
                </div>
                <div class="area-bottom-chart">
                    <div class="table-container">
                        @foreach ($kategori as $kategoriList)
                            <table class="chart {{ $loop->first ? '' : 'hidden' }}" id="{{ $kategoriList->id }}">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>ARTIST</th>
                                        <th>-</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kategoriList->charts as $index => $chart)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $chart->name }}</td>
                                            <td>
                                                <div class="btn-play-chart"
                                                    data-audio-src="./storage/{{ $chart->link_audio }}"
                                                    data-name="{{ $chart->name }}"
                                                    data-kategori="{{ $kategoriList->nama_kategori }}"
                                                    data-id="{{ $kategoriList->id }}">
                                                    <span class="material-symbols-rounded">play_arrow</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endforeach
                        <button id="toggle-button" class="btn-see-more" onclick="toggleTable()">See More</button>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section class="page-chart-2">
        <div class="area-streaming-news">
            <div class="area-content-SN">
                <div class="area-content-SN-kiri">
                    <div class="header-SN-kiri">
                        <h2 class="title-SN-kiri">Streaming</h2>
                    </div>
                    <div class="content-SN-kiri">
                        <div class="box-streaming">
                            <img class="image-streaming" src="./storage/{{ $stream->image_stream }}" alt="" srcset="">
                            <div class="btn-play-streaming" id="BtnStream"
                                    data-audio-src="{{ $stream->stream_audio_url }}">
                                    <span class="material-symbols-rounded">play_arrow</span>
                                </div>
                                <audio  class="audio-streaming"
                                    id="audio-streaming" preload="auto">
                                    <source type="audio/mpeg" src="{{ $stream->stream_audio_url }}" />
                                </audio>
                        </div>
                    </div>
                </div>
                <div class="area-content-SN-kanan">
                    <div class="header-news">
                        <h1 class="title-news">Top Info</h1>
                    </div>
                    <div class="content-news">
                        @foreach ($top_info as $topInfoList)
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


    <script src="../js/chart.js"></script>
@endsection
