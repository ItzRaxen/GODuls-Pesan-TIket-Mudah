<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| GODuls Travel E-Commerce - Laravel Migration
| Migrated from React SPA (App.tsx) to Laravel Blade + MVC
|
*/

// ===========================
// PUBLIC PAGES
// ===========================

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// All Destinations
Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');

// Booking Page (show form)
Route::get('/destinations/{id}/booking', [DestinationController::class, 'showBooking'])->name('booking.show');

// Booking Submit (store booking in session)
Route::post('/destinations/{id}/booking', [BookingController::class, 'store'])->name('booking.store');

// Payment Page (show payment form)
Route::get('/destinations/{id}/payment', [BookingController::class, 'showPayment'])->name('payment.show');

// Payment Process (submit payment)
Route::post('/destinations/{id}/payment', [PaymentController::class, 'process'])->name('payment.process');

// Payment Success
Route::get('/destinations/{id}/payment/success', [PaymentController::class, 'success'])->name('payment.success');

// Newsletter
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// ===========================
// PROTECTED PAGES (Requires Login)
// ===========================

Route::middleware(['auth'])->group(function () {
    // User Profile & Booking History
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::get('/bookings/{id}', [\App\Http\Controllers\ProfileController::class, 'showBooking'])->name('bookings.show');
    
    // Notifications
    Route::get('/notifications', [\App\Http\Controllers\ProfileController::class, 'notifications'])->name('notifications.index');
    Route::get('/notifications/{id}', [\App\Http\Controllers\ProfileController::class, 'showNotification'])->name('notifications.show');
    Route::post('/notifications/read-all', [\App\Http\Controllers\ProfileController::class, 'markAllNotificationsRead'])->name('notifications.markAllRead');
    Route::post('/notifications/{id}/read', [\App\Http\Controllers\ProfileController::class, 'markNotificationRead'])->name('notifications.read');
    Route::delete('/notifications/{id}', [\App\Http\Controllers\ProfileController::class, 'deleteNotification'])->name('notifications.delete');
    
    // Ticket Refund (Return)
    Route::post('/bookings/{id}/refund', [\App\Http\Controllers\BookingController::class, 'refund'])->name('bookings.refund');
});

// ===========================
// Admin Routes (Protected)
// ===========================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
    
    // Booking Management
    Route::get('/bookings', [\App\Http\Controllers\AdminController::class, 'bookings'])->name('bookings');
    Route::post('/bookings/{id}/status', [\App\Http\Controllers\AdminController::class, 'updateBookingStatus'])->name('bookings.update-status');
    
    // Destination Management
    Route::get('/destinations', [\App\Http\Controllers\AdminController::class, 'destinations'])->name('destinations');
    Route::get('/destinations/create', [\App\Http\Controllers\AdminController::class, 'createDestination'])->name('destinations.create');
    Route::post('/destinations', [\App\Http\Controllers\AdminController::class, 'storeDestination'])->name('destinations.store');
    Route::delete('/destinations/{id}', [\App\Http\Controllers\AdminController::class, 'deleteDestination'])->name('destinations.delete');
});

// ===========================
// API ROUTES (for AJAX)
// ===========================

Route::prefix('api')->group(function () {
    // GET /api/destinations - returns all destinations as JSON
    Route::get('/destinations', [DestinationController::class, 'apiIndex'])->name('api.destinations');
});
