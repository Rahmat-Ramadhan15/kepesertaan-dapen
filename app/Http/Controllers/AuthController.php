<?php

namespace App\Http\Controllers;

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

        // Cek apakah user ditemukan
        if (!$user) {
            return back()->withErrors(['nip' => 'NIP tidak ditemukan.']);
        }

        // Cek apakah user terblokir oleh admin
        if ($user->is_blocked) {
            return back()->withErrors(['nip' => 'Akun Anda telah diblokir. Hubungi admin untuk membuka blokir.']);
        }

        // Cek apakah user terblokir sementara
        if ($user->blocked_until && Carbon::now()->lt($user->blocked_until)) {
            return back()->withErrors(['nip' => 'Akun diblokir sementara. Coba lagi nanti.']);
        }

        // Cek password
        if (!Hash::check($request->password, $user->password)) {
            $user->increment('login_attempts');

            // Blokir hanya untuk role operator setelah 3 kali gagal login
            if ($user->role === 'operator' && $user->login_attempts >= 3) {
                $user->is_blocked = true; // Tandai sebagai diblokir
                $user->save();
                return back()->withErrors(['nip' => 'Akun Anda telah diblokir karena 3x gagal login. Hubungi admin untuk membuka blokir.']);
            }

            $user->save();
            return back()->withErrors(['password' => 'Password salah. Percobaan ke-' . $user->login_attempts]);
        }

        // Reset percobaan gagal jika sukses login
        $user->login_attempts = 0;
        $user->blocked_until = null;
        $user->save();

        Auth::login($user);

        // Simpan log aktivitas login
        AuditLog::create([
            'user_id' => $user->nip,
            'model' => 'User',
            'action' => 'login',
            'description' => 'Pengguna ' . $user->name . ' berhasil login sebagai ' . $user->role
        ]);


        // Redirect sesuai role
        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard')->with('users', User::all()),
            'supervisor' => redirect()->route('supervisor.dashboard'),
            'operator' => redirect()->route('operator.dashboard'),
        };
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
