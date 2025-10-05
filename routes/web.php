<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\CSVExportController;


Route::middleware('guest_or_customer')->group(function() {
    Route::get('/', [RouteController::class, 'goToLandingPage'])->name('landing.page');
});

Route::middleware('guest')->group(function () {
    Route::get('/signin', [RouteController::class, 'goToSigninPage'])->name('signin.page');
    Route::get('/signup', [RouteController::class, 'goToSignupPage'])->name('signup.page');
    Route::post('/signin', [AuthController::class, 'userSignin'])->name('signin');
    Route::post('/signup', [AuthController::class, 'userSignup'])->name('signup');
});



Route::middleware('role:customer,admin,admin_officer,cashier,technician')->group(function () {
    Route::post('/signout', [AuthController::class, 'userSignout'])->name('signout');
});

Route::middleware('role:customer,admin,admin_officer,cashier')->group(function () {
    Route::post('/order', [OrderController::class, 'createOrder'])->name('create.order');
});

Route::middleware('role:admin,admin_officer,cashier')->group(function () {
    Route::get('/export/sales', [CSVExportController::class, 'exportSales'])->name('export.sales');
});

Route::middleware('role:admin,admin_officer')->group(function () {
    Route::get('/export/expenses', [CSVExportController::class, 'exportExpenses'])->name('export.expenses');
});



// Role Specific Routes
Route::middleware('role:customer')->group(function () {
    Route::get('/checkout', [RouteController::class, 'goToCheckoutPage'])->name('checkout.page');
});

Route::middleware('role:admin')->group(function() {
    Route::get('/admin', [RouteController::class, 'goToAdminPage'])->name('admin');
    Route::get('/export/all', [CSVExportController::class, 'exportAll'])->name('export.all');
});

Route::middleware('role:admin_officer')->group(function() {
    Route::get('/admin_officer', [RouteController::class, 'goToAdminOfficerPage'])->name('admin_officer');
});

Route::middleware('role:cashier')->group(function() {
    Route::get('/cashier', [RouteController::class, 'goToCashierPage'])->name('cashier');
});

Route::middleware('role:technician')->group(function() {
    Route::get('/technician', [RouteController::class, 'goToTechnicianPage'])->name('technician');
});

