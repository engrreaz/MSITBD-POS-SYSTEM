<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ProductsController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
| labib
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard2', function () {
    return view('dashboard2');
})->middleware(['auth', 'verified'])->name('dashboard2');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //Category Routes
    Route::get('/category/list', [CategoryController::class, 'display'])->name('category.display');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::post('/category/delete', [CategoryController::class, 'delete'])->name('category.delete');
    Route::post('/category/update', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category/paginate', [CategoryController::class, 'paginate'])->name('category.paginate');
    Route::get('/category/search', [CategoryController::class, 'search'])->name('category.search');


    //Sub Categories Routes
    Route::get('/subcategory/list', [SubCategoryController::class, 'display'])->name('subcategory.display');
    Route::post('/subcategory/store', [SubCategoryController::class, 'store'])->name('subcategory.store');
    Route::post('/subcategory/delete', [SubCategoryController::class, 'delete'])->name('subcategory.delete');
    Route::post('/subcategory/update', [SubCategoryController::class, 'update'])->name('subcategory.update');
    Route::get('/subcategory/paginate', [SubCategoryController::class, 'paginate'])->name('subcategory.paginate');
    Route::get('/subcategory/search', [SubCategoryController::class, 'search'])->name('subcategory.search');


    //Products Routes
    Route::get('/products/list', [ProductsController::class, 'display'])->name('products.display');
    Route::post('/products/store', [ProductsController::class, 'store'])->name('products.store');
    Route::post('/products/delete', [ProductsController::class, 'delete'])->name('products.delete');
    Route::post('/products/update', [ProductsController::class, 'update'])->name('products.update');
    Route::get('/products/paginate', [ProductsController::class, 'paginate'])->name('products.paginate');
    Route::get('/products/search', [ProductsController::class, 'search'])->name('products.search');


});





//Route::controller(ProfileController::class,)->group(function(){

//});

require __DIR__.'/auth.php';
