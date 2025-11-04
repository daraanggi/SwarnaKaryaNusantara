<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produk Berhasil Diapprove</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f4efe9] flex flex-col items-center justify-center min-h-screen font-sans">

  <div class="bg-[#d0c0aa] p-8 rounded-3xl shadow-xl w-3/4 md:w-1/2 text-center">
    <h1 class="text-[#b59d7a] text-3xl font-bold mb-8">Approval Product</h1>

    <div class="bg-white rounded-2xl p-6 shadow-md flex items-center justify-center gap-3 mx-auto w-3/4">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
      </svg>
      <p class="text-lg font-semibold text-black">Produk Berhasil Diapprove</p>
    </div>

    <a href="{{ route('admin.approval') }}" class="mt-10 inline-block bg-[#70675f] text-white font-bold py-2 px-6 rounded-full shadow-md hover:scale-105 transition">
      Kembali
    </a>
  </div>

</body>
</html>