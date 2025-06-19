<x-guest-layout>
    <div class="bg-cover bg-center min-h-screen" style="background-image: url('/images/background.jpg');">
        <div class="flex min-h-screen items-center justify-center px-6 py-10 lg:px-20">
            <div class="flex flex-col lg:flex-row w-full max-w-6xl bg-white/90 shadow-2xl rounded-2xl overflow-hidden">

                <!-- Kolom Kiri (Logo) -->
                <div class="hidden lg:flex w-1/2 items-center justify-center p-10">
                    <div class="rounded-full bg-white shadow-xl w-72 h-72 flex items-center justify-center">
                        <img src="/images/logo.png" alt="Logo" class="w-56 h-56 object-contain">
                    </div>
                </div>

                <!-- Kolom Kanan (Form) -->
                <div class="w-full lg:w-1/2 p-10 bg-[#7B5E3C] text-white">
                    <h2 class="text-3xl font-bold text-center mb-8">DAFTAR AKUN</h2>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block mb-1">Nama Lengkap :</label>
                            <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus class="w-full px-4 py-3 rounded-full text-black focus:outline-none" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-200" />
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block mb-1">Email :</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required class="w-full px-4 py-3 rounded-full text-black focus:outline-none" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-200" />
                        </div>

                        <div class="mb-4">
                            <label for="no_telepon" class="block mb-1">Nomor Telepon :</label>
                            <input id="no_telepon" name="no_telepon" type="text" value="{{ old('no_telepon') }}" required class="w-full px-4 py-3 rounded-full text-black focus:outline-none" />
                            <x-input-error :messages="$errors->get('no_telepon')" class="mt-2 text-sm text-red-200" />
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block mb-1">Password :</label>
                            <input id="password" name="password" type="password" required class="w-full px-4 py-3 rounded-full text-black focus:outline-none" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-200" />
                        </div>

                        <div class="mb-6">
                            <label for="password_confirmation" class="block mb-1">Konfirmasi Password :</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" required class="w-full px-4 py-3 rounded-full text-black focus:outline-none" />
                        </div>

                        <div class="flex justify-between items-center mt-6">
                            <p class="text-white mt-0">
                                Sudah punya akun? 
                                <a href="{{ route('login') }}" class="text-yellow-300 hover:underline">Login</a>
                            </p>

                        <button type="submit" class="bg-white text-[#7B5E3C] font-bold px-6 py-3 rounded-full hover:bg-gray-200">
                            DAFTAR
                        </button>
                    
                    </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>
