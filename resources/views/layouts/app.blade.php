<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Agroshare')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col pb-16 md:pb-0">

    <!-- Header Global (Solo Desktop) -->
    <header class="bg-[#1B4D3E] text-white shadow-sm sticky top-0 z-50 hidden md:block">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Agroshare" class="h-10 w-auto bg-white p-1 rounded-lg object-contain">
                <span class="text-xl font-bold tracking-wide">AGROSHARE</span>
            </div>
            
            <nav class="flex items-center gap-8 font-medium text-sm">
                <a href="{{ route('products.index') }}" class="hover:text-emerald-200 transition {{ request()->routeIs('products.index') ? 'text-emerald-300' : '' }}">Inicio</a>
                <a href="{{ route('products.create') }}" class="hover:text-emerald-200 transition {{ request()->routeIs('products.create') ? 'text-emerald-300' : '' }}">Publicar</a>
                <a href="{{ route('chats.index') }}" class="hover:text-emerald-200 transition {{ request()->routeIs('chats.*') ? 'text-emerald-300' : '' }}">Mensajes</a>
            </nav>
        </div>
    </header>

    <!-- Contenedor Principal MVC -->
    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        @yield('content')
    </main>

    <!-- Navegación Inferior Móvil -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 py-2 px-4 flex justify-between items-center z-50 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]">
        <a href="{{ route('products.index') }}" class="flex-1 flex flex-col items-center gap-1 {{ request()->routeIs('products.index') ? 'text-[#1B4D3E] font-bold' : 'text-gray-500 hover:text-gray-700' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            <span class="text-[10px]">Inicio</span>
        </a>
        <a href="{{ route('products.create') }}" class="flex-1 flex flex-col items-center gap-1 {{ request()->routeIs('products.create') ? 'text-[#1B4D3E] font-bold' : 'text-gray-500 hover:text-gray-700' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            <span class="text-[10px]">Publicar</span>
        </a>
        <a href="{{ route('chats.index') }}" class="flex-1 flex flex-col items-center gap-1 {{ request()->routeIs('chats.*') ? 'text-[#1B4D3E] font-bold' : 'text-gray-500 hover:text-gray-700' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
            <span class="text-[10px]">Mensajes</span>
        </a>
        <a href="{{ route('profile.show') }}" class="flex-1 flex flex-col items-center gap-1 text-gray-500 hover:text-gray-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            <span class="text-[10px]">Perfil</span>
        </a>
    </nav>

</body>
</html>