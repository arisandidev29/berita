<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::livewire('/login',"pages::login");

Route::livewire("/pegawai/homepage","pages::pegawai.homepage");