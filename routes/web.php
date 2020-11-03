<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::post('/login', [AuthController::class, 'login']);

Route::get('/me', [AuthController::class, 'me']);

Route::middleware('auth:web')->get('/webuser', function (Request $request) {
    return "test"; //$request->user();
});


Route::get('/authentication_error', function () {
    echo "Authenticatie fout";
})->name('authentication_error');