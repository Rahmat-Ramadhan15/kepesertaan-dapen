<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Membuka blokir operator
    public function unblockUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->role !== 'operator') {
            return redirect()->back()->with('error', 'Anda hanya bisa membuka blokir operator.');
        }

        $user->is_blocked = false;
        $user->login_attempts = 0;
        $user->save();

        return redirect()->back()->with('success', 'Blokir operator berhasil dibuka.');
    }

    // Menampilkan form tambah operator
    public function createOperator()
    {
        return view('admin.create-operator');
    }

    // Menyimpan operator baru
    public function storeOperator(Request $request)
    {
        $request->validate([
            'nip' => 'required|string|max:50|unique:users,nip',
            'name' => 'required|string|max:255',
            'role' => 'required|in:operator,supervisor,admin',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
                'confirmed',
            ],
        ], [
            'nip.required' => 'NIP wajib diisi.',
            'nip.string' => 'NIP harus berupa teks.',
            'nip.max' => 'NIP maksimal terdiri dari 50 karakter.',
            'nip.unique' => 'NIP sudah terdaftar.',
            
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal terdiri dari 255 karakter.',

            'role.required' => 'Role wajib dipilih.',
            'role.in' => 'Role tidak valid.',

            'password.required' => 'Password wajib diisi.',
            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password minimal terdiri dari 8 karakter.',
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan simbol.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);


        User::create([
            'nip' => $request->nip,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_blocked' => false,
            'login_attempts' => 0,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    // Menampilkan form edit operator
    public function edit($id)
    {
        $user = User::findOrFail($id);

        if (!in_array($user->role, ['operator', 'supervisor'])) {
            return redirect()->back()->with('error', 'Hanya operator dan supervisor yang bisa diedit.');
        }

        return view('admin.edit-user', compact('user'));
    }

    // Menyimpan perubahan operator
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (!in_array($user->role, ['operator', 'supervisor'])) {
            return redirect()->back()->with('error', 'Hanya operator dan supervisor yang bisa diperbarui.');
        }


       $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:operator,supervisor,admin',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
                'confirmed',
            ],
        ], [
            'password.required' => 'Password wajib diisi.',
            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password minimal terdiri dari 8 karakter.',
            'password.regex' => 'Password harus terdiri dari huruf besar, huruf kecil, angka, dan simbol.',
            'password.confirmed' => 'Konfirmasi password tidak sama dengan password.',
        ]);


        $user->name = $request->name;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'Data operator berhasil diperbarui.');
    }

    // Menghapus operator
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (!in_array($user->role, ['operator', 'supervisor'])) {
            return redirect()->back()->with('error', 'Hanya operator dan supervisor yang bisa dihapus.');
        }

        // Optional: Cegah menghapus dirinya sendiri
        if (auth()->id() == $user->id) {
            return redirect()->back()->with('error', 'Anda tidak bisa menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->back()->with('success', 'Pengguna berhasil dihapus.');
    }
}
