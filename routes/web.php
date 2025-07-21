<?php

use App\Http\Controllers\Admin\Parameter\NsAnakController;
use App\Http\Controllers\Admin\Parameter\NsJandaController;
use App\Http\Controllers\Admin\Parameter\NsPegawaiController;
use Illuminate\Support\Facades\Route;
use Mews\Captcha\Facades\Captcha;

use App\Models\User;

//Middleware
use App\Http\Middleware\RoleMiddleware;
//Auth
use App\Http\Controllers\Auth\AuthController;
//Admin
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\Admin\DataCabangController;
use App\Http\Controllers\Admin\Parameter\NilaiSekarangController;
use App\Http\Controllers\Admin\Parameter\PtkpController;
use App\Http\Controllers\Admin\DataBankController;
use App\Http\Controllers\Admin\Parameter\TableKenaikanController;
use App\Http\Controllers\Admin\Parameter\IuranParameterController;

//Operator
use App\Http\Controllers\Operator\KeluargaController;
use App\Http\Controllers\Operator\OperatorController;
use App\Http\Controllers\Operator\CetakController;
use App\Http\Controllers\Operator\ManfaatPensiunController;
use App\Http\Controllers\Operator\HitungIuranController;
use App\Http\Controllers\Operator\OperatorParameterController;

//Supervisor
use App\Http\Controllers\Supervisor\SupervisorController;
use App\Http\Controllers\Supervisor\ExportController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/ganti-password', [AuthController::class, 'showChangePasswordForm'])->name('ganti-password');
Route::post('/ganti-password', [AuthController::class, 'changePassword'])->name('post.ganti-password');

// Ganti password biasa (setelah login)
Route::middleware('auth')->group(function () {
    Route::get('/ubah-password', [AuthController::class, 'showUpdatePasswordForm'])->name('ubah-password.form');
    Route::post('/ubah-password', [AuthController::class, 'updatePassword'])->name('ubah-password.update');
});


Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/refresh-captcha', function () {
    return response()->json(['captcha' => Captcha::src()]);
})->name('captcha.refresh');

//Admin
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin', function () {
        $users = User::all(); // Ambil semua data user
        return view('admin.dashboard', compact('users'));
    })->name('admin.dashboard');
    Route::post('/admin/unblock-user/{id}', [AdminController::class, 'unblockUser'])->name('admin.unblock-user');
    // Tampilkan form
    Route::get('/admin/operator/create', [AdminController::class, 'createOperator'])->name('admin.create-operator');

    // Simpan data operator
    Route::post('/admin/operator/store', [AdminController::class, 'storeOperator'])->name('admin.store-operator');
    Route::get('/admin/user/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit-user');
    Route::put('/admin/user/{id}', [AdminController::class, 'update'])->name('admin.update-user');
    Route::delete('/admin/user/{id}', [AdminController::class, 'destroy'])->name('admin.delete-user');

    // Route::post('/logout', function () {
    //     Auth::logout();
    //     return redirect('/login');
    // })->name('logout');    
    Route::get('/admin/audit-log', [AuditLogController::class, 'index'])->name('admin.audit-log');
    Route::resource('cabang', DataCabangController::class);

    Route::prefix('admin/parameter')->name('admin.parameter.')->middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
        Route::resource('ns', NilaiSekarangController::class);
        Route::resource('nspegawai', NsPegawaiController::class);
        Route::resource('nsjanda', NsJandaController::class);
        Route::resource('nsanak', NsAnakController::class);
        Route::resource('ptkp', ptkpController::class);
        Route::resource('databank', DataBankController::class);
        Route::resource('kenaikan', TableKenaikanController::class);
        Route::resource('parameter_iuran', IuranParameterController::class);
    });

    

});


//Supervisor
Route::middleware(['auth', RoleMiddleware::class . ':supervisor'])->group(function () {
    Route::get('/supervisor', [SupervisorController::class, 'dashboard'])->name('supervisor.dashboard');
    Route::get('/export/peserta', [ExportController::class, 'exportPeserta'])->name('export.peserta');
    Route::get('/supervisor/laporan', [SupervisorController::class, 'laporan'])->name('supervisor.laporan');
    Route::get('/supervisor/pdf', [SupervisorController::class, 'exportPdf'])->name('supervisor.exportPdf');
    Route::get('/supervisor/laporan-pdf', [SupervisorController::class, 'laporanPdf'])->name('supervisor.laporanPdf');

});


//Operator
Route::middleware(['auth', RoleMiddleware::class . ':operator'])->group(function () {
    Route::get('/operator', [OperatorController::class, 'index'])->name('operator.dashboard');

    Route::prefix('operator/hitung')->name('operator.hitung.')->group(function () {
        Route::get('/', [HitungIuranController::class, 'index'])->name('index');
        Route::get('/{nip}/detail', [HitungIuranController::class, 'detail'])->name('detail');
        Route::post('/process', [HitungIuranController::class, 'hitung'])->name('process');
        Route::delete('/histori/{id}', [HitungIuranController::class, 'destroyHistori'])->name('destroyHistori');
        Route::get('/get-previous-month-data', [HitungIuranController::class, 'getPreviousMonthData'])->name('getPreviousMonthData'); // Rute AJAX
        Route::get('/{nip}/pdf', [HitungIuranController::class, 'generatePDF'])->name('pdf'); // Route untuk PDF
    });

    Route::prefix('operator')->group(function () {
        Route::resource('operator', OperatorController::class); // Menghindari konflik dengan dashboard
        Route::get('{nip}/detail', [OperatorController::class, 'detail'])->name('operator.detail');
    });

    Route::prefix('operator/parameters')->name('operator.parameters.')->group(function () {
        Route::get('databank', [OperatorParameterController::class, 'showDataBank'])->name('databank');
        Route::get('datacabang', [OperatorParameterController::class, 'showDataCabang'])->name('datacabang');
        Route::get('ptkp', [OperatorParameterController::class, 'showPtkp'])->name('ptkp');
        Route::get('nilaisekarang', [OperatorParameterController::class, 'showNilaiSekarang'])->name('nilaisekarang');
        Route::get('nsanak', [OperatorParameterController::class, 'showNsAnak'])->name('nsanak');
        Route::get('nsjanda', [OperatorParameterController::class, 'showNsJanda'])->name('nsjanda');
        Route::get('nspegawai', [OperatorParameterController::class, 'showNsPegawai'])->name('nspegawai');
    });

    //Manfaat Pensiun
    Route::get('manfaat/form/{nip}', [ManfaatPensiunController::class, 'form'])->name('manfaat.form');
    // routes/web.php
    Route::post('/manfaat/bayar', [ManfaatPensiunController::class, 'bayar'])->name('manfaat.bayar');
    Route::post('manfaat/hitung', [ManfaatPensiunController::class, 'hitung'])->name('manfaat.hitung');
    Route::get('manfaat/{nip}/detail', [ManfaatPensiunController::class, 'detail'])->name('manfaat.detail');
    Route::resource('manfaat', ManfaatPensiunController::class);

    //Hitung Iuran
    Route::resource('hitung', HitungIuranController::class);

    //Keluarga
    Route::resource('keluarga', KeluargaController::class);

    // Untuk rute create pakai NIP (opsional)
    Route::get('/keluarga/create/{nip}', [KeluargaController::class, 'create'])->name('keluarga.create');

    //Cetak
    Route::resource('/cetak', CetakController::class);
    
    // Preview laporan (ajax)
    Route::post('/preview', [CetakController::class, 'preview'])->name('preview');

    Route::post('/fetch-data', [CetakController::class, 'fetchData'])->name('cetak.fetch-data');
    
    // Generate PDF
    Route::post('/generate-pdf', [CetakController::class, 'generatePDF'])->name('generate-pdf');
    
    // Export Excel
    Route::post('/export', [CetakController::class, 'export'])->name('export');
    Route::get('/cetak', [CetakController::class, 'index'])->name('cetak.index');
    Route::post('/cetak/preview', [CetakController::class, 'preview'])->name('cetak.preview');
    Route::post('/cetak/export', [CetakController::class, 'export'])->name('cetak.export');

    // Tambahkan route ini di routes/web.php
    Route::get('/operator/{nip}/pdf', [OperatorController::class, 'generatePDF'])->name('operator.pdf');
    Route::get('/operator/{nip}/view-pdf', [OperatorController::class, 'viewPDF'])->name('operator.view-pdf');

    Route::post('/hitung/import', [HitungIuranController::class, 'import'])->name('operator.hitung.import');

    // Menu cetak iuran
    Route::get('/operator/cetak/iuranpeserta/form', [CetakController::class, 'formIuranPeserta'])->name('operator.cetak.iuranpeserta.form');
    Route::get('/operator/cetak/iuranpeserta/preview', [CetakController::class, 'previewIuranPeserta'])->name('operator.cetak.iuranpeserta.preview');
    Route::get('/operator/cetak/iuranpeserta/pdf', [CetakController::class, 'pdfIuranPeserta'])->name('operator.cetak.iuranpeserta.pdf');


    
});