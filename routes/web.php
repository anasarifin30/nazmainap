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
Route::get('/homestay/{homestay}/photos', [UserHomestayController::class, 'photos'])->name('homestays.photos');
Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// Hapus routes auth.php yang konflik dan gunakan custom routes
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

// Redirect route lama ke /auth
Route::get('/loginowner', fn() => redirect()->route('auth'));
Route::get('/loginguest', fn() => redirect()->route('auth'));
Route::get('/registerowner', fn() => redirect()->route('auth'));
Route::get('/registerguest', fn() => redirect()->route('auth'));

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
    Route::get('/', function() { return view('owner.dashboard'); })->name('dashboard');
    Route::view('/homestayowner', 'owner.homestayowner')->name('homestayowner');
    Route::view('/profilowner', 'owner.profilowner')->name('profilowner');
    Route::view('/1', 'owner.homestay.addhomestay')->name('addhomestay');
    Route::view('/addaddress', 'owner.homestay.addaddress')->name('addaddress');
    Route::view('/addphoto', 'owner.homestay.addphoto')->name('addphoto');
    Route::view('/addavailability', 'owner.homestay.addavailability')->name('addavailability');
    Route::view('/addroom', 'owner.rooms.addroom')->name('addroom');
    Route::get('/homestay', [OwnerHomestayController::class, 'index'])->name('homestays.index');
});

/*
|--------------------------------------------------------------------------
| Subadmin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:subadmin'])->prefix('subadmin')->name('subadmin.')->group(function () {
    Route::get('/', function() { return view('subadmin.dashboard'); })->name('dashboard');
});

// Hapus require auth.php untuk menghindari konflik
// require __DIR__.'/auth.php';

