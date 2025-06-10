<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\AuditLog;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'password' => 'required',
            'captcha' => 'required|captcha',
        ]);

        $user = User::where('nip', $request->nip)->first();

        if (!$user) {
            return back()->withErrors(['nip' => 'NIP tidak ditemukan.']);
        }

        if ($user->is_blocked) {
            return back()->withErrors(['nip' => 'Akun Anda telah diblokir. Hubungi admin untuk membuka blokir.']);
        }

        if ($user->blocked_until && Carbon::now()->lt($user->blocked_until)) {
            return back()->withErrors(['nip' => 'Akun diblokir sementara. Coba lagi nanti.']);
        }

        // ⛔ CEK DULU PASSWORD BENAR APA TIDAK
        if (!Hash::check($request->password, $user->password)) {
            $user->increment('login_attempts');

            if ($user->role === 'operator' && $user->login_attempts >= 3) {
                $user->is_blocked = true;
                $user->save();
                return back()->withErrors(['nip' => 'Akun Anda telah diblokir karena 3x gagal login. Hubungi admin untuk membuka blokir.']);
            }

            $user->save();
            return back()->withErrors(['password' => 'Password salah. Percobaan ke-' . $user->login_attempts]);
        }

        // ✅ Jika password benar, baru cek kadaluarsa
        if ($user->last_password_changed && Carbon::parse($user->last_password_changed)->addMonths(3)->lt(Carbon::now())) {
            Auth::logout();
            session(['force_password_reset_nip' => $user->nip]);
            return redirect()->route('ganti-password');
        }

        // Reset percobaan login
        $user->login_attempts = 0;
        $user->blocked_until = null;
        $user->save();

        Auth::login($user);

        // Cek apakah sudah hampir 3 bulan sejak ganti password terakhir (misal 2.5 bulan / 75 hari)
        $lastChange = Carbon::parse($user->last_password_changed);
        if ($lastChange->diffInDays(Carbon::now()) >= 75) {
            session()->flash('password_warning', 'Disarankan mengganti password Anda segera.');
        }

        AuditLog::create([
            'user_id' => $user->nip,
            'model' => 'User',
            'action' => 'login',
            'description' => 'Pengguna ' . $user->name . ' berhasil login sebagai ' . $user->role
        ]);

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard')->with('users', User::all()),
            'supervisor' => redirect()->route('supervisor.dashboard'),
            'operator' => redirect()->route('operator.dashboard'),
        };
    }


    public function showChangePasswordForm()
    {
        if (!session('force_password_reset_nip')) {
            return redirect()->route('login');
        }

        return view('auth.ganti-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $user = User::where('nip', session('force_password_reset_nip'))->firstOrFail();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $user->password = Hash::make($request->password);
        $user->last_password_changed = Carbon::now();
        $user->save();

        session()->forget('force_password_reset_nip');

        Auth::logout(); // logout dulu supaya aman

        return redirect()->route('login')->with('status', 'Password berhasil diubah. Silakan login kembali.');

    }

    // Halaman ganti password biasa (sukarela)
    public function showUpdatePasswordForm()
    {
        return view('auth.ubah-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $user->password = Hash::make($request->password);
        $user->last_password_changed = now();
        $user->save();

        return back()->with('status', 'Password berhasil diubah.');
    }


    public function logout()
    {
        $user = Auth::user();

        // Simpan log aktivitas logout
        AuditLog::create([
            'user_id' => $user->nip,
            'model' => 'User',
            'action' => 'logout',
            'description' => 'Pengguna ' . $user->name . ' melakukan logout'
        ]);
    
        Auth::logout();
        return redirect()->route('login');
    }
}
