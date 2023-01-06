<?php

use App\Http\Controllers\ApiClientAgamaController81;
use App\Http\Controllers\ApiClientUserController81;
use App\Http\Controllers\Login81Controller;
use App\Http\Controllers\User81Controller;
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

// LOGIN CONTROLLER
Route::get('/register81', [Login81Controller::class, 'register81']);
Route::post('/prosesregister81', [Login81Controller::class, 'store81']);
Route::get('/login81', [Login81Controller::class, 'login81'])->name('login81');
Route::post('/proseslogin81', [Login81Controller::class, 'proseslogin81']);
Route::get('/logout81', [Login81Controller::class, 'logout81']);

Route::middleware('auth')->group(function () {
    // USER CONTROLLER
    Route::get('/', [User81Controller::class, 'index81']);
    Route::get('/tambah81', [User81Controller::class, 'addPenduduk81']);
    Route::post('/prosestambah81', [User81Controller::class, 'store81']);
    Route::get('/edit81/{id}', [User81Controller::class, 'editPenduduk81']);
    Route::post('/prosesupdate81/{id}', [User81Controller::class, 'update81']);
    Route::get('/prosesdelete81/{id}', [User81Controller::class, 'destroy81']);
    Route::get('/admin81', [User81Controller::class, 'admin81']);
    Route::get('/crudagama81', [User81Controller::class, 'crudagama81']);
    Route::get('/confirm81', [User81Controller::class, 'confirm81']);
    Route::get('/statusaktif81/{id}', [User81Controller::class, 'statusaktif81']);
    Route::get('/statusnonaktif81/{id}', [User81Controller::class, 'statusnonaktif81']);
    Route::post('/ubahfotoprofil81', [User81Controller::class, 'ubahfotoprofil81']);
    Route::post('/ubahfotoktp81', [User81Controller::class, 'ubahfotoktp81']);
    Route::post('/ubahdatauser81', [User81Controller::class, 'ubahdatauser81']);
    Route::post('/ubahagama81', [User81Controller::class, 'ubahagama81']);
    Route::post('/tambahagama81', [User81Controller::class, 'tambahagama81']);
    Route::get('/detail81/{id}', [User81Controller::class, 'detail81']);
    Route::post('/ubahpassword81', [User81Controller::class, 'ubahpassword81']);
    Route::get('/deleteagama81/{id}', [User81Controller::class, 'deleteagama81']);

    // API CONTROLLER AGAMA
    Route::get("/agama/clientapi/listagama81", [ApiClientAgamaController81::class, 'index']);
    Route::post("/agama/clientapi/prosesaddagama81", [ApiClientAgamaController81::class, 'store']);
    Route::get("/agama/clientapi/editagama81/{id}", [ApiClientAgamaController81::class, 'edit']);
    Route::put("/agama/clientapi/proseseditagama81/{id}", [ApiClientAgamaController81::class, 'update']);
    Route::delete("/agama/clientapi/prosesdelete81/{id}", [ApiClientAgamaController81::class, 'destroy']);

    // API CONTROLLER USER
    Route::get("/user/clientapi/user81", [ApiClientUserController81::class, 'user']);
    Route::put("/user/clientapi/prosesedituser81/{id}", [ApiClientUserController81::class, 'updateuser']);
    Route::put("/user/clientapi/ubahpassword81", [ApiClientUserController81::class, 'ubahpassword']);
    Route::put("/user/clientapi/ubahfotoprofil81", [ApiClientUserController81::class, 'ubahfotoprofil81']);
    Route::put("/user/clientapi/ubahktpuser81", [ApiClientUserController81::class, 'ubahktpuser81']);

    // API CONTROLLER ADMIN
    Route::get("/admin/clientapi/dashboard81", [ApiClientUserController81::class, 'admin']);
    Route::put("/admin/clientapi/statusaktif81/{id}", [ApiClientUserController81::class, 'statusaktif']);
    Route::put("/admin/clientapi/statusnonaktif81/{id}", [ApiClientUserController81::class, 'statusnonaktif']);
    Route::get("/admin/clientapi/detailuser81/{id}", [ApiClientUserController81::class, 'detailuser']);
});
