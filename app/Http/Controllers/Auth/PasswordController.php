<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\AuditLog;
use App\Models\User;
use Carbon\Carbon;

class PasswordController extends Controller
{
    public function showPasswordResetForm()
    {
        return view('auth.ganti-password'); // buat view ini
    }

    public function forcePasswordReset(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::where('nip', $request->nip)->first();

        if (!$user) {
            return back()->withErrors(['nip' => 'NIP tidak ditemukan.']);
        }

        $user->password = Hash::make($request->password);
        $user->last_password_changed = Carbon::now();
        $user->save();

        // Login ulang setelah ganti password
        Auth::login($user);

        return redirect()->route(match($user->role) {
            'admin' => 'admin.dashboard',
            'supervisor' => 'supervisor.dashboard',
            'operator' => 'operator.dashboard',
        });
    }

}
