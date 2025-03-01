<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\site\CustomerDashboardController;
use App\Http\Controllers\site\SellerDashboardController;
use App\Http\Controllers\site\SiteHomeController;
use App\Http\Controllers\site\SiteJobsController;
use App\Http\Controllers\site\SiteSellersController;
use App\Http\Middleware\admin\AuthenticateAdmin;
use App\Http\Middleware\admin\RedirectIfAuthenticated;
use App\Http\Middleware\site\NormalizeRouteCase;
use Illuminate\Support\Facades\Route;

// Routes that should normalize case
Route::middleware([NormalizeRouteCase::class])->group(function () {
    // Redirect Home in case of entering non-existent route
    Route::fallback(function () {
        return redirect('/home');
    });

    // SITE ROUTES
    Route::get('/', [SiteHomeController::class,'index']);
    Route::get('/home', [SiteHomeController::class,'home']);
    Route::get('/sign-in', [SiteHomeController::class,'sign_in']);
    Route::get('/sign-up', [SiteHomeController::class,'sign_up']);
    Route::get('/contact', [SiteHomeController::class,'contact']);
    Route::get('/about-us', [SiteHomeController::class,'about_us']);
    Route::get('/faq', [SiteHomeController::class,'faq']);
    Route::get('/account-settings', [SiteHomeController::class,'account_settings']);
    Route::get('/change-password', [SiteHomeController::class,'change_password']);
    Route::get('/jobs/{id?}', [SiteJobsController::class,'index']);
    Route::get('/sellers/{id?}', [SiteSellersController::class,'index']);

    // SELLER DASHBOARD ROUTES
    Route::get('/seller-dashboard', [SellerDashboardController::class,'index']);
    Route::get('/seller-profile/{id?}', [SellerDashboardController::class,'seller_profile']);
    Route::get('/my-resume/{id?}', [SellerDashboardController::class,'my_resume']);
    Route::get('/seller/messages', [SellerDashboardController::class,'seller_messages']);
    Route::get('/job-alerts', [SellerDashboardController::class,'job_alerts']);
    Route::get('/saved-jobs', [SellerDashboardController::class,'saved_jobs']);

    // CUSTOMER DASHBOARD ROUTES
    Route::get('/dashboard', [CustomerDashboardController::class,'index']);
    Route::get('/customer-profile/{id?}', [CustomerDashboardController::class,'customer_profile']);
    Route::get('/my-jobs', [CustomerDashboardController::class,'my_jobs']);
    Route::get('/customer/messages', [CustomerDashboardController::class,'customer_messages']);
    Route::get('/post-job', [CustomerDashboardController::class,'post_job']);
    Route::get('/saved-sellers', [CustomerDashboardController::class,'saved_sellers']);
    Route::get('/memberships', [CustomerDashboardController::class,'memberships']);



    // ADMIN ROUTES
    Route::prefix('portal')->group(function () {
        // redirection to login when user not logged-in
        Route::middleware([RedirectIfAuthenticated::class])->group(function () {
            Route::get('/login', function () {
                return view('admin.login');
            })->name('login');
            Route::post('/login', [AuthController::class, 'login'])->name('login.post');
        });
        Route::middleware([AuthenticateAdmin::class])->group(function () {
            Route::get('/', [AdminDashboardController::class,'index']);
            Route::get('/logout', [AuthController::class, 'logout']);

        });
    });
    
    
});
