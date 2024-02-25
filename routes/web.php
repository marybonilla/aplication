<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::view('/', 'welcome')->name("welcome");




Route::middleware('auth')->group(function () {

Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get ('/chirps', function(){
        return view('chirps.index');
    })-> name('chirps.index');
    Route::post ('/chirps', function(){
        $message= request('message');
    });
});

require __DIR__.'/auth.php';
