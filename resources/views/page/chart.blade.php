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
                    <div class="tab-chart">
                        <h3 class="text-tab">TOP 20</h3>
                    </div>
                    <div class="tab-chart">
                        <h3 class="text-tab">TOP 20</h3>
                    </div>
                    <div class="tab-chart">
                        <h3 class="text-tab">TOP 20</h3>
                    </div>
                    <div class="tab-chart">
                        <h3 class="text-tab">TOP 20</h3>
                    </div>
                </div>
                <div class="area-bottom-chart">
                    <div class="table-container">
                        <table class="chart">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>ARTIST</th>
                                    <th>-</th>
                                </tr>
                            </thead>
                            <tbody id="chart-body">
                                <tr>
                                    <td>1</td>
                                    <td>John Doe</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jane Smith</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Michael Brown</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Emily Davis</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Chris Lee</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>Sarah Johnson</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>David Martinez</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>Rachel Adams</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>Tom Ford</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
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
                        <div class="box-streaming"></div>
                    </div>
                </div>
                <div class="area-content-SN-kanan">
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
                </div>
            </div>
        </div>
    </section>


<script src="../js/chart.js"></script>
@endsection