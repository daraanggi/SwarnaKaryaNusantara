<?php

namespace App\Http\Controllers;

use App\Models\Chat;
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
        $user = $request->user();
        $messages = Chat::with('sender')
                ->where('sender_id', $user->id)
                ->orWhere('receiver_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($chat) {
                    $chat->sender_name = $chat->sender_id == auth()->id() 
                        ? 'Anda' 
                        : ($chat->sender->name ?? 'Pengguna');
                    $chat->excerpt = substr($chat->message, 0, 50);
                    $chat->time = $chat->created_at->format('H:i');
                    $chat->avatar_url = null;
                    return $chat;
                });

        return view('penjualView.editProfilePenjual', compact('user', 'messages'));
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

        return redirect()->route('penjual.profile.edit')->with('status', 'profile-updated');
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
