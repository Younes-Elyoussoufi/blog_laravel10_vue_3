<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;



// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/{any}',fn()=> view('welcome'))->where('any','^(?![api|assets]\/).*');

// Route::get('/{any}', function () {
//     return view('welcome')->with('any','.*');
// });













// Route::resource('admin',AdminController::class);

