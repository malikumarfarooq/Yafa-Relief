<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;
use App\Http\Controllers\Admin\RolesController as AdminRolesController;
use App\Http\Controllers\Admin\SettingsController as AdminSettingsController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\DonationController as AdminDonationsController;
use App\Http\Controllers\Admin\ProgramCategoryController;
use App\Http\Controllers\Admin\ProgramAttributeController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;

use App\Http\Controllers\Website\PagesController as WebsitePagesController;

use App\Http\Controllers\StripeController;
use Symfony\Component\HttpFoundation\Request;




Route::get('/', [WebsitePagesController::class, 'home'])->name('website.home');
Route::get('/programs', [WebsitePagesController::class, 'programs'])->name('website.programs');
Route::get('/programs/{programPermalink}', [WebsitePagesController::class, 'programDetails'])->name('website.program-details');
Route::get('/about-us', [WebsitePagesController::class, 'about'])->name('website.about');
Route::get('/contact-us', [WebsitePagesController::class, 'contact'])->name('website.contact');
Route::get('/donate', [WebsitePagesController::class, 'donate'])->name('website.donate');
Route::get('/programs', [WebsitePagesController::class, 'programs'])->name('website.programs');
Route::get('/programs/{programPermalink}', [WebsitePagesController::class, 'programDetails'])->name('website.program-details');
Route::get('/get-involved', [WebsitePagesController::class, 'getInvolved'])->name('website.get-involved');
Route::get('/resources', [WebsitePagesController::class, 'resources'])->name('website.resources');
Route::get('/checkout', [WebsitePagesController::class, 'checkout'])->name('website.checkout');



Route::get('/thank-you', [WebsitePagesController::class, 'thankYou'])->name('website.thank-you');


Route::get('/stripe/success', [StripeController::class, 'successStripeCheckout'])->name('stripe.success');
Route::get('/stripe/cancel', [StripeController::class, 'stripeCheckoutCancel'])->name('stripe.cancel');



Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'login'])->name('login');
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    Route::get('/forgot-password', [AdminAuthController::class, 'forgotPassword'])->name('forgot-password');
    Route::get('/reset-password/{token}', [AdminAuthController::class, 'resetPassword'])->name('reset-password');
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::prefix('settings')->name('settings.')->group(function () {

            Route::get('/', AdminSettingsController::class)->name('index');

            Route::prefix('users')->name('users.')->group(function () {
                Route::get('/', [AdminUsersController::class, 'index'])->name('index');
                Route::get('/create', [AdminUsersController::class, 'create'])->name('create');
                Route::get('/{user}/edit', [AdminUsersController::class, 'edit'])->name('edit');
                Route::get('/{user}', [AdminUsersController::class, 'show'])->name('show');
                Route::delete('/{user}', [AdminUsersController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('roles')->name('roles.')->group(function () {
                Route::get('/', [AdminRolesController::class, 'index'])->name('index');
                Route::get('/create', [AdminRolesController::class, 'create'])->name('create');
                Route::get('/{role}/edit', [AdminRolesController::class, 'edit'])->name('edit');
            });
        });

        Route::prefix('programs')->name('programs.')->group(function () {
            Route::get('/', [ProgramController::class, 'index'])->name('index');
            Route::get('/create', [ProgramController::class, 'create'])->name('create');
            Route::get('/{program}/edit', [ProgramController::class, 'edit'])->name('edit');

            Route::prefix('categories')->name('program-categories.')->group(function () {
                Route::get('/', [ProgramCategoryController::class, 'index'])->name('index');
                Route::get('/create', [ProgramCategoryController::class, 'create'])->name('create');
                Route::get('/{category}/edit', [ProgramCategoryController::class, 'edit'])->name('edit');
            });

            Route::prefix('attributes')->name('program-attributes.')->group(function () {
                Route::get('/', [ProgramAttributeController::class, 'index'])->name('index');
                Route::get('/create', [ProgramAttributeController::class, 'create'])->name('create');
                Route::get('/{attribute}/edit', [ProgramAttributeController::class, 'edit'])->name('edit');
            });
        });

        Route::prefix('donations')->name('donations.')->group(function () {

            Route::get('/', [AdminDonationsController::class, 'index'])->name('index');
            Route::get('/{donation_number}', [AdminDonationsController::class, 'show'])->name('show');

            Route::get('/donors', [AdminDonationsController::class, 'donors'])->name('donors');
            Route::get('/donors/{donor}', [AdminDonationsController::class, 'donorDetails'])->name('donorDetails');

            Route::get('/subscriptions', [AdminDonationsController::class, 'subscriptions'])->name('subscriptions');
        });



        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/', [AdminProfileController::class, 'index'])->name('index');
            Route::get('/edit', [AdminProfileController::class, 'edit'])->name('edit');
            Route::get('/security', [AdminProfileController::class, 'security'])->name('security');
            Route::get('/password', [AdminProfileController::class, 'password'])->name('password');
        });

        // The Fallback: This catches anything inside /admin/ that isn't defined above
        Route::fallback(function () {
            return view('Admin.Exceptions.404');
            // This view should @extend your admin layout
        });
    });
