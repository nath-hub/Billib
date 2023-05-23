<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//   Route::get('/GetUser/{id}', [App\Http\Controllers\UserController::class, 'show']);
});



Route::post('/register', [App\Http\Controllers\UserController::class, 'register']);

 Route::get('/GetUser/{id}', [App\Http\Controllers\UserController::class, 'show'])->middleware('auth:sanctum');


Route::put('/updateCode/{id}', [App\Http\Controllers\UserController::class, 'modifierCode'])->middleware('auth:sanctum');

Route::get('/update-code/{id}', [App\Http\Controllers\UserController::class, 'UpdateCode']);

Route::put('/UpdateVerifiedEmail/{id}', [App\Http\Controllers\UserController::class, 'VerifyEmail']);

Route::put('/updatePassword/{id}', [App\Http\Controllers\UserController::class, 'modifierPassword'])->middleware('auth:sanctum');

Route::post('/login', [App\Http\Controllers\UserController::class, 'login']);

Route::delete('/logout/{id}', [App\Http\Controllers\UserController::class, 'logout'])->middleware('auth:sanctum');

Route::delete('/delete/{id}', [App\Http\Controllers\UserController::class, 'delete']);


//tikect
Route::post('/AddTicket/{id}', [App\Http\Controllers\TicketController::class, 'AddTicket']);
Route::get('/getArticle/{id}', [App\Http\Controllers\TicketController::class, 'show'])->middleware('auth:sanctum');

Route::get('/getByUser/{id}', [App\Http\Controllers\TicketController::class, 'getWhereUser'])->middleware('auth:sanctum');
Route::get('/getTicketByUser/{id}', [App\Http\Controllers\TicketController::class, 'getTicketByUser'])->middleware('auth:sanctum');

Route::put('/updateTicket/{id}', [App\Http\Controllers\TicketController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/destroyTicket/{id}', [App\Http\Controllers\TicketController::class, 'destroy'])->middleware('auth:sanctum');


//article

Route::put('/updateArticle/{id}', [App\Http\Controllers\ArticleController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/destroyArticle/{id}', [App\Http\Controllers\ArticleController::class, 'destroy'])->middleware('auth:sanctum');
Route::get('/getPrix/{id}', [App\Http\Controllers\ArticleController::class, 'getPrix']);
Route::get('/getPrixByMonth/{id}', [App\Http\Controllers\ArticleController::class, 'getPrixByMonth']);

Route::get("/json", [App\Http\Controllers\TicketController::class, 'json']);
Route::get("/json1", [App\Http\Controllers\TicketController::class, 'json1']);
