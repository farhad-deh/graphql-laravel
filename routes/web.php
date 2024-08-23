<?php

use App\Livewire\Restaurant\Index;
use App\Livewire\Restaurant\Single;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'restaurants'], function () {
    Route::get('/', Index::class);
    Route::get('/{restaurant}', Single::class);
});

Route::get('auth/register',\App\Livewire\Auth\Register::class);
