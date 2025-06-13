<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\InvoiceController;
use App\Http\Controllers\User\RoomController as RoomController;
use App\Http\Controllers\User\UserController as UsersController;
use App\Http\Controllers\User\HomestayController as UserHomestayController;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\HomestayController;
use App\Http\Controllers\Owner\HomestayController as OwnerHomestayController;
use App\Http\Controllers\Owner\DashboardController as OwnerDashboardController;

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\GoogleController;


/*
|--------------------------------------------------------------------------
| Landing Page & Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [UsersController::class, 'landingPage'])->name('users.landingpage');
Route::view('/syarat-ketentuan', 'users.syaratketentuan')->name('users.syaratketentuan');

Route::get('/kataloghomestay', [UserHomestayController::class, 'index'])->name('users.kataloghomestay');
Route::get('/homestay/{id}', [UserHomestayController::class, 'show'])->name('homestays.show');
Route::get('/homestay/{homestay}/photos', [UserHomestayController::class, 'homestayPhotos'])->name('homestays.photos');
Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/auth', [AuthenticatedSessionController::class, 'create'])->name('auth');
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login'); // Fallback untuk Laravel default
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
    
    // Register routes
    Route::post('/register/guest', [RegisteredUserController::class, 'storeGuest'])->name('register.guest.store');
    Route::post('/register/owner', [RegisteredUserController::class, 'storeOwner'])->name('register.owner.store');
    
    // Google Auth
    Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
});

// Logout route
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:guest'])->group(function () {
    Route::get('/pemesanan', [CartController::class, 'index'])->name('users.cart');
    Route::delete('/pemesanan/{bookingDetail}', [UsersController::class, 'removeCartItem'])->name('cart.remove');
    Route::post('/cart/update/{bookingDetail}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/rooms/{room}/book', [RoomController::class, 'book'])->name('rooms.book');
    Route::get('/rooms/{room}/available', [RoomController::class, 'checkAvailability'])->name('rooms.checkAvailability');
    Route::post('/bookings/{booking}/pay', [BookingController::class, 'pay'])->name('bookings.pay');
    Route::post('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
    Route::post('/bookings/midtrans-callback', [BookingController::class, 'callback'])->name('bookings.midtrans-callback');
    Route::post('/bookings/{booking}/update-status', [BookingController::class, 'updateStatus'])->name('bookings.update-status');
    Route::get('/bookings/{booking}/invoice', [InvoiceController::class, 'generateInvoice'])->name('bookings.invoice');
    Route::get('/historycart', [UsersController::class, 'historycart'])->name('users.historycart');
    Route::get('/historycart/{booking}', [UsersController::class, 'historyDetail'])->name('users.detailbooking');
    Route::get('/profile', [UsersController::class, 'profile'])->name('users.profile');
    Route::post('/profile/update', [UsersController::class, 'updateProfile'])->name('users.profile.update');    
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function() { return view('admin.dashboard'); })->name('dashboard');
    
    // Homestay Management
    Route::get('/homestay', [HomestayController::class, 'index'])->name('homestays.index');
    Route::get('/homestay/create', [HomestayController::class, 'create'])->name('homestays.create');
    Route::post('/homestay', [HomestayController::class, 'store'])->name('homestays.store');
    Route::get('/homestay/{homestay}', [HomestayController::class, 'show'])->name('homestays.show');
    Route::get('/homestay/{homestay}/edit', [HomestayController::class, 'edit'])->name('homestays.edit');
    Route::put('/homestay/{homestay}', [HomestayController::class, 'update'])->name('homestays.update');
    Route::delete('/homestay/{homestay}', [HomestayController::class, 'destroy'])->name('homestays.destroy');

    // User Management
    Route::get('/user', [UserController::class, 'index'])->name('users.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/user', [UserController::class, 'store'])->name('users.store');
    Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/user/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

/*
|--------------------------------------------------------------------------
| Owner Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:owner'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/', [OwnerDashboardController::class, 'index'])->name('dashboard');
    
    // Homestay Management - Main routes
    Route::get('/homestay', [OwnerHomestayController::class, 'index'])->name('homestay');
    Route::get('/homestay/{homestay}', [OwnerHomestayController::class, 'show'])->name('homestay.show');
    Route::get('/homestay/{homestay}/edit', [OwnerHomestayController::class, 'edit'])->name('homestay.edit');
    Route::put('/homestay/{homestay}', [OwnerHomestayController::class, 'update'])->name('homestay.update');
    Route::delete('/homestay/{homestay}', [OwnerHomestayController::class, 'destroy'])->name('homestay.destroy');
    
    // Multi-step homestay creation routes
    Route::get('/homestay/create/step1', [OwnerHomestayController::class, 'createStep1'])->name('homestay.create.step1');
    Route::post('/homestay/create/step1', [OwnerHomestayController::class, 'storeStep1'])->name('homestay.store.step1');
    
    Route::get('/homestay/create/step2', [OwnerHomestayController::class, 'createStep2'])->name('homestay.create.step2');
    Route::post('/homestay/create/step2', [OwnerHomestayController::class, 'storeStep2'])->name('homestay.store.step2');
    
    Route::get('/homestay/create/step3', [OwnerHomestayController::class, 'createStep3'])->name('homestay.create.step3');
    Route::post('/homestay/create/step3', [OwnerHomestayController::class, 'storeStep3'])->name('homestay.store.step3');
    
    Route::get('/homestay/create/step4', [OwnerHomestayController::class, 'createStep4'])->name('homestay.create.step4');
    Route::post('/homestay/create/step4', [OwnerHomestayController::class, 'storeStep4'])->name('homestay.store.step4');

    // Room Management
    Route::get('/homestay/{homestay}/rooms/create', [OwnerHomestayController::class, 'createRoom'])->name('homestay.rooms.create');
    Route::post('/homestay/{homestay}/rooms', [OwnerHomestayController::class, 'storeRoom'])->name('homestay.rooms.store');
    Route::delete('/homestay/rooms/{room}', [OwnerHomestayController::class, 'destroyRoom'])->name('homestay.rooms.destroy');

    // Stats API
    Route::get('/homestay/stats', [OwnerHomestayController::class, 'getStats'])->name('homestay.stats');

    // Legacy routes (for backward compatibility)
    Route::get('/addhomestay', [OwnerHomestayController::class, 'addHomestay'])->name('addhomestay');
    Route::get('/addaddress', [OwnerHomestayController::class, 'addAddress'])->name('addaddress');
    Route::get('/addphoto', [OwnerHomestayController::class, 'addPhoto'])->name('addphoto');
    Route::get('/addavailability', [OwnerHomestayController::class, 'addAvailability'])->name('addavailability');
});

/*
|--------------------------------------------------------------------------
| Subadmin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:subadmin'])->prefix('subadmin')->name('subadmin.')->group(function () {
    Route::get('/', function() { return view('subadmin.dashboard'); })->name('dashboard');
});

