<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
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


    //Products Routes
    Route::get('/category/list', [CategoryController::class, 'display'])->name('category.display');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::post('/category/delete', [CategoryController::class, 'delete'])->name('category.delete');
    Route::post('/category/update', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category/paginate', [CategoryController::class, 'paginate'])->name('category.paginate');
    Route::get('/category/search', [CategoryController::class, 'search'])->name('category.search');


});





//Route::controller(ProfileController::class,)->group(function(){

//});

require __DIR__.'/auth.php';
