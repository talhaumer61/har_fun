<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SellerJobController;
use App\Http\Controllers\site\ConversationController;
use App\Http\Controllers\site\CustomerDashboardController;
use App\Http\Controllers\site\CustomerMyJobsController;
use App\Http\Controllers\site\JobPostController;
use App\Http\Controllers\site\ProposalController;
use App\Http\Controllers\site\ReviewController;
use App\Http\Controllers\site\SellerDashboardController;
use App\Http\Controllers\site\SiteHomeController;
use App\Http\Controllers\site\SiteJobsController;
use App\Http\Controllers\site\SiteSellersController;
use App\Http\Controllers\site\WorkerProfileController;
use App\Http\Controllers\WorkerPortfolioController;
use App\Http\Controllers\WorkerStripeController;
use App\Http\Middleware\admin\AuthenticateAdmin;
use App\Http\Middleware\site\AuthenticateCustomer;
use App\Http\Middleware\site\AuthenticateSeller;
use App\Http\Middleware\admin\RedirectIfAuthenticated;
use App\Http\Middleware\SetLocale;
use App\Http\Middleware\site\AuthenticateUser;
use App\Http\Middleware\site\NormalizeRouteCase;
use App\Models\Message;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

Route::middleware([SetLocale::class])->group(function () {
    Route::get('lang/{locale}', function ($locale) {
        if (in_array($locale, ['en', 'ur'])) {
            session(['locale' => $locale]);
        }
        return redirect()->back();
    })->name('lang.switch');

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
        Route::get('/jobs/{category?}', [SiteJobsController::class,'index']);
        // Job detail
        Route::get('/job/{href}', [SiteJobsController::class, 'show']);

        Route::get('/sellers', [SiteSellersController::class,'index']);
        Route::get('/sellers/{slug}', [SiteSellersController::class, 'show']);


        // ROUTES FOR NON_LOGGED USERS
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

        Route::middleware([AuthenticateUser::class])->group(function () {
            Route::get('/messages', [MessageController::class, 'index'])->name('chat.index');
            Route::post('/messages/send', [MessageController::class, 'send'])->name('chat.send');
            Route::get('/messages/fetch-new', [MessageController::class, 'fetchNewMessages']);

        });
        // SELLER DASHBOARD ROUTES
        Route::middleware([AuthenticateSeller::class])->group(function () {
            Route::get('/seller-dashboard', [SellerDashboardController::class, 'index']);
            // Route::get('/seller-profile/{id?}', [SellerDashboardController::class, 'seller_profile']);
            Route::get('/seller-profile', [WorkerProfileController::class, 'edit'])->name('worker.profile.edit');
            Route::post('/profile', [WorkerProfileController::class, 'update'])->name('worker.profile.update');

            Route::get('/my-resume/{id?}', [SellerDashboardController::class, 'my_resume']);
            Route::get('/job-alerts', [SellerDashboardController::class, 'job_alerts']);
            Route::get('/ongoing-jobs', [SellerDashboardController::class, 'ongoing_jobs'])->name('worker.ongoing.jobs');
            Route::post('/worker/job/{jobId}/complete', [SellerJobController::class, 'markCompleted'])->name('worker.job.complete');


            // Show "My Portfolio" page
            Route::get('/my-portfolio', [WorkerPortfolioController::class, 'index'])->name('portfolio.index');

            // Create new portfolio (submitted via modal form)
            Route::post('/portfolio/store', [WorkerPortfolioController::class, 'store'])->name('portfolio.store');

            // Get single portfolio for editing (used in AJAX to prefill modal)
            Route::get('/portfolio/{id}/edit', [WorkerPortfolioController::class, 'edit'])->name('portfolio.edit');

            // Update portfolio (submitted via modal form)
            Route::put('/portfolio/{id}', [WorkerPortfolioController::class, 'update'])->name('portfolio.update');


            // Delete portfolio
            Route::delete('/portfolio/{id}', [WorkerPortfolioController::class, 'destroy'])->name('portfolio.destroy');

            
            Route::post('/submit-proposal', [ProposalController::class, 'store'])->name('submit.proposal');

            Route::get('/worker/connect/start', [WorkerStripeController::class, 'startOnboarding'])->name('worker.connect.start');
            Route::get('/worker/connect/refresh', [WorkerStripeController::class, 'refreshOnboarding'])->name('worker.connect.refresh');
            Route::get('/worker/connect/return', [WorkerStripeController::class, 'returnOnboarding'])->name('worker.connect.return');


            Route::get('/log-out', [AuthController::class, 'logout']);

        });

        // CUSTOMER DASHBOARD ROUTES
        Route::middleware([AuthenticateCustomer::class])->group(function () {
            
            Route::get('/dashboard', [CustomerDashboardController::class, 'index']);
            Route::get('/customer-profile/{id?}', [CustomerDashboardController::class, 'customer_profile']);

            Route::get('/my-jobs/{action?}/{href?}', [CustomerMyJobsController::class, 'index']);
            Route::post('/proposals/accept', [CustomerMyJobsController::class, 'accept'])->name('proposals.accept');

            Route::post('/customer/job/{jobId}/complete', [CustomerMyJobsController::class, 'markCompletedByCustomer'])->name('customer.job.complete');

            // ✅ Store review
            Route::post('/my-jobs/{job}/review', [ReviewController::class, 'store'])->name('customer.review.store');
            
            Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
            Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');

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

            // Admin-Only Routes (Protected by AuthenticateAdmin)**
            Route::middleware([AuthenticateAdmin::class])->group(function () {
                Route::get('/', [AdminDashboardController::class, 'index']);
                // Job Categories
                Route::get('/categories/{action?}/{href?}', [AdminDashboardController::class, 'job_categories'])->name('admin.categories');
                Route::post('/categories/add', [AdminDashboardController::class, 'add_job_category'])->name('admin.categories.add');
                Route::post('/categories/edit', [AdminDashboardController::class, 'update_job_category'])->name('admin.categories.update');

                // Users
                Route::get('/users/{action?}/{href?}', [AdminDashboardController::class, 'users'])->name('admin.users');

                Route::get('/jobs-posted', [AdminDashboardController::class, 'jobs_posted'])->name('admin.jobs_posted');

                Route::post('/delete-record', [DatabaseController::class, 'deleteRecord'])->name('delete.record');
                Route::get('/logout', [AuthController::class, 'logout']);
            });
        });
        
        
    });
});
