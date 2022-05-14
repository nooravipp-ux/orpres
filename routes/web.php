<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\ClientController::class, 'index'])->name('index');
Route::get('/data-keolahragaan', [App\Http\Controllers\ClientController::class, 'detail'])->name('detail');


Route::post('/simpan-data-survey', [App\Http\Controllers\SaranaOlahragaController::class, 'store'])->name('simpanSurvey');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Master Data

//Pengguna
Route::get('/pengguna', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
Route::post('/pengguna/store', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
Route::get('/pengguna/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
Route::post('/pengguna/update', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
Route::get('/pengguna/delete/{id}', [App\Http\Controllers\UserController::class, 'delete'])->name('users.delete');

//Kecamatan
Route::get('/kecamatan', [App\Http\Controllers\KecamatanController::class, 'index'])->name('kecamatan.index');
Route::get('/kecamatan/store', [App\Http\Controllers\KecamatanController::class, 'store'])->name('kecamatan.store');
Route::get('/kecamatan/edit/{id}', [App\Http\Controllers\KecamatanController::class, 'edit'])->name('kecamatan.edit');
Route::get('/kecamatan/update', [App\Http\Controllers\KecamatanController::class, 'update'])->name('kecamatan.update');
Route::get('/kecamatan/delete/{id}', [App\Http\Controllers\KecamatanController::class, 'delete'])->name('kecamatan.delete');

//Cabang Olahraga
Route::get('/cabang-olahraga', [App\Http\Controllers\CabangOlahragaController::class, 'index'])->name('cabor.index');
Route::post('/cabang-olahraga/store', [App\Http\Controllers\CabangOlahragaController::class, 'store'])->name('cabor.store');
Route::get('/cabang-olahraga/edit/{id}', [App\Http\Controllers\CabangOlahragaController::class, 'edit'])->name('cabor.edit');
Route::post('/cabang-olahraga/update', [App\Http\Controllers\CabangOlahragaController::class, 'update'])->name('cabor.update');

//Kelurahan
Route::get('/kelurahan', [App\Http\Controllers\KelurahanController::class, 'index'])->name('kelurahan.index');
Route::post('/kelurahan/store', [App\Http\Controllers\KelurahanController::class, 'store'])->name('kelurahan.store');
Route::get('/kelurahan/edit/{id}', [App\Http\Controllers\KelurahanController::class, 'edit'])->name('kelurahan.edit');
Route::post('/kelurahan/update', [App\Http\Controllers\KelurahanController::class, 'update'])->name('kelurahan.update');
Route::get('/kelurahan/delete/{id}', [App\Http\Controllers\KelurahanController::class, 'delete'])->name('kelurahan.delete');
Route::get('/kelurahan/get-desa-kelurahan-by-id-kecamatan/{id}', [App\Http\Controllers\KelurahanController::class, 'getKelurahanByIdKecamatan']);

//Sarana Prasarana
Route::get('/sarana-prasarana', [App\Http\Controllers\SaranaPrasaranaController::class, 'index'])->name('saranaPrasarana.index');
Route::post('/sarana', [App\Http\Controllers\SaranaPrasaranaController::class, 'storeSarana'])->name('sarana.store');
Route::get('/sarana/edit/{id}', [App\Http\Controllers\SaranaPrasaranaController::class, 'editSarana'])->name('sarana.edit');
Route::post('/sarana/update', [App\Http\Controllers\SaranaPrasaranaController::class, 'updateSarana'])->name('sarana.update');

Route::post('/prasarana', [App\Http\Controllers\SaranaPrasaranaController::class, 'storePrasarana'])->name('prasarana.store');
Route::get('/sarana-prasarana/edit/{id}', [App\Http\Controllers\SaranaPrasaranaController::class, 'editPrasarana'])->name('prasarana.edit');
Route::post('/sarana-prasarana/update', [App\Http\Controllers\SaranaPrasaranaController::class, 'updatePrasarana'])->name('prasarana.update');

//pendataan survey
Route::get('/sarana-olahraga', [App\Http\Controllers\SaranaOlahragaController::class, 'index'])->name('saranaOlahraga.index');
Route::get('/sarana-olahraga/create', [App\Http\Controllers\SaranaOlahragaController::class, 'create'])->name('saranaOlahraga.create');
Route::get('/sarana-olahraga/createP3/{id}', [App\Http\Controllers\SaranaOlahragaController::class, 'createP3'])->name('sarana.createP3');
Route::get('/sarana-olahraga/createP4/{id}', [App\Http\Controllers\SaranaOlahragaController::class, 'createP4'])->name('sarana.createP4');
Route::get('/sarana-olahraga/createP5/{id}', [App\Http\Controllers\SaranaOlahragaController::class, 'createP5'])->name('sarana.createP5');
Route::get('/sarana-olahraga/createP6/{id}', [App\Http\Controllers\SaranaOlahragaController::class, 'createP6'])->name('sarana.createP6');
Route::get('/sarana-olahraga/createP7/{id}', [App\Http\Controllers\SaranaOlahragaController::class, 'createP7'])->name('sarana.createP7');

Route::post('/sarana-olahraga/store', [App\Http\Controllers\SaranaOlahragaController::class, 'storeP1P2'])->name('sarana.storeP1P2');
Route::post('/sarana-olahraga/storeP3', [App\Http\Controllers\SaranaOlahragaController::class, 'storeP3'])->name('sarana.storeP3');
Route::post('/sarana-olahraga/storeP4', [App\Http\Controllers\SaranaOlahragaController::class, 'storeP4'])->name('sarana.storeP4');
Route::post('/sarana-olahraga/storeP5', [App\Http\Controllers\SaranaOlahragaController::class, 'storeP5'])->name('sarana.storeP5');
Route::post('/sarana-olahraga/storeP6', [App\Http\Controllers\SaranaOlahragaController::class, 'storeP6'])->name('sarana.storeP6');

Route::get('/sarana-olahraga/show/{id}', [App\Http\Controllers\SaranaOlahragaController::class, 'show'])->name('saranaOlahraga.show');
Route::get('/sarana-olahraga/edit/{id}', [App\Http\Controllers\SaranaOlahragaController::class, 'edit'])->name('saranaOlahraga.edit');
Route::get('/sarana-olahraga/update', [App\Http\Controllers\SaranaOlahragaController::class, 'update'])->name('saranaOlahraga.update');
Route::get('/sarana-olahraga/delete/{id}', [App\Http\Controllers\SaranaOlahragaController::class, 'delete'])->name('saranaOlahraga.delete');

Route::post('/sarana-olahraga/sarana/store', [App\Http\Controllers\SaranaOlahragaController::class, 'storeSaranaOlahraga'])->name('saranaOlahraga.sarana.store');
Route::get('/sarana-olahraga/sarana/edit/{id}', [App\Http\Controllers\SaranaOlahragaController::class, 'editSaranaOlahraga'])->name('saranaOlahraga.sarana.edit');
Route::post('/sarana-olahraga/sarana/update', [App\Http\Controllers\SaranaOlahragaController::class, 'updateSaranaOlahraga'])->name('saranaOlahraga.sarana.update');
Route::get('/sarana-olahraga/sarana/delete/{id}', [App\Http\Controllers\SaranaOlahragaController::class, 'deleteSaranaOlahraga'])->name('saranaOlahraga.sarana.delete');

Route::get('/sarana-olahraga/export/{id}', [App\Http\Controllers\SaranaOlahragaController::class, 'exportPDF'])->name('saranaOlahraga.export');

// Prestasi Atlet
Route::get('/prestasi-olahraga', [App\Http\Controllers\SaranaOlahragaController::class, 'prestasiOlahraga'])->name('prestasiOlahraga.index');
Route::get('/prestasi-olahraga/create', [App\Http\Controllers\SaranaOlahragaController::class, 'prestasiOlahragaCreate'])->name('prestasiOlahraga.create');
Route::post('/prestasi-olahraga/store', [App\Http\Controllers\SaranaOlahragaController::class, 'prestasiOlahragaStore'])->name('prestasiOlahraga.store');
Route::get('/prestasi-olahraga/edit/{id}', [App\Http\Controllers\SaranaOlahragaController::class, 'prestasiOlahragaEdit'])->name('prestasiOlahraga.edit');
Route::post('/prestasi-olahraga/update', [App\Http\Controllers\SaranaOlahragaController::class, 'prestasiOlahragaUpdate'])->name('prestasiOlahraga.update');
Route::get('/prestasi-olahraga/delete/{id}', [App\Http\Controllers\SaranaOlahragaController::class, 'prestasiOlahragaDelete'])->name('prestasiOlahraga.delete');

Route::post('/detail-prestasi-olahraga/store', [App\Http\Controllers\SaranaOlahragaController::class, 'detailPrestasiOlahragaStore'])->name('detailPrestasiOlahraga.store');
Route::get('/detail-prestasi-olahraga/delete/{id}', [App\Http\Controllers\SaranaOlahragaController::class, 'detailPrestasiOlahragaDelete'])->name('detailPrestasiOlahraga.delete');

// Transaksi
Route::get('/distribusi-prasarana', [App\Http\Controllers\DistribusiPrasaranaController::class, 'index'])->name('distribusiPrasarana.index');
Route::get('/distribusi-prasarana/create/{id}', [App\Http\Controllers\DistribusiPrasaranaController::class, 'create'])->name('distribusiPrasarana.create');
Route::get('/distribusi-prasarana/verify/{id}', [App\Http\Controllers\DistribusiPrasaranaController::class, 'verifyForm'])->name('distribusiPrasarana.verify');
Route::post('/distribusi-prasarana/verified', [App\Http\Controllers\DistribusiPrasaranaController::class, 'verified'])->name('distribusiPrasarana.verified');
Route::get('/distribusi-prasarana/approve/{id}', [App\Http\Controllers\DistribusiPrasaranaController::class, 'approveForm'])->name('distribusiPrasarana.approve');
Route::post('/distribusi-prasarana/approved', [App\Http\Controllers\DistribusiPrasaranaController::class, 'approved'])->name('distribusiPrasarana.approved');
Route::post('/distribusi-prasarana/reject', [App\Http\Controllers\DistribusiPrasaranaController::class, 'reject'])->name('distribusiPrasarana.reject');
Route::post('/distribusi-prasarana/submit', [App\Http\Controllers\DistribusiPrasaranaController::class, 'submit'])->name('distribusiPrasarana.submit');
Route::post('/distribusi-prasarana/done', [App\Http\Controllers\DistribusiPrasaranaController::class, 'done'])->name('distribusiPrasarana.done');

Route::post('/distribusi-prasarana/store', [App\Http\Controllers\DistribusiPrasaranaController::class, 'store'])->name('distribusiPrasarana.store');
Route::post('/distribusi-prasarana-detail/store', [App\Http\Controllers\DistribusiPrasaranaController::class, 'storeDetail'])->name('detailDistribusiPrasarana.store');
Route::get('/distribusi-prasarana/export-berita-acara/{id}', [App\Http\Controllers\DistribusiPrasaranaController::class, 'cetakBA'])->name('distribusiPrasarana.cetakBA');
Route::get('/distribusi-prasarana/export-nphd/{id}', [App\Http\Controllers\DistribusiPrasaranaController::class, 'cetakNPHD'])->name('distribusiPrasarana.cetakNPHD');

Route::get('/distribusi-prasarana/report-cpcl', [App\Http\Controllers\DistribusiPrasaranaController::class, 'reportCPCL'])->name('distribusiPrasarana.reportCPCL');

//Pengajuan
Route::get('/distribusi-prasarana/pengajuan-prasarana', [App\Http\Controllers\DistribusiPrasaranaController::class, 'pengajuan'])->name('distribusiPrasarana.pengajuan');
Route::get('/distribusi-prasarana/pengajuan-prasarana/create', [App\Http\Controllers\DistribusiPrasaranaController::class, 'buatPengajuan'])->name('distribusiPrasarana.pengajuan.create');

//Adjustment CPCL
Route::post('/distribusi-prasarana/insert-cpcl', [App\Http\Controllers\DistribusiPrasaranaController::class, 'storeDataForCPCL'])->name('distribusiPrasarana.insertCPCL');

Route::get('/distribusi-prasarana/export-cpcl', [App\Http\Controllers\DistribusiPrasaranaController::class, 'exportCPCL'])->name('distribusiPrasarana.exportCPCL');


//Pengajuan Lembaga
Route::get('/distribusi-prasarana-lembaga', [App\Http\Controllers\DistribusiPrasaranaLembagaController::class, 'index'])->name('distribusiPrasaranaLembaga.index');
Route::get('/distribusi-prasarana-lembaga/create', [App\Http\Controllers\DistribusiPrasaranaLembagaController::class, 'create'])->name('distribusiPrasaranaLembaga.create');
Route::post('/distribusi-prasarana-lembaga', [App\Http\Controllers\DistribusiPrasaranaLembagaController::class, 'store'])->name('distribusiPrasaranaLembaga.store');
Route::get('/distribusi-prasarana-lembaga/edit/{id}', [App\Http\Controllers\DistribusiPrasaranaLembagaController::class, 'edit'])->name('distribusiPrasaranaLembaga.edit');
Route::get('/distribusi-prasarana-lembaga/hapus/{id}', [App\Http\Controllers\DistribusiPrasaranaLembagaController::class, 'hapus'])->name('distribusiPrasaranaLembaga.hapus');

// Approve, Reject, done
Route::post('/distribusi-prasarana-lembaga/submit', [App\Http\Controllers\DistribusiPrasaranaLembagaController::class, 'submit'])->name('distribusiPrasaranaLembaga.submit');
Route::get('/distribusi-prasarana-lembaga/approve/{id}', [App\Http\Controllers\DistribusiPrasaranaLembagaController::class, 'approve'])->name('distribusiPrasaranaLembaga.approve');
Route::get('/distribusi-prasarana-lembaga/reject/{id}', [App\Http\Controllers\DistribusiPrasaranaLembagaController::class, 'reject'])->name('distribusiPrasaranaLembaga.reject');

Route::get('/distribusi-prasarana-lembaga/detail/{idDistribusi}', [App\Http\Controllers\DistribusiPrasaranaLembagaController::class, 'createDetail'])->name('distribusiPrasaranaLembaga.createDetail');
Route::post('/distribusi-prasarana-lembaga/detail', [App\Http\Controllers\DistribusiPrasaranaLembagaController::class, 'storeDetail'])->name('distribusiPrasaranaLembaga.storeDetail');
Route::get('/distribusi-prasarana-lembaga/detail/edit/{id}', [App\Http\Controllers\DistribusiPrasaranaLembagaController::class, 'editDetail'])->name('distribusiPrasaranaLembaga.editDetail');
Route::post('/distribusi-prasarana-lembaga/detail/update/{id}', [App\Http\Controllers\DistribusiPrasaranaLembagaController::class, 'updateDetail'])->name('distribusiPrasaranaLembaga.updateDetail');
Route::get('/distribusi-prasarana-lembaga/{idDistribusiPrasaranaLembaga}/detail/hapus/{id}', [App\Http\Controllers\DistribusiPrasaranaLembagaController::class, 'hapusDetail'])->name('distribusiPrasaranaLembaga.hapusDetail');

