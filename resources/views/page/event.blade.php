@extends('layout.main')
<link rel="stylesheet" href="css/StyleContent/event.css">
<link rel="stylesheet" href="css/ResponsiveStyle/responsiveEvent.css"
@section('content')
    <section class="page-event-1">
        <div class="area-event">
            <div class="header-event">
                <h2 class="title-event">Upcoming Event</h2>
            </div>
            <div class="content-event">
                <div class="content-event-CD" onclick="showPopupEvent()">
                </div>
                <div class="area-countdown">
                    <div class="area-content-countdown">
                        <div class="countdown">
                            <div class="time-countdown">
                                <h2 class="timer" id="days"></h2>
                                <span class="title-timer">Days</span>
                            </div>
                            <div class="time-countdown">
                                <h2 class="timer" id="hours"></h2>
                                <span class="title-timer">Hours</span>
                            </div>
                            <div class="time-countdown">
                                <h2 class="timer" id="minutes"></h2>
                                <span class="title-timer">Minutes</span>
                            </div>
                            <div class="time-countdown">
                                <h2 class="timer" id="seconds"></h2>
                                <span class="title-timer">Second</span>
                            </div>
                        </div>
                        <div class="area-days-date">
                            <div class="box-days-date">
                                <h3 class="date-month">5 Oktober</h3>
                                <h3 class="year">2024</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="popupEvent" class="popup-event" onclick="closePopupOutsideEvent(event)">
        <div class="popup-content-event">
            <div class="area-info-event">
                {{-- <span class="close" onclick="closePopup()">&times;</span> --}}
                <p class="desk-event">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat quas
                    iste tenetur nihil accusantium ea quibusdam harum excepturi expedita debitis!</p>
                <h2 class="title-box-event">5 Oktober 2024</h2>
                <a href="/event">
                    <p class="link-event">See detail</p>
                </a>
            </div>
        </div>
    </div>
    <section class="page-event-2">
        <div class="area-other-event">
            <div class="header-other-event">
                <h2 class="title-event-other">Other Upcoming Event</h2>
            </div>
            <div class="area-content-OV">
                <div class="content-event-OV" onclick="showPopupEvent()">
                    <div class="area-days-date-right">
                        <div class="content-days-date-right">
                            <div class="box-days-date-right">
                                <h3 class="date-month-right">12 Oktober</h3>
                                <h3 class="year-right">2024</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-event-OV" onclick="showPopupEvent()">
                    <div class="area-days-date-right">
                        <div class="content-days-date-right">
                            <div class="box-days-date-right">
                                <h3 class="date-month-right">12 Oktober</h3>
                                <h3 class="year-right">2024</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-event-OV" onclick="showPopupEvent()">
                    <div class="area-days-date-right">
                        <div class="content-days-date-right">
                            <div class="box-days-date-right">
                                <h3 class="date-month-right">12 Oktober</h3>
                                <h3 class="year-right">2024</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="line-event"></div>
        </div>
    </section>
    <section class="page-event-3">
        <div class="area-programE">
            <div class="header-programE">
                <h2 class="title-programE">Program Ardan</h2>
            </div>
            <div class="content-programE">
                <div class="box-programE" onclick="showPopup()"></div>
                <div class="box-programE" onclick="showPopup()"></div>
                <div class="box-programE" onclick="showPopup()"></div>
                <div class="box-programE" onclick="showPopup()"></div>
            </div>
        </div>
        <div id="popup" class="popup" onclick="closePopupOutside(event)">
            <div class="popup-content">
                <div class="area-info-program">
                    {{-- <span class="close" onclick="closePopup()">&times;</span> --}}
                    <p class="desk-program">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat quas iste
                        tenetur nihil accusantium ea quibusdam harum excepturi expedita debitis!</p>
                    <p class="jam-program">Minggu | 16.00 - 18.00</p>
                    <h2 class="title-box-program">Judul Program</h2>
                </div>
            </div>
        </div>
    </section>
    <script src="js/event.js"></script>
@endsection