<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi')</title>

    <!-- CSS Build (untuk ngrok & hosting) -->
    <link rel="stylesheet" href="/build/assets/app-DrJG-IPP.css"> 

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .product-image {
        width: 100%;
        height: auto;
        object-fit: contain;
        border-radius: 8px;
        }
    </style>
</head>

<body class="app bg-white h-full">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-[#69553E] text-white transition-all duration-300 ease-in-out min-h-screen">
            <div class="flex justify-end px-4 py-2">
                <button id="toggleSidebar">
                    <i class="bi bi-list text-2xl"></i>
                </button>
            </div>

            <!-- Logo -->
            <div class="flex flex-col items-center py-4 transition-all duration-300">
                <div id="logoLarge" class="w-36 h-36 rounded-full bg-[#69553E] flex items-center justify-center">
                    <div class="w-28 h-28 bg-white rounded-full flex items-center justify-center">
                        <img src="{{ asset('/images/logo.png') }}" alt="Logo Besar" class="w-20 h-20 object-contain">
                    </div>
                </div>
                <img id="logoSmall" src="{{ asset('/images/logo.png') }}" alt="Logo Kecil" class="w-10 h-10 rounded-full mt-2 hidden">
                <div id="appName" class="text-sm mt-2">Swarna Karya</div>
            </div>

            <!-- Navigasi -->
            <nav class="mt-4 space-y-2">
                <!-- Menu Home Page -->
                <a href="{{ route('homePagePenjual') }}" class="flex items-center space-x-4 px-4 py-2 hover:bg-[#5a3e32]">
                    <i class="bi bi-house-door text-xl"></i>
                    <span class="sidebar-text">Beranda</span>
                </a>
                
                <a href="{{ route('manageProduct') }}" class="flex items-center space-x-4 px-4 py-2 hover:bg-[#5a3e32]">
                    <i class="bi bi-box-seam text-xl"></i>
                    <span class="sidebar-text">Kelola Produk</span>
                </a>
               <a href="{{ route('showTransactionDetail') }}" class="flex items-center space-x-4 px-4 py-2 hover:bg-[#5a3e32]">
                    <i class="bi bi-receipt text-xl"></i>
                    <span class="sidebar-text">Laporan Transaksi</span>
                </a>

                <!-- Menu Profile -->
                <a href="{{ route('penjual.profile.edit') }}" class="flex items-center space-x-4 px-4 py-2 hover:bg-[#5a3e32]">
                    <i class="bi bi-person-circle text-xl"></i>
                    <span class="sidebar-text">Profil</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main id="mainContent" class="flex-1 overflow-auto p-6 bg-gray-50 transition-all duration-300 ease-in-out">
            @yield('content')
        </main>
    </div>

    <!-- Script Toggle -->
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
</body>

</html>
