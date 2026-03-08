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
    
            // draft route
            Route::livewire("/draft","pages::pegawai.draft.draft")->name("pegawai.draft");
            Route::livewire("/draft/detail/{draft}","pages::pegawai.draft.detail")->name("pegawai.draft.detail");
            Route::livewire("/create/draft","pages::pegawai.draft.create")->name("create.draft");
            Route::livewire("/edit/draft/{draft}","pages::pegawai.draft.update")->name("update.draft");

            // news route
            Route::livewire("/berita","pages::pegawai.berita.index")->name("pegawai.berita");
            Route::livewire("/berita/{news:slug}","pages::pegawai.berita.show")->name("pegawai.berita.show");
            Route::livewire("/berita/{news:slug}/edit","pages::pegawai.berita.edit")->name("pegawai.berita.edit");
});
