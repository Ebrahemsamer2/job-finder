<?php


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\checkIfAjax;
use App\Http\Middleware\OnlyEmployee;
use App\Http\Middleware\OnlyEmployer;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobApplicationController;
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



Route::get('/', [HomeController::class, 'index'])->name('index');
Route::resource('jobs', JobController::class);
Route::get('load_jobs', [JobController::class, 'loadJobs'])->middleware(checkIfAjax::class);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('applications', JobApplicationController::class)->only(['index', 'store'])->middleware(OnlyEmployee::class);
    
    Route::get('employer-jobs/{job}/applications', [JobApplicationController::class, 'loadEmployerJobApplications'])->middleware(OnlyEmployer::class)->name('applications.jobapplications');
    Route::get('employer-jobs', [JobController::class, 'loadEmployerJobs'])->middleware(OnlyEmployer::class)->name('jobs.employerjobs');
});

require __DIR__.'/auth.php';
