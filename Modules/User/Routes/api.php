<?php

use Illuminate\Http\Request;
use Modules\User\Http\Controllers\Auth\LoginController;
use Modules\User\Http\Controllers\RegisterUserController;
use Modules\User\Http\Controllers\Auth\EmailVerificationController;

Route::post("register", [RegisterUserController::class, "register"])->name("register");
Route::post("login", [LoginController::class, "login"])->name("login");
Route::post("verify", [EmailVerificationController::class, "resentVerification"])->name("verify");


