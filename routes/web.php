<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;


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
Route::post('/contacto', [ContactController::class, 'sendContactForm'])->name('contact.send');

//Rutas para el cart
Route::get('/cart', [HomeController::class, 'cart'])->name('cart.index');
//Ruta para llamar a la método de agregar al carrito que debe llamar la vista con los datos del producto y los botones para agregar al carrito
Route::get('/cart/add/{id}', [HomeController::class, 'viewAddToCart'])->name('cart.add');
Route::post('/cart/add', [HomeController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/send-order', [HomeController::class, 'sendOrder'])->name('cart.sendOrder');

Route::post('/cart/update-quantity', [HomeController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::post('/cart/remove-item', [HomeController::class, 'removeItem'])->name('cart.removeItem');



// Route::get('/ws-categories/{id}', [HomeController::class, 'getCategoryDetails'])->name('ws-categories');
Route::get('ws-categories/{categoryId}', [HomeController::class, 'getCategoryData']);
Route::get('ws-subcategories/{subcategoryId}', [HomeController::class, 'getSubcategoryProducts']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('categories', CategoryController::class)->except(['show']);

    //Rutas para subcategorias
    Route::get('subcategories/{id}', [SubcategoryController::class, 'index'])->name('subcategories.index');
    // Subcategorias por categoría
    Route::get('/categories/{id}/subcategories', [SubcategoryController::class, 'getSubcategoriesByCategory']);

    Route::get('categories/{category}/subcategories/create', [SubCategoryController::class, 'create'])->name('subcategories.create');
    Route::post('categories/{category}/subcategories', [SubcategoryController::class, 'store'])->name('subcategories.store');
    Route::get('categories/{category}/subcategories/{subcategory}/edit', [SubcategoryController::class, 'edit'])->name('subcategories.edit');
    Route::patch('categories/{category}/subcategories/{subcategory}', [SubcategoryController::class, 'update'])->name('subcategories.update');
    Route::delete('categories/{category}/subcategories/{subcategory}', [SubcategoryController::class, 'destroy'])->name('subcategories.destroy');

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

