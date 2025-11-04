<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'no_telepon' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'no_telepon' => $request->no_telepon,  
        'password' => Hash::make($request->password),
        'role' => 'pembeli',  // <-- Tambahkan default role
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('home', absolute: false));
    }

    /**
     * FORM REGISTER PENJUAL
     */
    public function createPenjual(): View
    {
        return view('auth.register-penjual'); // view penjual (baru kamu buat)
    }

    /**
     * SUBMIT REGISTER PENJUAL + UPLOAD KTP
     */
    public function storePenjual(Request $request): RedirectResponse
    {
        $request->validate([
            'name'        => ['required', 'string', 'max:150'],
            'email'       => ['required', 'email', 'max:255', 'unique:users,email'],
            'no_telepon'  => ['required', 'string', 'max:25'],
            'password'    => ['required', 'confirmed', Rules\Password::defaults()],
            // kalau KTP wajib, ganti 'nullable' -> 'required'
            'foto_ktp'    => ['required', 'file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:2048'],
        ]);

    // simpan file (jika ada)
    $ktpPath = null;
    if ($request->hasFile('foto_ktp')) {
        $ktpPath = $request->file('foto_ktp')->store('ktp', 'public'); // storage/app/public/ktp
    }

    $user = User::create([
        'name'       => $request->name,
        'email'      => $request->email,
        'no_telepon' => $request->no_telepon,
        'password'   => Hash::make($request->password),
        'role'       => 'penjual',
        'foto_ktp'   => $ktpPath, // pastikan kolom ini ada & fillable
    ]);

    event(new Registered($user));
    Auth::login($user);

    return redirect()->route('homePagePenjual');
}
}