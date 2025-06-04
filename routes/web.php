<?php

use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FooterPageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfessorAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\ThemeController;
use App\Models\Expertise;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {

//     return view('layouts.pages.home');
// })->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/global-search', [HomeController::class, 'globalSearch'])->name('global.live-search');


// Route::view('/create-student-account', 'layouts.pages.create-student-account')->name('student.register');

// Route::view('/create-professor-account', 'layouts.pages.create-professor-account')->name('professor.register');
// Route::get('/create-professor-account', function () {
//     $expertises = Expertise::all(); // Fetch all expertises
//     return view('layouts.pages.create-professor-account', compact('expertises'));
// })->name('professor.register');

Route::get('/project', [ProjectController::class, 'index'])->name('project.index');
Route::get('/project/{project}', [ProjectController::class, 'show'])->name('project.show');

Route::get('/theme', [ThemeController::class, 'index'])->name('theme.index');
Route::get('/theme/{theme}', [ThemeController::class, 'show'])->name('theme.show');

// Route::view('/course', 'layouts.pages.course')->name('course');
Route::get('/course', [CourseController::class, 'index'])->name('course.index');
Route::get('/course/{course}', [CourseController::class, 'show'])->name('course.show');


Route::get('/student', [ServiceController::class, 'student'])->name('services.student');
Route::get('/professor', [ServiceController::class, 'professor'])->name('services.professor');
Route::get('/university', [ServiceController::class, 'university'])->name('services.university');
Route::get('/company', [ServiceController::class, 'company'])->name('services.company');

Route::get('/contact', [ContactUsController::class, 'index'])->name('contact');
Route::post('/contact-submit', [ContactUsController::class, 'submit'])->name('contact.submit');

Route::get('/footer-pages/{slug}', [FooterPageController::class, 'show'])->name('footer.pages.show');

Route::middleware('guest:student')->group(function () {
    Route::get('/student/login', [StudentAuthController::class, 'showLoginForm'])->name('student.login');
    Route::post('/student/login', [StudentAuthController::class, 'login'])->name('student.login.post');
    Route::get('/student/register', [StudentAuthController::class, 'showRegisterForm'])->name('student.register');
    Route::post('/student/register', [StudentAuthController::class, 'register']);
});

Route::middleware('guest:professor')->group(function () {
    Route::get('/professor/login', [ProfessorAuthController::class, 'showLoginForm'])->name('professor.login');
    Route::post('/professor/login', [ProfessorAuthController::class, 'login'])->name('professor.login.post');
    Route::get('/professor/register', [ProfessorAuthController::class, 'showRegisterForm'])->name('professor.register');
    Route::post('/professor/register', [ProfessorAuthController::class, 'register'])->name('professor.register.post');
});

Route::middleware('auth:student')->group(function () {
    Route::get('/student/dashboard', function () {
        return view('student.dashboard');
    })->name('student.dashboard');
    Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll'])
        ->name('courses.enroll');

    Route::get('/student/profile', [StudentAuthController::class, 'profile'])->name('student.profile');
    Route::get('/student/profile/edit', [StudentAuthController::class, 'edit'])->name('student.profile.edit');
    Route::put('/student/profile/update', [StudentAuthController::class, 'update'])->name('student.profile.update');

    Route::post('/student/logout', [StudentAuthController::class, 'logout'])->name('student.logout');
});

Route::middleware('auth:professor')->group(function () {
    Route::get('/professor/dashboard', function () {
        return view('professor.dashboard');
    })->name('professor.dashboard');

    Route::get('/professor/profile', [ProfessorAuthController::class, 'profile'])->name('professor.profile');
    Route::get('/professor/profile/edit', [ProfessorAuthController::class, 'edit'])->name('professor.profile.edit');
    Route::put('/professor/profile/update', [ProfessorAuthController::class, 'update'])->name('professor.profile.update');

    Route::post('/professor/logout', [ProfessorAuthController::class, 'logout'])->name('professor.logout');
});

require __DIR__ . '/auth.php';
