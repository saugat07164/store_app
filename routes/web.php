<?php
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProductSaleController;
use App\Http\Controllers\RepairJobController;

Route::resource('brands', BrandController::class);
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('customers', CustomerController::class);
Route::resource('sales', SaleController::class);
Route::resource('product-sales', ProductSaleController::class);
Route::resource('repair-jobs', RepairJobController::class);
Route::get('about/', [AboutController::class, 'showAboutPage'])->name('about');
Route::get('/sales/{sale}/download-invoice', [SaleController::class, 'downloadInvoice'])->name('sales.download-invoice');


Route::get('/', [ProductController::class, 'showWelcomePage']);