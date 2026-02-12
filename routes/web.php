<?php

use App\Http\Middleware\GuestMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::livewire('/login',"pages::login")->middleware(GuestMiddleware::class);


Route::prefix("/pegawai")
        ->middleware([UserMiddleware::class])
        ->group(function() {

            Route::livewire("/homepage","pages::pegawai.homepage")->name("pegawai.homepage");
    
            Route::livewire("/draft","pages::pegawai.draft")->name("pegawai.draft");
            Route::livewire("/create/draft","pages::pegawai.create.draft")->name("create.draft");
});