<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontJobController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyJobController;
use App\Http\Controllers\JobCandidateController;

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/jobs', [FrontController::class, 'jobs'])->name('front.jobs');
Route::get('/companies', [FrontController::class, 'companies'])->name('front.companies');
Route::get('company_jobs/{company:slug}', [FrontController::class, 'company_jobs'])->name('front.company_jobs');
Route::get('/about', [FrontController::class, 'about'])->name('front.about');
Route::get('/contact', [FrontController::class, 'contact'])->name('front.contact');
Route::get('/detail/{company_job:slug}', [FrontController::class, 'detail'])->name('front.detail');
Route::get('category/{category:slug}', [FrontController::class, 'category'])->name('front.category');
Route::get('/search/jobs/', [FrontController::class, 'search'])->name('front.search');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('can:apply job')->group(function () {
        Route::get('apply/success', [FrontController::class, 'success_apply'])->name('front.apply.success');
        Route::get('apply/{company_job:slug}', [FrontController::class, 'apply'])->name('front.apply');
        Route::post('apply/{company_job:slug}', [FrontController::class, 'apply_store'])->name('front.apply.store');
    });
    
    Route::prefix('dashboard')->name('dashboard.')->group(function() {
        Route::middleware('can:apply job')->group(function() {
            Route::get('my-applications', [DashboardController::class, 'my_applications'])->name('my.applications');
            Route::get('my-applications/{job_candidate}', [DashboardController::class, 'my_application_details'])->name('my.applications.details');
        });
    });

    Route::prefix('admin')->name('admin.')->group(function() {

        Route::middleware('can:manage categories')->group(function() {
            Route::resource('categories', CategoryController::class);
        });

        Route::middleware('can:manage company')->group(function() {
            Route::resource('company', CompanyController::class);
        });

        Route::middleware('can:manage jobs')->group(function() {
            Route::resource('company_jobs', CompanyJobController::class);
            Route::put('company_jobs/{company_job}/close', [CompanyJobController::class, 'close'])->name('company_jobs.close');
        });

        Route::middleware('can:manage candidates')->group(function() {
            Route::resource('job_candidates', JobCandidateController::class);
            Route::get('candidate/{job_candidate}/resume/download', [JobCandidateController::class,'download_file'])->name('download_resume');
        });

    });
});

require __DIR__.'/auth.php';
