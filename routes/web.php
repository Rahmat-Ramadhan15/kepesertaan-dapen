<?php

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
use App\Http\Controllers\Admin\CabangController;
use App\Http\Controllers\Admin\Parameter\NilaiSekarangController;
use App\Http\Controllers\Admin\Parameter\PtkpController;
//Operator
use App\Http\Controllers\Operator\KeluargaController;
use App\Http\Controllers\Operator\OperatorController;
use App\Http\Controllers\Operator\CetakController;
use App\Http\Controllers\Operator\ManfaatPensiunController;
use App\Http\Controllers\Operator\HitungIuranController;
//Supervisor
use App\Http\Controllers\Supervisor\SupervisorController;
use App\Http\Controllers\Supervisor\ExportController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
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

    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');    
    Route::get('/admin/audit-log', [AuditLogController::class, 'index'])->name('admin.audit-log');
    Route::resource('cabang', CabangController::class);

    Route::prefix('admin/parameter')->name('admin.parameter.')->middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
        Route::resource('ns', NilaiSekarangController::class);
        Route::resource('ptkp', ptkpController::class);
    });

    

});


//Supervisor
Route::middleware(['auth', RoleMiddleware::class . ':supervisor'])->group(function () {
    Route::get('/supervisor', [SupervisorController::class, 'dashboard'])->name('supervisor.dashboard');
    Route::get('/export/peserta', [ExportController::class, 'exportPeserta'])->name('export.peserta');
});


//Operator
Route::middleware(['auth', RoleMiddleware::class . ':operator'])->group(function () {
    Route::get('/operator', [OperatorController::class, 'index'])->name('operator.dashboard');

    Route::prefix('operator')->group(function () {
        Route::resource('operator', OperatorController::class); // Menghindari konflik dengan dashboard
        Route::get('{nip}/detail', [OperatorController::class, 'detail'])->name('operator.detail');
    });

    //Manfaat Pensiun
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


});



