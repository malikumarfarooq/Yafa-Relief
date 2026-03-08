<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DonationController as AdminDonationsController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\ProgramAttributeController;
use App\Http\Controllers\Admin\ProgramCategoryController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\RolesController as AdminRolesController;
use App\Http\Controllers\Admin\SettingsController as AdminSettingsController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\Website\PagesController as WebsitePagesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HeroSliderController;

Route::get('/', [WebsitePagesController::class, 'home'])->name('website.home');
Route::get('/programs', [WebsitePagesController::class, 'programs'])->name('website.programs');
Route::get('/programs/{programPermalink}', [WebsitePagesController::class, 'programDetails'])->name('website.program-details');
Route::get('/about-us', [WebsitePagesController::class, 'about'])->name('website.about');
Route::get('/contact-us', [WebsitePagesController::class, 'contact'])->name('website.contact');

Route::get('/our-policies', [WebsitePagesController::class, 'ourpolicies'])->name('website.ourpolicies');
Route::get('/donate', [WebsitePagesController::class, 'donate'])->name('website.donate');
Route::get('/programs', [WebsitePagesController::class, 'programs'])->name('website.programs');
Route::get('/programs/{programPermalink}', [WebsitePagesController::class, 'programDetails'])->name('website.program-details');
Route::get('/get-involved', [WebsitePagesController::class, 'getInvolved'])->name('website.get-involved');
Route::get('/resources', [WebsitePagesController::class, 'resources'])->name('website.resources');
Route::get('/checkout', [WebsitePagesController::class, 'checkout'])->name('website.checkout');
Route::get('/our-news', [WebsitePagesController::class, 'ourNews'])->name('website.our-news');
Route::get('/our-news/{slug}', [WebsitePagesController::class, 'newsDetail'])->name('website.news-detail');

// Stories
Route::get('/our-stories', [WebsitePagesController::class, 'ourStories'])->name('website.our-stories');
Route::get('/our-stories/{slug}', [WebsitePagesController::class, 'storiesDetail'])->name('website.stories-detail');

// Blogs
Route::get('/our-blogs', [WebsitePagesController::class, 'ourBlogs'])->name('website.our-blogs');
Route::get('/our-blogs/{slug}', [WebsitePagesController::class, 'blogsDetail'])->name('website.blogs-detail');

// Pages -detail only no index/listing
Route::get('/pages/{slug}', [WebsitePagesController::class, 'pageDetail'])->name('website.page-detail');

Route::get('/thank-you', [WebsitePagesController::class, 'thankYou'])->name('website.thank-you');

// Unsubscribe (signed route from email)
Route::get('/newsletter/unsubscribe/{email}', [App\Http\Controllers\Website\NewsletterController::class, 'unsubscribe'])
    ->name('newsletter.unsubscribe');

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
            Route::get('/integrations', [AdminSettingsController::class, 'integration'])->name('integration');

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


        Route::prefix('popups')->name('popups.')->group(function () {
            Route::get('/', function () {
                return view('Admin.Popups.index');
            })->name('index');

            Route::get('/create', function () {
                return view('Admin.Popups.create');
            })->name('create');

            Route::get('/{id}/edit', function ($id) {
                $popup = \App\Models\Popup::findOrFail($id);
                return view('Admin.Popups.edit', compact('popup'));
            })->name('edit');
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

            Route::get('/donors/all', [AdminDonationsController::class, 'donors'])->name('donors');
            Route::get('/donors/show/{donorEmail}', [AdminDonationsController::class, 'donorDetails'])->name('donorDetails');

            Route::get('/subscriptions', [AdminDonationsController::class, 'subscriptions'])->name('subscriptions');
        });

        Route::prefix('content')->name('content.')->group(function () {

            Route::prefix('posts')->name('posts.')->group(function () {
                Route::get('/', [ContentController::class, 'postIndex'])->name('index');
                Route::get('/create', [ContentController::class, 'postcCreate'])->name('create');
                Route::get('/{post}/edit', [ContentController::class, 'postEdit'])->name('edit');
            });

            Route::prefix('pages')->name('pages.')->group(function () {
                Route::get('/', [ContentController::class, 'pagesIndex'])->name('index');
                Route::get('/create', [ContentController::class, 'pagesCreate'])->name('create');
                Route::get('/{page}/edit', [ContentController::class, 'pagesEdit'])->name('edit');
            });

            Route::prefix('stories')->name('pages.')->group(function () {
                Route::get('/', [ContentController::class, 'storiesIndex'])->name('index');
                Route::get('/create', [ContentController::class, 'storiesCreate'])->name('create');
                Route::get('/{story}/edit', [ContentController::class, 'storiesEdit'])->name('edit');
            });

            Route::prefix('news')->name('pages.')->group(function () {
                Route::get('/', [ContentController::class, 'newsIndex'])->name('index');
                Route::get('/create', [ContentController::class, 'newsCreate'])->name('create');
                Route::get('/{news}/edit', [ContentController::class, 'newsEdit'])->name('edit');
            });
        });

        // admin hero slider

        Route::prefix('hero-sliders')->name('hero-sliders.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\HeroSliderController::class, 'index'])->name('index');
            Route::get('/create', [App\Http\Controllers\Admin\HeroSliderController::class, 'create'])->name('create');
            Route::get('/{heroSlider}/edit', [App\Http\Controllers\Admin\HeroSliderController::class, 'edit'])->name('edit');
        });

        //  Contact us Admin routes.
        Route::prefix('contact-messages')->name('contact-messages.')->group(function () {
            Route::get('/', [ContactMessageController::class, 'index'])->name('index');
            Route::get('/{contactMessage}', [ContactMessageController::class, 'show'])->name('show');
            Route::post('/{contactMessage}/status', [ContactMessageController::class, 'updateStatus'])->name('update-status');
            Route::delete('/{contactMessage}', [ContactMessageController::class, 'destroy'])->name('destroy');
            Route::get('/export/csv', [ContactMessageController::class, 'export'])->name('export');
        });
        // here is the code of newsletter subscripiton.
        Route::prefix('settings')->name('settings.')->group(function () {

            // ... your existing settings routes

            Route::prefix('newsletters')->name('newsletters.')->group(function () {
                Route::get('/', [App\Http\Controllers\Admin\NewsletterController::class, 'index'])
                    ->name('index');

                Route::post('/{newsletter}/toggle', [App\Http\Controllers\Admin\NewsletterController::class, 'toggleStatus'])
                    ->name('toggle');

                Route::get('/export', [App\Http\Controllers\Admin\NewsletterController::class, 'export'])
                    ->name('export');
            });
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
