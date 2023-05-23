<?php

use Illuminate\Support\Facades\Route;

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
    return view('pageJson');
});

Route::get('display', [App\Http\Controllers\UserController::class, 'index']);

Route::get('/update-code/{id}', [App\Http\Controllers\UserController::class, 'UpdateCode']);

Route::get("/json", [App\Http\Controllers\TicketController::class, "page"]);

Route::get("/jsonPage", [App\Http\Controllers\TicketController::class, "jsonPage"]);

Route::get("/test", [App\Http\Controllers\TicketController::class, "test"]);