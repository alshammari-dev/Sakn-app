<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DepositController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyDocumentController;
use App\Http\Controllers\PropertyImageController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaleApprovalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitController;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
|
| These routes are accessible by guests and unauthenticated visitors.
|
*/
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/explore', [PublicController::class, 'explore'])->name('explore');
Route::get('/agents', [PublicController::class, 'agents'])->name('agents');
Route::get('/faqs', [PublicController::class, 'faqs'])->name('faqs');
Route::get('/about', [PublicController::class, 'about'])->name('about');

/*
|--------------------------------------------------------------------------
| Authenticated User Profile Routes
|--------------------------------------------------------------------------
|
| Common routes accessible by any authenticated user to manage their account.
|
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Internal Portals & Management Console (RBAC Shielded)
|--------------------------------------------------------------------------
|
| Routes mapped exclusively to Sakn internal professional roles:
| - Admin (Full Domain Master)
| - Content Manager (Properties Listing Architect)
| - Sales Agent (Client Relations & Visits Host)
|
*/
Route::middleware(['auth', 'role:admin|content manager|sale-agent'])->group(function () {
    
    /**
     * Dashboard Portal
     */
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /**
     * Domain 1: Full System Administration (Admin Only)
     */
    Route::middleware(['role:admin'])->group(function () {
        // User & Role Management
        Route::post('users/import', [UserController::class, 'import'])->name('users.import');
        Route::get('users/export', [UserController::class, 'export'])->name('users.export');
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        // Deposits & Transaction Management
        Route::get('deposits/export', [DepositController::class, 'export'])->name('deposits.export');
        Route::resource('deposits', DepositController::class);
        Route::patch('deposits/{deposit}/approve', [DepositController::class, 'approve'])->name('deposits.approve');
        Route::patch('deposits/{deposit}/reject', [DepositController::class, 'reject'])->name('deposits.reject');
        
        // Closing & Deals Board
        Route::resource('sale-approvals', SaleApprovalController::class);
    });

    /**
     * Domain 2: Content Management (Admin | Content Manager)
     */
    Route::middleware(['role:admin|content manager'])->group(function () {
        // Listings & Portals Asset Controls
        Route::post('properties/import', [PropertyController::class, 'import'])->name('properties.import');
        Route::get('properties/export', [PropertyController::class, 'export'])->name('properties.export');
        Route::resource('properties', PropertyController::class);
        Route::resource('property-images', PropertyImageController::class);
        Route::resource('property-documents', PropertyDocumentController::class);
    });

    /**
     * Domain 3: Sales Domain Operations (Admin | Sale Agent)
     */
    Route::middleware(['role:admin|sale-agent'])->group(function () {
        // Property Tours & Visits Routing
        Route::get('visits/export', [VisitController::class, 'export'])->name('visits.export');
        Route::resource('visits', VisitController::class);
        Route::put('visits/{visit}/quick-update', [VisitController::class, 'quickUpdate'])->name('visits.quickUpdate');       
        
        // Negotiating Purchase Offers Routing
        Route::get('offers/export', [OfferController::class, 'export'])->name('offers.export');
        Route::resource('offers', OfferController::class);
        Route::put('offers/{offer}/quick-update', [OfferController::class, 'quickUpdate'])->name('offers.quickUpdate');
    });
});

/*
|--------------------------------------------------------------------------
| System Framework Integration
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Debugging / Maintenance Route Enclave
|--------------------------------------------------------------------------
*/
Route::prefix('errors-preview')->group(function () {
    Route::get('/404', function () { abort(404); });
    Route::get('/403', function () { abort(403); });
    Route::get('/500', function () { abort(500); });
    Route::get('/503', function () { abort(503); });
    Route::get('/419', function () { abort(419); });
    Route::get('/429', function () { abort(429); });
});
