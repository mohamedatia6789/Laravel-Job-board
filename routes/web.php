<?php

use App\Http\Controllers\CommemtsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;   
use App\Http\Controllers\ReactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\TagController;


Route:: get("/",[JobController::class,"index"]);


Route::get("/about",[JobController::class,"about"]);
Route::get("/contact",[JobController::class,"contact"]);





Route::middleware(['auth'])->group(function () {
      //Admin
   Route::middleware(['Admin:Admin'])->group(function () {
      
      });
        // Editor 
   Route::middleware(['Admin:Admin,Editor'])->group(function () {   
      
      Route::get("/blog/create",[PostController::class,"create"]);
      Route::post("/blog", [PostController::class, 'store'])->name('posts.store');
      Route::get("/blog/{post}/edit",[PostController::class,"edit"])->can('update', 'post')->name('posts.edit');
      Route::put("/blog/{post}",[PostController::class,"update"])->can('update', 'post')->name('posts.update');
      Route::delete('/blog/{post}',[PostController::class,"destroy"])->can('delete', 'post')->name('posts.destroy');
   });

   //Viewer Person 

   Route::middleware(['Admin:viewer,Editor,Admin'])->group(function () {
      Route::get("/blog",[PostController::class,"index"])->name('posts.index');
      Route::get("/blog/{post}",[PostController::class,"show"])->name('posts.show');
   });
  
});
Route::middleware(['auth'])->group(function () {
    Route::post('/posts/{post}/likes', [ReactionController::class, 'toggleLike'])->name('posts.like');
});

Route::put('/blog/{post}/published', [PostController::class, 'updatePublished'])->can('published', 'post')->name('posts.updatePublished');


Route::post('/blog', [PostController::class, 'store'])->name('posts.store');

Route::resource("comment",CommemtsController::class);


Route::get("/signup",[AuthController::class,"showSignupForm"])->name('signup');
Route::get("/login", [AuthController::class, "showLoginForm"])->name('login');

Route::post("/login", [AuthController::class, 'login']);
Route::post("/signup", [AuthController::class, 'signup']);
Route::post("/logout", [AuthController::class, 'logout'])->name('logout');

Route::delete('/account/delete', [AuthController::class, 'deleteAccount'])->name('account.delete');

Route::get("/Tags",[TagController::class,"index"]);
Route::get("/Tags/create",[TagController::class,"create"]);
Route::get("/Tags/delete",[TagController::class,"deleting"]);

Route::get("/many",[PostController::class,"connecting_tag"]);



// API routes for authentication
