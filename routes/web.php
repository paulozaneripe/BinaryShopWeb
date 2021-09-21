<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PCBuildController;

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

Route::group(['middleware' => ['AlreadyLoggedIn']], function(){

    Route::get('/login', function () {
        return view('auth/login');
    });
    Route::get('/register', function () {
        return view('auth/register');
    });

    Route::get('/forgot-password', function () {
        return view('auth/forgotPassword');
    });
    Route::get('/reset-password', [ResetPasswordController::class,'redirect']);
    Route::get('/reset-password/{token}', [ResetPasswordController::class,'resetView']);

    Route::post('login', [UserAuthController::class,'userLogin']);
    Route::post('register', [UserAuthController::class,'userRegister']);
    Route::post('forgot-password', [ResetPasswordController::class,'forgotPassword']);
    Route::post('reset-password-success', [ResetPasswordController::class,'resetPassword']);
});

Route::group(['middleware' => ['isLogged']], function(){

    Route::get('/', [PCBuildController::class, 'list']);
    Route::get('/products', [ProductController::class,'list']);
    Route::get('/products/{id}', [ProductController::class,'show']);
    Route::get('/build-pc', [PCBuildController::class, 'buildPC']);
    Route::post('/build', [PCBuildController::class, 'post']);
    Route::get('/pc-builds', [PCBuildController::class, 'userList']);
    Route::get('/pc-builds/{id}', [PCBuildController::class,'show']);
});

Route::group(['middleware' => ['isLogged','isUser']], function(){
    Route::get('/pc-builds/{id}/edit', [PCBuildController::class,'edit']);
    Route::put('/pc-builds/{id}/update', [PCBuildController::class,'put']);
    Route::delete('/pc-builds/{id}/delete', [PCBuildController::class,'delete']);
});

Route::group(['middleware' => ['isLogged','isAdmin']], function(){

    Route::get('/create-product', [ProductController::class, 'createProduct']);
    Route::post('product', [ProductController::class, 'post']);
    Route::get('/products/{id}/edit', [ProductController::class,'edit']);
    Route::put('/products/{id}/update', [ProductController::class,'put']);
    Route::delete('/products/{id}/delete', [ProductController::class,'delete']);
});

Route::get('/logout', [UserAuthController::class, 'logout']);



