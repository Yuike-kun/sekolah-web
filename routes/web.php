<?php

use App\Http\Controllers\Auth\LogoutController;
use App\Livewire\Auth\Login;
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

// LANDING PAGE
Route::namespace('App\Livewire\LandingPage')->group(function () {
    Route::get('/', Index::class)->name('beranda');

    // PROFIL
    Route::prefix('profil')->name('profil.')->group(function () {
        Route::get('/sejarah', History::class)->name('sejarah');
        Route::get('/visi-misi', VisionMission::class)->name('visi-misi');
        Route::get('/struktur-organisasi', OrganizationalStructure::class)->name('struktur-organisasi');
        Route::get('/tujuan', Objective::class)->name('tujuan');
        Route::get('/logo-meaning', LogoMeaning::class)->name('logo-meaning');
    });
    Route::get('berita', News::class)->name('berita');
    Route::get('program', Program::class)->name('program');
    Route::get('pendaftaran-siswa', StudentRegistration::class)->name('pendaftaran-siswa');
});

// REGISTRATION PPDB
Route::prefix('ppdb')->namespace('App\Livewire\RegistrationPpdb')->name('ppdb.')->group(function () {
    Route::get('/informasi', Index::class)->name('informasi');
    Route::get('/registrasi-siswa', MultiStepRegistration::class)->name('registrasi-siswa');
    Route::get('/hasil-seleksi', SelectionStudent::class)->name('hasil-seleksi');
});

// AUTH
Route::namespace('App\Livewire\Auth')->middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
});

// DASHBOARD / BERANDA
Route::prefix('/dashboard')->middleware(['auth', 'verified'])->name('dashboard.')->namespace('App\Livewire\Dashboard')->group(function () {
    Route::get('/', Index::class)->name('index');
});

// LOGOUT
Route::post('/logout', [LogoutController::class, 'logout'])
    ->middleware(['auth', 'verified'])->name('logout');

// APLICATION
Route::middleware(['auth', 'verified'])->group(function () {
    // SAMBUTAN
    Route::namespace('App\Livewire\KataSambutan')->middleware('roles:admin')->prefix('kata-sambutan')->name('kata-sambutan.')->group(function () {
        Route::get('/', Index::class)->name('index');
        Route::get('sunting', Create::class)->name('create');
    });

    // MENU PROFIL
    Route::prefix('menu-profil')->name('menu-profil.')->group(function () {
        // TUJUAN
        Route::namespace('App\Livewire\MenuProfil\Tujuan')->middleware('roles:admin')->prefix('tujuan')->name('tujuan.')->group(function () {
            Route::get('/', Index::class)->name('index');
            Route::get('sunting', Create::class)->name('create');
        });

        // VISI MISI
        Route::namespace('App\Livewire\MenuProfil\VisiMisi')->middleware('roles:admin')->prefix('visi-misi')->name('visi-misi.')->group(function () {
            Route::get('/', Index::class)->name('index');
            Route::get('sunting', Create::class)->name('create');
        });

        // MAKNA LOGO
        Route::namespace('App\Livewire\MenuProfil\MaknaLogo')->middleware('roles:admin')->prefix('makna-logo')->name('makna-logo.')->group(function () {
            Route::get('/', Index::class)->name('index');
            Route::get('sunting', Create::class)->name('create');
        });

        // SEJARAH
        Route::namespace('App\Livewire\MenuProfil\Sejarah')->middleware('roles:admin')->prefix('sejarah')->name('sejarah.')->group(function () {
            Route::get('/', Index::class)->name('index');
            Route::get('sunting', Create::class)->name('create');
        });

        // STRUKTUR ORGANISASI
        Route::namespace('App\Livewire\MenuProfil\StrukturOrganisasi')->middleware('roles:admin')->prefix('struktur-organisasi')->name('struktur-organisasi.')->group(function () {
            Route::get('/', Index::class)->name('index');
            Route::get('sunting', Create::class)->name('create');
        });
    });

    // MASTER
    Route::middleware('roles:admin')->prefix('master')->name('master.')->group(function () {
        // SISWA
        Route::namespace('App\Livewire\Master\Student')->prefix('siswa')->name('siswa.')->group(function () {
            Route::get('/', Index::class)->name('index');
            Route::get('/tambah', Create::class)->name('create');
            Route::get('/sunting/{id}', Edit::class)->name('edit');
            Route::get('/detail/{id}', Show::class)->name('show');
        });
        // SOAL
        Route::namespace('App\Livewire\Master\Tests')->prefix('ujian')->name('ujian.')->group(function () {
            Route::get('/', Index::class)->name('index');
            Route::get('/tambah', Create::class)->name('create');
            Route::get('/sunting/{id}', Edit::class)->name('edit');
            Route::get('/detail/{id}', Show::class)->name('show');
        });
    });

    // VERIFIKASI DATA
    Route::namespace('App\Livewire\VerificationData')->middleware('roles:admin')->prefix('verifikasi')->name('verifikasi.')->group(function () {
        Route::get('/siswa', Student::class)->name('siswa');
        Route::get('/kelulusan', Graduation::class)->name('kelulusan');
    });

    // BERITA
    Route::namespace('App\Livewire\Berita')->middleware('roles:admin')->prefix('menu-berita')->name('menu-berita.')->group(function () {
        Route::get('/', Index::class)->name('index');
        Route::get('/tambah', Create::class)->name('create');
        Route::get('/sunting/{id}', Edit::class)->name('edit');
        Route::get('/berita/kategori', Category::class)->name('category');
    });

    // SETTING
    Route::namespace('App\Livewire\Akun')->prefix('setting')->name('setting.')->group(function () {
        // PROFIL USER
        Route::namespace('Profil')->prefix('user-profil')->middleware('roles:admin,user')->name('user-profil.')->group(function () {
            Route::get('/', Index::class)->name('index');
        });

        // AKUN
        Route::prefix('akun')->name('akun.')->middleware('roles:admin')->group(function () {
            Route::get('/', Index::class)->name('index');
            Route::get('/tambah', Create::class)->name('create');
            Route::get('/sunting/{id}', Edit::class)->name('edit');
            Route::get('/detail/{id}', Show::class)->name('show');
        });
    });

    // SLIDE SHOW
    Route::namespace('App\Livewire\SlideShow')->middleware('roles:admin')->prefix('slide-show')->name('slide-show.')->group(function () {
        Route::get('/', Index::class)->name('index');
    });

    // INDENTITAS SEKOLAH
    Route::namespace('App\Livewire\IndentitasSekolah')->middleware('roles:admin')->prefix('indentitas-sekolah')->name('indentitas-sekolah.')->group(function () {
        Route::get('/', Index::class)->name('index');
    });

    Route::namespace('App\Livewire\StudentTest')->prefix('tes-ujian')->name('tes-ujian.')->group(function () {
        Route::get('/', Index::class)->name('index');
    });
});
