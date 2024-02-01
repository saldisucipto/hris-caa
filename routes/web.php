<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Data\KonfigurasiDataController;
use App\Http\Controllers\Data\MasterDataController;
use App\Http\Controllers\FrontPages\FrontPagesControlller;
use App\Http\Controllers\Hris\HrisController;
use Illuminate\Support\Facades\Route;
use App\Models\AnalisisPengunjung;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Hris\LaporanController;
use App\Http\Controllers\Hris\LaporanKaryawanController;

// auth route
Route::match(['get', 'post'], '/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout']);


// end auth route
Route::get('/', function () {
    return redirect('/hris');
});

// HRIS
Route::prefix('/hris')->middleware('auth')->group(function () {
    // Front Pages Routes
    Route::get('/', [HrisController::class, 'index'])->name('indexHris');

    Route::prefix('/karyawan')->middleware('auth')->group(function () {
        Route::get('/', [HrisController::class, 'karyawan']);

        Route::get('/data-karyawan', [HrisController::class, 'dataKaryawan']);
        Route::match(['get', 'post'], '/import-data-karyawan', [HrisController::class, 'importDataKaryawan']);
        Route::match(['get', 'post'], '/buat-data-karyawan', [HrisController::class, 'buatDataKaryawan']);

        Route::get('/show-karyawan/{id}', [HrisController::class, 'detailKaryawan']);
        Route::match(['get', 'post'], '/update-karyawan/{id}', [HrisController::class, 'updateKaryawan']);

        Route::match(['get', 'delete'], '/delete-karyawan/{id}', [HrisController::class, 'deleteKaryawan']);

        Route::post('/change-photo/{id}', [HrisController::class, 'changePicture']);

        // mutasi karyawan
        Route::prefix('/mutasi')->group(function () {
            Route::get('/', [HrisController::class, 'mutasi']);
            Route::match(['get', 'post'], '/{id}', [HrisController::class, 'mutasiKaryawan']);
        });

        // resign
        Route::prefix('/resign')->group(function () {
            Route::get('/', [HrisController::class, 'resign']);
            Route::match(['get', 'post'], '/{id}', [HrisController::class, 'resignKaryawan']);
        });

        // cuti karywan
        Route::prefix('/cuti')->group(function () {
            Route::match(['get', 'post'], '/', [HrisController::class, 'cuti']);
            Route::match(['get', 'post'], '/create', [HrisController::class, 'createCuti']);
            Route::match(['get', 'post'], '/create-cuti-bersama', [HrisController::class, 'createCutiBersama']);
            // Detail cuti
            Route::match(['get', 'post'], '/details/{id}', [HrisController::class, 'detailsCuti']);
        });

        // perinagatn
        Route::prefix('/peringatan')->group(function () {
            // group route
            Route::match(['get', 'post'], '/', [HrisController::class, 'suratPeringatan']);

            Route::match(['get', 'post'], '/create', [HrisController::class, 'createPringatan']);
            Route::post('/delete/{id}', [HrisController::class, 'deletePeringatan']);
        });
    });
    // laporan
    Route::prefix('/laporan')->group(function () {
        // karyawan
        Route::post('/karyawan', [LaporanKaryawanController::class, 'laporanKaryawan']);
    });
});




// dashboard
Route::prefix('/dashboard')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);

    Route::post('/user/{id}', [AuthController::class, 'updateProfile']);

    // Route View and Get Data
    Route::prefix('/master')->group(function () {
        Route::get('/', [DashboardController::class, 'masterPages']);
        Route::prefix('/produk')->group(function () {
            Route::get('/', [DashboardController::class, 'masterProduk']);
            // Katgeori Produk
            Route::prefix('/kategori')->group(function () {
                Route::get('/', [DashboardController::class, 'kategoriProduk']);
            });
            // Brand Produk
            Route::prefix('/brand')->group(function () {
                Route::get('/', [DashboardController::class, 'brandProduk']);
            });
        });
        // Sosmed
        Route::prefix('/sosmed')->group(function () {
            Route::get('/', [DashboardController::class, 'sosmedPages']);
        });
        // Servis
        Route::prefix('/servis')->group(function () {
            Route::get('/', [DashboardController::class, 'masterServis']);
        });
        // Customer
        Route::prefix('/customer')->group(function () {
            Route::get('/', [DashboardController::class, 'masterCustomer']);
        });
        // Sliders
        Route::get('/slider', [DashboardController::class, 'sliderPages']);

        // Panel Utama
        Route::get('/panel-utama', [DashboardController::class, 'panelUtama']);
    });

    Route::prefix('/konfigurasi')->group(function () {
        Route::get('/', [DashboardController::class, 'konfigurasiPages']);
        Route::get('/company', [DashboardController::class, 'konfigurasiCompany']);
    });

    Route::prefix('/pages')->group(function () {
        Route::get('/', [DashboardController::class, 'staticPages']);
    });

    Route::get('blog-news', [DashboardController::class, 'blogPages']);

    // profile
    Route::get('profile', [DashboardController::class, 'profilePages']);



    // Ruote Action
    Route::prefix('/master')->group(function () {
        Route::prefix('/produk')->group(function () {
            // Kategori Produk
            Route::post('/create-kategori-produk', [MasterDataController::class, 'createKategoriData']);
            Route::post('/delete-kategori-produk', [MasterDataController::class, 'deleteKategoriData']);
            Route::post('/update-kategori-data/{id}', [MasterDataController::class, 'updateDataKategoriData']);
            Route::delete('/delete-kategori/{id}', [MasterDataController::class, 'deleteSingleKategoriData']);

            // Brand Produk
            Route::post('/create-brand-produk', [MasterDataController::class, 'createBrandData']);
            Route::post('/delete-brand-produk', [MasterDataController::class, 'deleteBrandData']);
            Route::post('/update-brand-data/{id}', [MasterDataController::class, 'updateDataBrandData']);
            Route::delete('/delete-brand/{id}', [MasterDataController::class, 'deleteSingleBrandData']);

            // Produk
            Route::post('/create-produk', [MasterDataController::class, 'createProdukData']);
            Route::post('/update-produk/{id}', [MasterDataController::class, 'updateProdukData']);
            Route::post('/delete-multi-produk', [MasterDataController::class, 'deleteMultipleProdukData']);
            Route::delete('/delete-produk/{id}', [MasterDataController::class, 'deleteProduk']);
            // Delete Images Produk
            Route::delete('/delete-images-produk/{id}', [MasterDataController::class, 'deleteImagesProduk']);
        });

        Route::prefix('/servis')->group(function () {
            // Create Servis Data
            Route::post('/create-servis', [MasterDataController::class, 'createServisData']);
            Route::post('/update-servis/{id}', [MasterDataController::class, 'updateServisData']);
            Route::post('/delete-multi-servis', [MasterDataController::class, 'deleteMultipleServisData']);
            Route::delete('/delete-servis/{id}', [MasterDataController::class, 'deleteServisData']);
        });

        Route::prefix('/company')->group(function () {
            // Create Servis Data
            Route::post('/create-servis', [MasterDataController::class, 'createServisData']);
            Route::post('/update-servis/{id}', [MasterDataController::class, 'updateServisData']);
            Route::post('/delete-multi-servis', [MasterDataController::class, 'deleteMultipleServisData']);
            Route::delete('/delete-servis/{id}', [MasterDataController::class, 'deleteServisData']);
        });

        Route::prefix('/customer')->group(function () {
            // Create Servis Data
            Route::post('/create-customer', [MasterDataController::class, 'createCustomerData']);
            Route::post('/update-customer/{id}', [MasterDataController::class, 'updateCustomerData']);
            Route::post('/delete-multi-customer', [MasterDataController::class, 'deleteMultipleCustomerData']);
            Route::delete('/delete-customer/{id}', [MasterDataController::class, 'deleteCustomerData']);
        });
        Route::prefix('/sosmed')->group(function () {
            // Create Sosmed Data
            Route::post('/create-sosmed', [MasterDataController::class, 'createSosmed']);
            Route::post('/update-sosmed/{id}', [MasterDataController::class, 'updateSosmed']);
            Route::delete('/delete-sosmed/{id}', [MasterDataController::class, 'deleteSosmed']);
        });

        Route::prefix('/slider')->group(function () {
            // Create Slider Data
            Route::post('/create-slider', [MasterDataController::class, 'createSlider']);
            Route::post('/update-slider/{id}', [MasterDataController::class, 'updateSlider']);
            Route::delete('/delete-slider/{id}', [MasterDataController::class, 'deleteSlider']);
        });

        Route::prefix('/panel-utama')->group(function () {
            Route::post('/create-panel', [MasterDataController::class, 'createPanelUtama']);
            Route::post('/update-panel/{id}', [MasterDataController::class, 'updatePanelUtama']);
            Route::delete('/delete-panel/{id}', [MasterDataController::class, 'deletePanel']);
        });
    });


    Route::prefix('/konfigurasi')->group(function () {
        Route::post('/update', [KonfigurasiDataController::class, 'updateCompanyInfo']);
    });

    Route::prefix('/static-content')->group(function () {
        Route::post('/create-data', [MasterDataController::class, 'createStaticPages']);
        Route::post('/update-data/{id}', [MasterDataController::class, 'updateStaticPages']);
        Route::delete('/delete-data/{id}', [MasterDataController::class, 'deleteStaticData']);
    });
    Route::prefix('/blog-news')->group(function () {
        Route::post('/create-data', [MasterDataController::class, 'createBlogNews']);
        Route::post('/update-data/{id}', [MasterDataController::class, 'updateBlogNews']);
        Route::delete('/delete-data/{id}', [MasterDataController::class, 'deleteBlogNews']);
    });

    Route::prefix('/laporan')->group(function () {
        Route::get('/', [LaporanController::class, 'index']);
        Route::get('/karyawan', [LaporanKaryawanController::class, 'karyawan']);
    });
});




// Produk Route
Route::prefix('/produk')->group(function () {
    // Produk Show
    Route::get('/', [FrontPagesControlller::class, 'produkPages'])->name('produk');
    Route::get('/{slugs}', [FrontPagesControlller::class, 'produkDetailsPages']);

    // Produk By Kategori
    Route::get('/kategori/{slugs}', [FrontPagesControlller::class, 'produkByKategori']);
    Route::get('/brand/{slugs}', [FrontPagesControlller::class, 'produkByBrand']);
});

// Servis Route
Route::prefix('/servis')->group(function () {
    Route::get('/', [FrontPagesControlller::class, 'servisPages'])->name('servis');
    Route::get('/{slugs}', [FrontPagesControlller::class, 'servisDetailPages']);
});

// News and Blog
Route::prefix('/news')->group(function () {
    Route::get('/', [FrontPagesControlller::class, 'newsPages'])->name('news');
    Route::get('/{slugs}', [FrontPagesControlller::class, 'newssDetailPages']);
});


// Tentang Kami
Route::get('/tentang-kami', [FrontPagesControlller::class, 'tentangKamiPages'])->name('about');


Route::get('/exportlaporan', [LaporanKaryawanController::class, 'export']);
