<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Products;
use App\Http\Livewire\Transactions;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('product', Products::class)->name('product');
    Route::get('transaction', Transactions::class)->name('transaction');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require __DIR__.'/auth.php';
