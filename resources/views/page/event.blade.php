@extends('layout.main')
<link rel="stylesheet" href="css/StyleContent/event.css">
<link rel="stylesheet" href="css/StyleContent/responsiveEvent.css"
@section('content')
    <section class="page-event-1">
        <div class="area-event">
            <div class="header-event">
                <h2 class="title-event">Upcoming Event</h2>
            </div>
            <div class="content-event">
                <div class="content-event-CD">
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
    <section class="page-event-2">
        <div class="area-other-event">
            <div class="header-other-event">
                <h2 class="title-event-other">Other Upcoming Event</h2>
            </div>
            <div class="area-content-OV">
                <div class="content-event-OV">
                    <div class="area-days-date-right">
                        <div class="content-days-date-right">
                            <div class="box-days-date-right">
                                <h3 class="date-month-right">12 Oktober</h3>
                                <h3 class="year-right">2024</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-event-OV">
                    <div class="area-days-date-right">
                        <div class="content-days-date-right">
                            <div class="box-days-date-right">
                                <h3 class="date-month-right">12 Oktober</h3>
                                <h3 class="year-right">2024</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-event-OV">
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
                <div class="box-programE"></div>
                <div class="box-programE"></div>
                <div class="box-programE"></div>
                <div class="box-programE"></div>
            </div>
        </div>
    </section>
    <script src="js/event.js"></script>
@endsection