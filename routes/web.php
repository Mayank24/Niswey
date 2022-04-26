<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\XmlController;
use Illuminate\Support\Facades\Auth;
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



Route::get("contacts", [ContactController::class, "index"])->name('contacts');
Route::post("contacts", [ContactController::class, "create"])->name('CreateContact');
Route::get("contacts/{id}", [ContactController::class, "destroy"])->name('delete');
Route::get("contacts/edit/{id}", [ContactController::class, "edit"])->name('edit');
Route::post("contacts/update/{id}", [ContactController::class, "update"])->name('update');
Route::post("save-xml", [XmlController::class, "store"])->name('save-xml');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
