<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\site\CustomerDashboardController;
use App\Http\Controllers\site\JobPostController;
use App\Http\Controllers\site\SellerDashboardController;
use App\Http\Controllers\site\SiteHomeController;
use App\Http\Controllers\site\SiteJobsController;
use App\Http\Controllers\site\SiteSellersController;
use App\Http\Middleware\admin\AuthenticateAdmin;
use App\Http\Middleware\site\AuthenticateCustomer;
use App\Http\Middleware\site\AuthenticateSeller;
use App\Http\Middleware\admin\RedirectIfAuthenticated;
use App\Http\Middleware\site\NormalizeRouteCase;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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


    Route::middleware([RedirectIfAuthenticated::class])->group(function () {
        Route::get('/sign-in', [SiteHomeController::class, 'sign_in']);
        Route::post('/sign-in', [AuthController::class, 'login'])->name('user-login');

        Route::get('/sign-up', [SiteHomeController::class, 'sign_up']);
        Route::post('/sign-up', [AuthController::class, 'signup'])->name('customer-signup');

        Route::get('/register-seller', [SiteHomeController::class, 'seller_sign_up']);
        Route::post('/seller-sign-up', [AuthController::class, 'seller_signup'])->name('seller-signup');


        Route::post('/check-user', function (Request $request) {
            $column = $request->type === 'email' ? 'email' : 'username';
            $exists = DB::table(env('USERS'))->where($column, $request->value)->exists();
        
            return response()->json(['exists' => $exists]);
        });
    });

    // SELLER DASHBOARD ROUTES
    Route::middleware([AuthenticateSeller::class])->group(function () {
        Route::get('/seller-dashboard', [SellerDashboardController::class, 'index']);
        Route::get('/seller-profile/{id?}', [SellerDashboardController::class, 'seller_profile']);
        Route::get('/my-resume/{id?}', [SellerDashboardController::class, 'my_resume']);
        Route::get('/seller/messages', [SellerDashboardController::class, 'seller_messages']);
        Route::get('/job-alerts', [SellerDashboardController::class, 'job_alerts']);
        Route::get('/saved-jobs', [SellerDashboardController::class, 'saved_jobs']);

        Route::get('/log-out', [AuthController::class, 'logout']);

    });

    // CUSTOMER DASHBOARD ROUTES
    Route::middleware([AuthenticateCustomer::class])->group(function () {
        Route::get('/dashboard', [CustomerDashboardController::class, 'index']);
        Route::get('/customer-profile/{id?}', [CustomerDashboardController::class, 'customer_profile']);
        Route::get('/my-jobs', [CustomerDashboardController::class, 'my_jobs']);
        Route::get('/customer/messages', [CustomerDashboardController::class, 'customer_messages']);
        Route::get('/post-job', [JobPostController::class, 'index']);
        Route::post('/post-job', [JobPostController::class, 'postJob'])->name('job.submit');


        Route::get('/saved-sellers', [CustomerDashboardController::class, 'saved_sellers']);
        Route::get('/memberships', [CustomerDashboardController::class, 'memberships']);

        Route::get('/logout', [AuthController::class, 'logout']);

    });



    // ADMIN ROUTES
    Route::prefix('portal')->group(function () {
        // Prevent logged-in admins from accessing login
        Route::middleware([RedirectIfAuthenticated::class])->group(function () {
            Route::get('/login', function () {
                return view('admin.login');
            })->name('login');
            Route::post('/login', [AuthController::class, 'login'])->name('login.post');
        });

        // **Admin-Only Routes (Protected by AuthenticateAdmin)**
        Route::middleware([AuthenticateAdmin::class])->group(function () {
            Route::get('/', [AdminDashboardController::class, 'index']);
            // Job Categories
            Route::get('/categories/{action?}/{href?}', [AdminDashboardController::class, 'job_categories'])->name('admin.categories');
            Route::post('/categories/add', [AdminDashboardController::class, 'add_job_category'])->name('admin.categories.add');
            Route::post('/categories/edit', [AdminDashboardController::class, 'update_job_category'])->name('admin.categories.update');

            // Users
            Route::get('/users/{action?}/{href?}', [AdminDashboardController::class, 'users'])->name('admin.users');

            Route::post('/delete-record', [DatabaseController::class, 'deleteRecord'])->name('delete.record');
            Route::get('/logout', [AuthController::class, 'logout']);
        });
    });
    
    
});
