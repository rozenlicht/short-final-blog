<?php

use App\Http\Controllers\BlogArticleController;
use App\Http\Controllers\SlideshowController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [BlogArticleController::class, 'index'])->name('blog-article.index');

Route::get('/verslag/{blog_article}', [BlogArticleController::class, 'show'])->name('blog-article.show');

Route::get('/slideshow/{id}', [SlideshowController::class, 'embed'])->name('slideshow.embed');
Route::get('/photo-embed/{id}', [SlideshowController::class, 'photoEmbed'])->name('photo.embed');
Route::get('/audio-embed/{id}', [SlideshowController::class, 'audioEmbed'])->name('audio.embed');
