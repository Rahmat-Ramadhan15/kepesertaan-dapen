<?php

use Illuminate\Support\Facades\Route;
use Mews\Captcha\Facades\Captcha;

use App\Models\User;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\ManfaatPensiunController;
use App\Http\Controllers\HitungIuranController;

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



