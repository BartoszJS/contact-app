<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/contacts', [ContactController::class,'index'])->name('contacts.index')->middleware('auth');

Route::post('/contacts', [ContactController::class,'store'])->name('contacts.store')->middleware('auth');

Route::get('/contacts/create',[ContactController::class,'create'])->name('contacts.create')->middleware('auth');

Route::get('/contacts/{id}',[ContactController::class,'show'])->name('contacts.show')->middleware('auth');

Route::put('/contacts/{id}',[ContactController::class,'update'])->name('contacts.update')->middleware('auth');

Route::delete('/contacts/{id}',[ContactController::class,'destroy'])->name('contacts.destroy')->middleware('auth');

Route::get('/contacts/{id}/edit',[ContactController::class,'edit'])->name('contacts.edit')->middleware('auth');

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
