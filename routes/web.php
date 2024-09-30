<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('page.home');
});


Route::get('/event', function () {
    return view('page.event');
});
