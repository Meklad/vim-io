<?php

use Illuminate\Http\Request;
use Modules\User\Http\Controllers\Auth\LoginController;
use Modules\User\Http\Controllers\RegisterUserController;

Route::post("register", [RegisterUserController::class, "register"])->name("register");
Route::post("login", [LoginController::class, "login"])->name("login");

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
