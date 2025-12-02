<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@yield('title', 'Aplikasi')</title>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700&display=swap" rel="stylesheet">

    <!-- CSS build (agar tampil di ngrok tanpa Vite dev server) -->
    <link rel="stylesheet" href="/build/assets/app-DrJG-IPP.css"> 

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="h-full bg-white">
    <div class="flex h-screen overflow-hidden">

        <!-- SIDEBAR -->
        <aside id="sidebar" class="w-64 bg-[#69553E] text-white transition-all duration-300 min-h-screen">

            <div class="flex justify-end px-4 py-2">
                <button id="toggleSidebar">
                    <i class="bi bi-list text-2xl"></i>
                </button>
            </div>

            <div class="flex flex-col items-center py-4">
                <!-- Logo besar -->
                <div id="logoLarge" class="w-36 h-36 rounded-full bg-[#69553E] flex items-center justify-center">
                    <div class="w-28 h-28 bg-white rounded-full flex items-center justify-center">
                        <img src="{{ asset('/images/logo.png') }}" class="w-20 h-20 object-contain">
                    </div>
                </div>

                <!-- Logo kecil -->
                <img id="logoSmall" src="{{ asset('/images/logo.png') }}" 
                     class="w-10 h-10 rounded-full mt-2 hidden">

                <!-- Nama app -->
                <div id="appName" class="text-sm mt-2">Swarna Karya Nusantara</div>
            </div>

            <!-- NAV -->
            <nav class="mt-4 space-y-2">
                <a href="{{ route('home') }}" class="flex items-center gap-4 px-4 py-2 hover:bg-[#5a3e32]">
                    <i class="bi bi-house-door text-xl"></i>
                    <span class="sidebar-text">Beranda</span>
                </a>
                <a href="{{ route('keranjang') }}" class="flex items-center gap-4 px-4 py-2 hover:bg-[#5a3e32]">
                    <i class="bi bi-cart3 text-xl"></i>
                    <span class="sidebar-text">Keranjang</span>
                </a>
                <a href="{{ route('profilePembeli') }}" class="flex items-center gap-4 px-4 py-2 hover:bg-[#5a3e32]">
                    <i class="bi bi-person text-xl"></i>
                    <span class="sidebar-text">Profil</span>
                </a>
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <main id="mainContent" class="flex-1 overflow-y-auto py-6 bg-gray-50 transition-all">
            @yield('content')
        </main>

    </div>

    <!-- SCRIPT -->
    <script>
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const logoLarge = document.getElementById('logoLarge');
        const logoSmall = document.getElementById('logoSmall');
        const appName = document.getElementById('appName');
        const texts = document.querySelectorAll('.sidebar-text');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('w-64');
            sidebar.classList.toggle('w-16');

            logoLarge.classList.toggle('hidden');
            logoSmall.classList.toggle('hidden');
            appName.classList.toggle('hidden');

            texts.forEach(t => t.classList.toggle('hidden'));
        });
    </script>

    @stack('scripts')
</body>
</html>
