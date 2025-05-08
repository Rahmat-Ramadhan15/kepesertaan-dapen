<?php

namespace App\Http\Controllers;

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
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'nip' => $request->nip,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role' => 'operator',
            'is_blocked' => false,
            'login_attempts' => 0,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Operator berhasil ditambahkan.');
    }

    // Menampilkan form edit operator
    public function edit($id)
    {
        $user = User::findOrFail($id);

        if ($user->role !== 'operator') {
            return redirect()->back()->with('error', 'Hanya operator yang bisa diedit.');
        }

        return view('admin.edit-user', compact('user'));
    }

    // Menyimpan perubahan operator
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->role !== 'operator') {
            return redirect()->back()->with('error', 'Hanya operator yang bisa diperbarui.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $request->name;

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

        if ($user->role !== 'operator') {
            return redirect()->back()->with('error', 'Hanya operator yang bisa dihapus.');
        }

        // Optional: Cegah menghapus dirinya sendiri
        if (auth()->id() == $user->id) {
            return redirect()->back()->with('error', 'Anda tidak bisa menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->back()->with('success', 'Operator berhasil dihapus.');
    }
}
