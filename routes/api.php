<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;

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

Route::controller(AuthController::class)->group(function(){

    Route::post('register','register');
    Route::post('login','login');

});

Route::controller(CompanyController::class)->group(function(){

    Route::get('structures','structures');
    Route::get('get_structure/{id}','get_structure');
    Route::get('delete_structure/{id}','delete_structure');
    Route::post('create_company','create_company');
    Route::post('edit_structure/{id}','edit_structure');
   
});
Route::controller(JobController::class)->group(function(){

    Route::get('jobs','jobs');
    Route::get('get_job/{id}','get_job');
    Route::get('delete_job/{id}','delete_job');
    Route::post('create_job','create_job');
    Route::post('edit_job/{id}','edit_job');
   
});
Route::controller(UserController::class)->group(function(){

    // Route::get('jobs','jobs');
    // Route::get('get_job/{id}','get_job');
    // Route::get('delete_job/{id}','delete_job');
    Route::post('create_user','create_user');
    // Route::post('edit_job/{id}','edit_job');
   
});

