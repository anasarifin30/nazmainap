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
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

use App\Http\Controllers\Owner\HomestayController as OwnerHomestayController;
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

Route::get('/homestay/{homestay}/photos', [UserHomestayController::class, 'photos'])->name('homestays.photos');
Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
// // Login Routes
// Route::get('/login/admin', [AuthenticatedSessionController::class, 'showAdminLogin'])->name('login.admin');
// Route::get('/login/subadmin', [AuthenticatedSessionController::class, 'showSubadminLogin'])->name('login.subadmin');
// Route::get('/login/owner', [AuthenticatedSessionController::class, 'showOwnerLogin'])->name('login.owner');
// Route::get('/login/guest', [AuthenticatedSessionController::class, 'showGuestLogin'])->name('login.guest');

// // Register Routes
// Route::view('/admin/register', 'auth.registeradmin')->name('register.admin');
// Route::view('/subadmin/register', 'auth.registersubadmin')->name('register.subadmin');
// Route::view('/owner/register', 'auth.registerowner')->name('register.owner');
// Route::get('/register/guest', [RegisteredUserController::class, 'showGuestRegister'])->name('register.guest');
// Route::post('/register/guest', [RegisteredUserController::class, 'storeGuest'])->name('register.guest.store');

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
    Route::get('/api/rooms/{room}/available', [RoomController::class, 'checkAvailability'])->name('rooms.checkAvailability');
    Route::post('/bookings/{booking}/pay', [BookingController::class, 'pay'])->name('bookings.pay');
    Route::post('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel')->middleware('web');
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
    // Dashboard
    Route::view('/', 'admin.dashboard')->name('dashboard');

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
    Route::view('/', 'owner.dashboard')->name('dashboard');
    Route::view('/homestayowner', 'owner.homestayowner')->name('homestayowner');
    Route::view('/profilowner', 'owner.profilowner')->name('profilowner');
    Route::view('/1', 'owner.homestay.addhomestay')->name('addhomestay');
    Route::get('/homestay', [OwnerHomestayController::class, 'index'])->name('homestays.index');
});
Route::get('/profilowner', function() {
        return view('owner.profilowner');
});


/*
|--------------------------------------------------------------------------
| Subadmin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:subadmin'])->prefix('subadmin')->group(function () {
    Route::view('/', 'subadmin.dashboard')->name('subadmin.dashboard');
});

require __DIR__.'/auth.php';

Route::get('/auth', [AuthenticatedSessionController::class, 'create'])->name('auth');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Redirect route lama ke /auth (opsional)
Route::get('/loginowner', fn() => redirect()->route('auth'));
Route::get('/loginguest', fn() => redirect()->route('auth'));
Route::get('/registerowner', fn() => redirect()->route('auth'));
Route::get('/registerguest', fn() => redirect()->route('auth'));

Route::post('/register/guest', [RegisteredUserController::class, 'storeGuest'])->name('register.guest.store');
Route::post('/register/owner', [RegisteredUserController::class, 'storeOwner'])->name('register.owner.store');

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

