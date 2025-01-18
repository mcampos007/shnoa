<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/slider', function () {
    return view('slider');
});

// Página de inicio
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/nosotros', [HomeController::class, 'nosotros'])->name('nosotros');
Route::get('/wc-products', [HomeController::class, 'products'])->name('wc-products');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('products', ProductController::class)->except(['show']);
    // Ruta para restaurar un producto
    Route::patch('products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');
    //Manejo de las imágenes
    Route::get('products/{id}/images', [ProductController::class, 'manageImages'])->name('products.images.manage');
    Route::post('products/{id}/images', [ProductController::class, 'storeImage'])->name('products.images.store');
    Route::delete('products/{product}/images/{image}', [ProductController::class, 'destroyImage'])->name('products.images.destroy');
    Route::patch('products/{product}/images/{image}/feature', [ProductController::class, 'featureImage'])->name('products.images.feature');
    // Route::post('products/{product}/images', [ProductController::class, 'storeImage'])->name('products.images.store');
    Route::patch('products/{product}/images/{image}/unfeature', [ProductController::class, 'unfeatureImage'])->name('products.images.unfeature');
    // Ruta para restaurar una imagen
    Route::patch('products/{product}/images/{image}/restore', [ProductController::class, 'restoreImage'])->name('products.images.restore');
    // Ruta para eliminar definitivamente una imagen
    Route::delete('products/{product}/images/{image}/force', [ProductController::class, 'forceDeleteImage'])->name('products.images.force');



});

// require __DIR__.'/auth.php';
require 'auth.php';

