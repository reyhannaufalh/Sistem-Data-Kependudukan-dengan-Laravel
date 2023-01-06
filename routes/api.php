<?php

use App\Http\Controllers\Api\Api81Controller;
use App\Http\Controllers\Api\ApiUser81Controller;
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
    return $request->user();
});

// API Agama
Route::get('/agama/listagama81', [Api81Controller::class, 'index']);
Route::get('/agama/detailagama81/{id}', [Api81Controller::class, 'show']);
Route::post('/agama/add', [Api81Controller::class, 'store']);
Route::put('/agama/update/{id}', [Api81Controller::class, 'update']);
Route::delete('/agama/delete/{id}', [Api81Controller::class, 'destroy']);

// API User
// Route::get('/user/user81', [ApiUser81Controller::class, 'user']);
Route::get('/user/user81/{id}', [ApiUser81Controller::class, 'user']);
Route::put('/user/updateuser/{id}', [ApiUser81Controller::class, 'updateuser']);
Route::put('/user/ubahpassword81', [ApiUser81Controller::class, 'ubahpassword']);
Route::put('/user/ubahfotoprofil81', [ApiUser81Controller::class, 'ubahfotoprofil81']);
Route::put('/user/ubahktpuser81', [ApiUser81Controller::class, 'ubahktpuser81']);

// API Admin
Route::get('/admin/dashboard81', [ApiUser81Controller::class, 'admin']);
Route::put('/admin/statusaktif81/{id}', [ApiUser81Controller::class, 'statusaktif']);
Route::put('/admin/statusnonaktif81/{id}', [ApiUser81Controller::class, 'statusnonaktif']);
Route::get('/admin/detailuser81/{id}', [ApiUser81Controller::class, 'detailuser']);
