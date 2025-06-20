<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class PenjualProfileController extends Controller
{
    /**
     * Tampilkan form edit profil penjual.
     */
    public function edit(Request $request): View
    {
        return view('penjualView.editProfilePenjual', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update profil penjual.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        // Validasi data
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'no_telepon' => ['required', 'string', 'max:20'],
            'password' => ['nullable', 'string', 'min:6'],
        ]);

        // Update data user
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->no_telepon = $validated['no_telepon'];

        // Reset verifikasi email jika berubah
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Update password jika diisi
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('editProfilePenjual')->with('status', 'profile-updated');
    }

    /**
     * Hapus akun penjual.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
