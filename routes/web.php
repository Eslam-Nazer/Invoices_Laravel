<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController as Authentication;
use App\Http\Controllers\InvoicesController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [Authentication::class, "create"]);
Route::get("/logout", [Authentication::class, "destroy"])->name("logout");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
/**
 * Route resource and recognize function in front ex: route("invoices.index")
 */
// Route::resource("invoices", InvoicesController::class);
/**
 * Group of routes in InvoicesController
 */
Route::controller(InvoicesController::class)->group(function () {
    Route::get("invoice", "index")->name("invoices");
});


Route::get('/{page}', [AdminController::class, "index"]);
