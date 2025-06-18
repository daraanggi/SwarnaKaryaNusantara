<x-guest-layout>
    <div class="bg-cover bg-center min-h-screen" style="background-image: url('/images/background.jpg');">
        <div class="flex min-h-screen items-center justify-center px-6 py-10 lg:px-20">
            <div class="flex flex-col lg:flex-row w-full max-w-6xl bg-white/90 shadow-2xl rounded-2xl overflow-hidden">

                <!-- Kolom Kiri (Logo) -->
                <div class="hidden lg:flex w-1/2 items-center justify-center p-10">
                    <div class="rounded-full bg-white shadow-xl w-72 h-72 flex items-center justify-center">
                        <img src="/images/logo.png" alt="Logo" class="w-56 h-56 object-contain" />
                    </div>
                </div>

                <!-- Kolom Kanan (Form) -->
                <div class="w-full lg:w-1/2 p-10 bg-[#7B5E3C] text-white">
                    <h2 class="text-3xl font-bold text-center mb-8">MASUK AKUN</h2>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4 text-yellow-300" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-4">
                            <label for="email" class="block mb-1">Email :</label>
                            <input
                                id="email"
                                class="w-full px-4 py-3 rounded-full text-black focus:outline-none"
                                type="email"
                                name="email"
                                :value="old('email')"
                                required
                                autofocus
                                autocomplete="username"
                            />
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-200" />
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="block mb-1">Password :</label>
                            <input
                                id="password"
                                class="w-full px-4 py-3 rounded-full text-black focus:outline-none"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                            />
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-200" />
                        </div>

                        <!-- Remember me di bawah password -->
                        <div class="mb-4">
                            <label for="remember_me" class="inline-flex items-center text-white text-sm">
                                <input
                                    id="remember_me"
                                    type="checkbox"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                    name="remember"
                                />
                                <span class="ms-2">Remember me</span>
                            </label>
                        </div>

                        <!-- Baris untuk tombol Masuk dan link Daftar -->
                        <div class="flex justify-between items-center mt-6">
                            <p class="text-white mt-0">
                                Belum punya akun?
                                <a href="{{ route('register') }}" class="text-yellow-300 hover:underline">Daftar</a>
                            </p>

                            <button
                                type="submit"
                                class="bg-white text-[#7B5E3C] font-bold px-6 py-2 rounded-full hover:bg-gray-200"
                            >
                                Masuk
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>
