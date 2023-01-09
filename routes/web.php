<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\LoginController;
use App\Http\Controllers\Front\LoginFrontController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\PaketWeddingController;
use App\Http\Controllers\Back\ManajemenUserController;
use App\Http\Controllers\Back\ProfileWebController;
use App\Http\Controllers\Back\DataPesananController;
use App\Http\Controllers\Back\AdminController;
use App\Http\Controllers\Back\LaporanPemesananController;

use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\KeranjangController;
use App\Http\Controllers\Front\PembayaranController;
use App\Http\Controllers\Front\PemesananController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('paket-wedding', [HomeController::class, 'paket_wedding'])->name(
    'paket-wedding'
);
Route::get('paket-wedding/{slug}', [
    HomeController::class,
    'detail_paket_wedding',
])->name('pakt-wedding.detail');

Route::get('/tentang', [HomeController::class, 'about'])->name('home.about');
Route::get('/kontak', [HomeController::class, 'contact'])->name('home.contact');
Route::get('artikel/kategori', function () {
    return redirect('/artikel');
});

Route::resource('keranjang', KeranjangController::class);
Route::post('keranjang/quantity-canvas', [
    KeranjangController::class,
    'quantity_canvas',
])->name('quantity-canvas');
Route::post('keranjang/hapus', [KeranjangController::class, 'hapus'])->name(
    'keranjang.hapus'
);

Route::group(['middleware' => ['auth']], function () {
    Route::resource('pembayaran', PembayaranController::class);
    Route::resource('pemesanan', PemesananController::class);
    Route::post('pemesanan-wa/batal', [
        PemesananController::class,
        'batal',
    ])->name('pemesanan-wa.batal');
    Route::get('pemesanan-wa/{id}', [
        PemesananController::class,
        'pemesanan_wa',
    ])->name('pemesanan-wa');
});

Route::resource('login', LoginFrontController::class);
Route::post('user-store', [LoginFrontController::class, 'create_user'])->name(
    'user.store'
);
Route::get('logout', [LoginFrontController::class, 'logout'])->name(
    'user.logout'
);

Route::post('login', [LoginFrontController::class, 'login'])->name('login');

Route::get('admin/logout', [LoginController::class, 'logout'])->name(
    'admin.logout'
);

Route::group(['middleware' => ['guest']], function () {
    Route::resource('admin-login', LoginController::class);
    Route::get('admin/login', [LoginController::class, 'login'])->name(
        'admin.login'
    );
});

// Back
Route::group(['middleware' => ['admin']], function () {
    Route::prefix('admin')->group(function () {
        Route::resource('dashboard', DashboardController::class);

        Route::resource('data-pesanan', DataPesananController::class);
        Route::post('data-pesanan/get-user', [
            DataPesananController::class,
            'getUser',
        ])->name('data-pesanan.get-user');
        Route::post('data-pesanan/get-paket-wedding', [
            DataPesananController::class,
            'getPaketWedding',
        ])->name('data-pesanan.get-paket-wedding');
        Route::post('data-pesanan/get-jumlah-paket', [
            DataPesananController::class,
            'getJumlahPaket',
        ])->name('data-pesanan.get-jumlah-paket');
        Route::post('data-pesanan/get-total-harga', [
            DataPesananController::class,
            'getTotalHarga',
        ])->name('data-pesanan.get-total-harga');
        Route::post('data-pesanan/select', [
            DataPesananController::class,
            'select',
        ])->name('data-pesanan.select');

        Route::resource('profile-web', ProfileWebController::class);

        Route::resource('paket-wedding', PaketWeddingController::class);
        Route::post('paket-wedding/search', [
            PaketWeddingController::class,
            'search',
        ])->name('paket-wedding.search');
        Route::post('paket-wedding/paginate', [
            PaketWeddingController::class,
            'paginate',
        ])->name('paket-wedding.paginate');
        Route::post('paket-wedding/get-foto-paket', [
            PaketWeddingController::class,
            'getFotoPaket',
        ])->name('paket-wedding.getFotoPaket');

        Route::resource('laporan-pemesanan', LaporanPemesananController::class);
        Route::post('laporan-pemesanan/select', [
            LaporanPemesananController::class,
            'select',
        ])->name('laporan-pemesanan.select');

        Route::resource('manajemen-akun-admin', AdminController::class);
        Route::get('manajemen-akun-admin/edit-password-admin/{id}', [
            AdminController::class,
            'edit_password_admin',
        ])->name('edit_password_admin');
        Route::post('manajemen-akun-admin/update-password-admin/{user}', [
            AdminController::class,
            'update_password',
        ])->name('manajemen-akun-admin.updatePasswordAdmin');
        Route::post('manajemen-akun-admin/checkUsernameAdmin', [
            AdminController::class,
            'checkUsernameAdmin',
        ])->name('manajemen-akun-admin.checkUsernameAdmin');

        Route::resource('manajemen-akun', ManajemenUserController::class);
        Route::get('manajemen-akun/edit-password/{id}', [
            ManajemenUserController::class,
            'edit_password',
        ])->name('edit_password');
        Route::post('manajemen-akun/update-password/{user}', [
            ManajemenUserController::class,
            'update_password',
        ])->name('manajemen-akun.updatePassword');
        Route::post('manajemen-akun/checkUsername', [
            ManajemenUserController::class,
            'checkUsername',
        ])->name('manajemen-akun.checkUsername');
        Route::post('manajemen-akun/checkEmail', [
            ManajemenUserController::class,
            'checkEmail',
        ])->name('manajemen-akun.checkEmail');
        Route::get('user-setting', [
            ManajemenUserController::class,
            'user_setting',
        ])->name('user-setting');
        Route::post('user-setting/update', [
            ManajemenUserController::class,
            'update-account',
        ])->name('user-setting.update');
    });
});
