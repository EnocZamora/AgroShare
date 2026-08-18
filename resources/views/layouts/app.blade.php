<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Agroshare')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800 min-h-screen flex flex-col pb-20 md:pb-0">

    <header class="bg-[#1B4D3E] text-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Agroshare" class="h-10 w-auto bg-white p-1 rounded-lg">
                <span class="text-xl font-bold tracking-wide">AGROSHARE</span>
            </div>
            
            <nav class="hidden md:flex items-center gap-6 font-medium text-sm">
                <a href="{{ route('products.index') }}" class="hover:text-emerald-200 transition">Inicio</a>
                <a href="{{ route('products.create') }}" class="hover:text-emerald-200 transition">Publicar</a>
                <a href="{{ route('chats.index') }}" class="hover:text-emerald-200 transition">Mensajes</a>
            </nav>

            <div class="text-xs md:text-sm bg-[#14382c] px-3 py-1.5 rounded-lg border border-emerald-700">
                Matagalpa, Nicaragua
            </div>
        </div>
    </header>

    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6">
        @yield('content')
    </main>

    <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 py-2 px-6 flex justify-around items-center z-50 shadow-lg">
        <a href="{{ route('products.index') }}" class="flex flex-col items-center {{ request()->routeIs('products.index') ? 'text-[#1B4D3E] font-semibold' : 'text-gray-400' }}">
            <span class="text-xs">Inicio</span>
        </a>
        <a href="{{ route('products.create') }}" class="flex flex-col items-center {{ request()->routeIs('products.create') ? 'text-[#1B4D3E] font-semibold' : 'text-gray-400' }}">
            <span class="text-xs">Publicar</span>
        </a>
        <a href="{{ route('chats.index') }}" class="flex flex-col items-center {{ request()->routeIs('chats.*') ? 'text-[#1B4D3E] font-semibold' : 'text-gray-400' }}">
            <span class="text-xs">Mensajes</span>
        </a>
        <a href="#" class="flex flex-col items-center text-gray-400">
            <span class="text-xs">Perfil</span>
        </a>
    </nav>

</body>
</html>