<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;

Route:: get("/",[JobController::class,"index"]);
Route::get("/about",[JobController::class,"about"]);
Route::get("/contact",[JobController::class,"contact"]);