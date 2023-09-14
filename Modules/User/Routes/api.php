<?php

use Modules\User\Http\Controllers\Auth\LoginController;
use Modules\User\Http\Controllers\RegisterUserController;
use Modules\User\Http\Controllers\Auth\EmailVerificationController;
use Modules\User\Http\Controllers\UserController;

Route::post("register", [RegisterUserController::class, "register"])->name("register");
Route::post("login", [LoginController::class, "login"])->name("login");
Route::post("verify", [EmailVerificationController::class, "resentVerification"])->name("verify");
Route::post("verifying", [EmailVerificationController::class, "verifying"])->name("verifying");
Route::resource("me", UserController::class);
