<?php

use App\Http\Controllers\admin\AdminAuthController;
use App\Http\Controllers\admin\AdminDashboardController;

use App\Http\Controllers\site\SiteDashboardController;
use App\Http\Controllers\site\SiteHomeController;
use App\Http\Controllers\site\SiteJobsController;
use App\Http\Controllers\site\SiteSellersController;
use App\Http\Middleware\admin\Authenticate;
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
    Route::get('/home', [SiteHomeController::class,'home']);
    Route::get('/jobs/{id?}', [SiteJobsController::class,'index']);
    Route::get('/sellers/{id?}', [SiteSellersController::class,'index']);

    // SITE DASHBOARD ROUTES
    Route::get('/dashboard/{type?}', [SiteDashboardController::class,'index']);
    Route::get('/seller-profile/{id?}', [SiteDashboardController::class,'seller_profile']);
    Route::get('/my-resume/{id?}', [SiteDashboardController::class,'my_resume']);
    Route::get('/seller/messages', [SiteDashboardController::class,'seller_messages']);
    Route::get('/job-alerts', [SiteDashboardController::class,'job_alerts']);
    Route::get('/saved-jobs', [SiteDashboardController::class,'saved_jobs']);

    Route::get('/customer-profile/{id?}', [SiteDashboardController::class,'customer_profile']);
    Route::get('/my-jobs', [SiteDashboardController::class,'my_jobs']);
    Route::get('/customer/messages', [SiteDashboardController::class,'customer_messages']);
    Route::get('/post-job', [SiteDashboardController::class,'post_job']);
    Route::get('/saved-sellers', [SiteDashboardController::class,'saved_sellers']);
    Route::get('/memberships', [SiteDashboardController::class,'memberships']);



    // ADMIN ROUTES
    Route::prefix('portal')->group(function () {
        // redirection to login when user not logged-in
        Route::middleware([RedirectIfAuthenticated::class])->group(function () {
            Route::get('/login', function () {
                return view('admin.login');
            })->name('login');
            Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
        });
        Route::middleware([Authenticate::class])->group(function () {
            Route::get('/', [AdminDashboardController::class,'index']);
            Route::get('/logout', [AdminAuthController::class, 'logout']);

        });
    });
    
    
});
