<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ForumPostController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Http\Request;

// Public Routes
Route::get('/', [DashboardController::class, 'homepage']);
Route::get('/home', [DashboardController::class, 'index'])->name('home');
Route::get('/receiver-dashboard', [DashboardController::class, 'receiverDashboard'])->name('receiver.dashboard');

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    // Donor Dashboard
    Route::get('/donor-dashboard', [DonationController::class, 'index'])->name('donor.dashboard');
    
    // Donations Resource 
    Route::resource('donations', DonationController::class);
    Route::get('/available-donations', [DonationController::class, 'available'])->name('donations.available');
    Route::post('/donations/{donation}/claim', [DonationController::class, 'claim'])->name('donations.claim');
    Route::get('/my-claims', [DonationController::class, 'myClaims'])->name('donations.my_claims');
	
	Route::get('/donations/{donation}', [DonationController::class, 'show'])->name('donations.show');

    // Forum Post Routes
    Route::resource('forum-posts', ForumPostController::class);

});



Route::get('password/forgot', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('password/reset/{token}', function (Request $request, $token) {
    return view('auth.reset-password', [
        'token' => $token,
        'email' => $request->email,
    ]);
})->name('password.reset');

Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Email Testing
Route::get('/test-email', function () {
    Mail::raw('This is a test email via Gmail SMTP.', function ($message) {
        $message->to('osaimiosman@gmail.com')
                ->subject('Test Gmail SMTP');
    });

    return 'Email sent!';
});