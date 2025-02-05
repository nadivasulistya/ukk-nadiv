<?php

use App\Http\Controllers\AlumniController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BidangKeahlianController;
use App\Http\Controllers\KonsentrasiKeahlianController;
use App\Http\Controllers\ProgramKeahlianController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\StatusAlumniController;
use App\Http\Controllers\TahunLulusController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\TracerKerjaController;
use App\Http\Controllers\TracerKuliahController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\UserProfileController;

// Landing page sebagai halaman default
Route::get('/', [LandingController::class, 'index'])->name('home');

/*------------------------------------------?
Normal Users Routes
--------------------------------------------*/
Route::middleware(['auth', 'user-access:user'])->group(function () {
    // Route untuk user biasa
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resource('tracer_kuliah', TracerKuliahController::class);

    Route::resource('tracer_kerja', TracerKerjaController::class);

    Route::resource('testimoni', TestimoniController::class);

    Route::get('/alumni/register', [AlumniController::class, 'showRegistrationForm'])
        ->name('alumni.register');
    Route::post('/alumni/register', [AlumniController::class, 'registerAlumni'])
        ->name('alumni.register.store');

    // User Profile Routes
    Route::prefix('profile')->group(function () {
        Route::get('/', [UserProfileController::class, 'edit'])->name('profileUser.edit');
        Route::patch('/', [UserProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [UserProfileController::class, 'destroy'])->name('profile.destroy');
        Route::post('/', [UserProfileController::class, 'store'])->name('user.profile.store');
    });
});

/*------------------------------------------
Admin Routes
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('dashboard');

    // Rute resource untuk Sekolah
    Route::resource('sekolah', SekolahController::class);

    // Atau jika ingin lebih spesifik
    Route::get('/sekolah', [SekolahController::class, 'index'])->name('sekolah.index');
    Route::get('/sekolah/create', [SekolahController::class, 'create'])->name('sekolah.create');
    Route::post('/sekolah', [SekolahController::class, 'store'])->name('sekolah.store');
    Route::get('/sekolah/{sekolah}', [SekolahController::class, 'show'])->name('sekolah.show');
    Route::get('/sekolah/{sekolah}/edit', [SekolahController::class, 'edit'])->name('sekolah.edit');
    Route::put('/sekolah/{sekolah}', [SekolahController::class, 'update'])->name('sekolah.update');
    Route::delete('/sekolah/{sekolah}', [SekolahController::class, 'destroy'])->name('sekolah.destroy');

    Route::resource('bidang_keahlian', BidangKeahlianController::class);

    // Atau jika ingin lebih spesifik dengan route individual
    Route::get('/bidang_keahlian', [BidangKeahlianController::class, 'index'])->name('bidang_keahlian.index');
    Route::get('/bidang_keahlian/create', [BidangKeahlianController::class, 'create'])->name('bidang_keahlian.create');
    Route::post('/bidang_keahlian', [BidangKeahlianController::class, 'store'])->name('bidang_keahlian.store');
    Route::get('/bidang_keahlian/{bidang_keahlian}', [BidangKeahlianController::class, 'show'])->name('bidang_keahlian.show');
    Route::get('/bidang_keahlian/{bidang_keahlian}/edit', [BidangKeahlianController::class, 'edit'])->name('bidang_keahlian.edit');
    Route::put('/bidang_keahlian/{bidang_keahlian}', [BidangKeahlianController::class, 'update'])->name('bidang_keahlian.update');
    Route::delete('/bidang_keahlian/{bidang_keahlian}', [BidangKeahlianController::class, 'destroy'])->name('bidang_keahlian.destroy');

    Route::resource('program_keahlian', ProgramKeahlianController::class);

    // Route spesifik dengan nama yang jelas
    Route::get('/program_keahlian', [ProgramKeahlianController::class, 'index'])->name('program_keahlian.index');
    Route::get('/program_keahlian/create', [ProgramKeahlianController::class, 'create'])->name('program_keahlian.create');
    Route::post('/program_keahlian', [ProgramKeahlianController::class, 'store'])->name('program_keahlian.store');
    Route::get('/program_keahlian/{program_keahlian}', [ProgramKeahlianController::class, 'show'])->name('program_keahlian.show');
    Route::get('/program_keahlian/{program_keahlian}/edit', [ProgramKeahlianController::class, 'edit'])->name('program_keahlian.edit');
    Route::put('/program_keahlian/{program_keahlian}', [ProgramKeahlianController::class, 'update'])->name('program_keahlian.update');
    Route::delete('/program_keahlian/{program_keahlian}', [ProgramKeahlianController::class, 'destroy'])->name('program_keahlian.destroy');

    Route::resource('konsentrasi_keahlian', KonsentrasiKeahlianController::class);

    Route::resource('tahun_lulus', TahunLulusController::class);

    Route::resource('status_alumni', StatusAlumniController::class);

    Route::resource('alumni', AlumniController::class);
    Route::get('/alumni/{id}/detail', [AlumniController::class, 'show'])->name('alumni.detail');
    Route::delete('/alumni/{id}', 'AlumniController@destroy')->name('alumni.destroy');
});

// Logout Route
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Authentication Routes
require __DIR__ . '/auth.php';
