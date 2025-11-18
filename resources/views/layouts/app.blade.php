<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Aplikasi')</title>
    @vite('resources/css/app.css')

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="app bg-white h-full">
    <div class="flex h-screen overflow-hidden">
        <aside id="sidebar" class="w-64 bg-[#69553E] text-white transition-all duration-300 ease-in-out min-h-screen">
            <div class="flex justify-end px-4 py-2">
                <button id="toggleSidebar">
                    <i class="bi bi-list text-2xl"></i>
                </button>
            </div>

            <div class="flex flex-col items-center py-4 transition-all duration-300">
                <div id="logoLarge" class="w-36 h-36 rounded-full bg-[#69553E] flex items-center justify-center">
                    <div class="w-28 h-28 bg-white rounded-full flex items-center justify-center">
                        <img src="{{ asset('/images/logo.png') }}" alt="Logo Besar" class="w-20 h-20 object-contain">
                    </div>
                </div>

                <img id="logoSmall" src="{{ asset('/images/logo.png') }}" alt="Logo Kecil" class="w-10 h-10 rounded-full mt-2 hidden">

                <div id="appName" class="text-sm mt-2">Swarna Karya Nusantara</div>
            </div>

            <nav class="mt-4 space-y-2">
                <a href="{{ route('home') }}" class="flex items-center space-x-4 px-4 py-2 hover:bg-[#5a3e32]">
                    <i class="bi bi-house-door text-xl"></i>
                    <span class="sidebar-text">Beranda</span>
                </a>
                <a href="{{ route('keranjang') }}" class="flex items-center space-x-4 px-4 py-2 hover:bg-[#5a3e32]">
                    <i class="bi bi-cart3 text-xl"></i>
                    <span class="sidebar-text">Keranjang</span>
                </a>

                <a href="{{ route('profilePembeli') }}" class="flex items-center space-x-4 px-4 py-2 hover:bg-[#5a3e32]">
                    <i class="bi bi-person text-xl"></i>
                    <span class="sidebar-text">Profil</span>
                </a>
            </nav>
        </aside>

        {{-- KOREKSI UTAMA: Ubah p-6 menjadi py-6 untuk menghilangkan padding horizontal --}}
        <main id="mainContent" class="flex-1 overflow-auto py-6 bg-gray-50 transition-all duration-300 ease-in-out">
            @yield('content')
        </main>

    </div>

    <script>
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const logoLarge = document.getElementById('logoLarge');
        const logoSmall = document.getElementById('logoSmall');
        const appName = document.getElementById('appName');
        const sidebarTexts = document.querySelectorAll('.sidebar-text');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('w-64');
            sidebar.classList.toggle('w-16');

            logoLarge.classList.toggle('hidden');
            logoSmall.classList.toggle('hidden');
            appName.classList.toggle('hidden');

            sidebarTexts.forEach(span => {
                span.classList.toggle('hidden');
            });
        });

    </script>
    @stack('scripts')
</body>

</html>