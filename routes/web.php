<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\BorrowReqController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DshbrdBooksController;
use App\Http\Controllers\DshbrdStdntsController;
use App\Http\Controllers\EmailVerificaitonController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GuestBorrowController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\SubmittionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', fn()=>
    redirect()->route('booksIndex')
);
Route::get('/home', fn()=>
    redirect()->route('booksIndex')
);

Route::get('/books', [BookController::class, 'index'])
        ->name('booksIndex');
Route::get('/books/create', [BookController::class, 'create'])
        ->name('booksCreate')
        ->middleware(['auth','manager']);
Route::post('/books', [BookController::class, 'store'])
        ->name('booksStore')
        ->middleware(['auth','manager']);
Route::get('/books/{book:ISBN}', [BookController::class, 'show'])
        ->name('booksShow');
Route::get('/books/{book:ISBN}/edit', [BookController::class, 'edit'])
        ->name('booksEdit')
        ->middleware(['auth','manager']);
Route::patch('/books/{book}', [BookController::class, 'update'])
        ->name('booksUpdate')
        ->middleware(['auth','manager']);
Route::delete('/books/{book}', [BookController::class, 'destroy'])
        ->name('booksDestroy')
        ->middleware(['auth','manager']);

Route::get('authors', [AuthorController::class, 'index'])
        ->name('authorsIndex');
Route::get('/authors/create', [AuthorController::class, 'create'])
        ->name('authorsCreate')
        ->middleware(['auth','manager']);
Route::get('authors/{author}', [AuthorController::class, 'show'])
        ->name('authorsShow');
Route::post('authors', [AuthorController::class, 'store'])
        ->name('authorsStore')
        ->middleware(['auth','manager']);
Route::get('authors/{author}/edit', [AuthorController::class, 'edit'])
        ->name('authorsEdit')
        ->middleware(['auth','manager']);
Route::patch('authors/{author}', [AuthorController::class, 'update'])
        ->name('authorsUpdate')
        ->middleware(['auth','manager']);
Route::post('authors/{author}', [AuthorController::class, 'destroy'])
        ->name('authorsDestroy')
        ->middleware('manger');

Route::get('management', [ManagementController::class, 'index'])
        ->name('management')
        ->middleware(['auth','manager']);
Route::get('employees/{user:card_id}', [EmployeeController::class, 'show'])
        ->name('employeeShow')
        ->middleware(['auth','manager']);
Route::patch('employees/{user}/update', [EmployeeController::class, 'update'])
        ->name('employeeRoleUpdate')
        ->middleware(['auth','manager']);

Route::get('categories/create', [CategoryController::class, 'create'])
        ->name('categoriesCreate')
        ->middleware(['auth','manager']);
Route::post('categories', [CategoryController::class, 'store'])
        ->name('categoriesStore')
        ->middleware(['auth','manager']);
Route::get('categories/{category:slug}/edit', [CategoryController::class, 'edit'])
        ->name('categoriesEdit')
        ->middleware(['auth','manager']);
Route::patch('categories/{category:slug}', [CategoryController::class, 'update'])
        ->name('categoriesUpdate')
        ->middleware(['auth','manager']);

Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard')
        ->middleware(['auth','worker']);

Route::patch('/users/submittion/{user}', [SubmittionController::class, 'update'])
        ->middleware(['auth','worker']);
Route::delete('/users/submittion/{user}', [SubmittionController::class, 'destroy'])
        ->middleware(['auth','worker']);

Route::get('/dashboard/students', [DshbrdStdntsController::class, 'index'])
        ->middleware(['auth','worker']);
Route::get('/dashboard/submittion', [DshbrdStdntsController::class, 'enrollRequest'])
        ->middleware(['auth','worker']);
Route::get('/dashboard/students/{user}', [DshbrdStdntsController::class, 'show'])
        ->middleware(['auth','worker']);

Route::get('/dashboard/borrow', [BorrowReqController::class, 'index'])
        ->middleware(['auth','worker']);

Route::get('/dashboard/borrow/create', [BorrowController::class, 'create'])
        ->middleware(['auth','worker']);
Route::post('/dashboard/borrow', [BorrowController::class, 'store'])
        ->middleware(['auth','worker']);
Route::patch('/dashboard/borrow/{borrow}', [BorrowController::class, 'update'])
        ->middleware(['auth','worker']);
Route::delete('/dashboard/borrow/{borrow}', [BorrowController::class, 'destroy'])
        ->middleware(['auth','worker']);

Route::post('/requests/borrow', [BorrowController::class, 'store'])
        ->middleware(['auth', 'verified', 'enrolled']);

Route::get('/dashboard/return/create', [ReturnController::class, 'create'])
        ->middleware(['auth','worker']);
Route::post('/dashboard/return', [ReturnController::class, 'store'])
        ->middleware(['auth','worker']);

Route::get('/dashboard/books', [DshbrdBooksController::class, 'index'])
        ->middleware(['auth','worker']);
Route::get('/dashboard/books/{book:ISBN}', [DshbrdBooksController::class, 'show'])
        ->middleware(['auth','worker']);

Route::get('/dashboard/guests', [GuestBorrowController::class, 'index'])
        ->middleware(['auth','worker']);

Route::get('/profile', [ProfileController::class, 'index'])->name('profile')
        ->middleware('auth');
Route::get('/profile/{user:username}/edit', [ProfileController::class, 'edit'])
        ->name('profileEdit')
        ->middleware('auth');
Route::patch('/profile/{user}', [ProfileController::class, 'update'])
        ->name('profileUpdate')
        ->middleware('auth');

Route::get('/login', [SessionController::class, 'create'])
        ->name('login')
        ->middleware('guest');
Route::post('/login', [SessionController::class, 'logIn'])
        ->middleware('guest');
Route::post('/logout', [SessionController::class, 'destroy'])
        ->middleware('auth');

Route::get('/register', [RegisterController::class, 'create'])
        ->name('register')
        ->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])
        ->middleware('guest');

Route::get('/email/verify', [EmailVerificaitonController::class, 'create'])
        ->name('verification.notice')
        ->middleware('auth');

Route::get('/email/verify/{id}/{hash}', function(EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/');
    })
        ->name('verification.verify')
        ->middleware(['auth', 'signed']);

Route::post('/email/verification-notification', function(Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return view('profiles.verify-email');
    })
        ->name('verification.send')
        ->middleware(['auth', 'throttle:6,1']);
