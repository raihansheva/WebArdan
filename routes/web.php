<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('page.home');
});

Route::get('/home', function () {
    return view('page.home');
});


Route::get('/event', function () {
    return view('page.event');
});

Route::get('/podcast', function () {
    return view('page.podcast');
});

Route::get('/detail-podcast', function () {
    return view('page.detailPodcast');
});

Route::get('/chart', function () {
    return view('page.chart');
});

Route::get('/ardan-youtube' , function () {
    return view('page.youtube');
});


Route::get('/info-news' , function () {
    return view('page.infoNews');
});



