<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AppBannerController;
use App\Http\Controllers\Admin\BranchController;


Route::prefix(env('ADMIN_PREFIX'))->name('admin.')->group(function(){

    //Login Routes
    Route::get('/login',[LoginController::class,'showLoginForm'])->name('login');
    Route::post('/login',[LoginController::class,'login']);
    Route::post('/logout',[LoginController::class,'logout'])->name('logout');
});

Auth::routes();

Route::prefix(env('ADMIN_PREFIX'))->name('admin.')->middleware(['auth:admin'])->group(function(){

    //Dashboard
    Route::get('/dashboard',[HomeController::class,'dashboard'])->name('dashboard');

    //Category
    Route::get('category/{id}/delete', [CategoryController::class,'destroy'])->name('category.delete');
    Route::resource('category', CategoryController::class);

    //App Banner
    Route::get('app-banner/{id}/delete', [AppBannerController::class,'destroy'])->name('appBanner.delete');
    Route::resource('app-banner',AppBannerController::class);

    //Product
    Route::get('product/{id}/delete', [ProductController::class,'destroy'])->name('product.delete');
    Route::get('product/{product}/{gallery}/delete-image', [ProductController::class,'deleteImage'])->name('product.deleteImage');
    Route::post('/product/upload-images', [ProductController::class,'uploadGalleryImages'])->name('product.uploadGalleryImages');
    Route::post('/product/slices', [ProductController::class, 'slices'])->name('product.slices');

    Route::resource('product', ProductController::class);

    //Branch
    Route::get('branch/{id}/delete', [BranchController::class, 'destroy'])->name('branch.delete');
    Route::resource('branch', BranchController::class);

    //File Uploader
    Route::post('/fileUploadEditor', [HomeController::class,'fileUploadEditor'])->name('fileUploadEditor');
});
