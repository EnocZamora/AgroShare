@extends('layouts.app')

@section('title', 'Agroshare - Inicio')

@section('content')
<div class="container mx-auto px-4 py-4 max-w-5xl space-y-6 md:space-y-8">
    
    <!-- 1. Cabecera Específica para Móvil (Oculta en escritorio) -->
    <div class="flex justify-between items-center md:hidden">
        <!-- Logo Agroshare Local -->
        <div class="w-16 shrink-0">
            <img src="{{ asset('images/logo.png') }}" alt="Agroshare Logo" class="w-full h-auto object-contain">
        </div>
        
        <!-- Ubicación y Perfil Móvil -->
        <a href="{{ route('profile.show') }}" class="flex flex-col items-end gap-1">
            <span class="flex items-center gap-1 text-[10px] font-bold text-gray-800">
                <svg class="w-3 h-3 text-[#1B4D3E]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                {{ Auth::user()->department ?? 'Matagalpa' }}, Nicaragua
            </span>
            <div class="w-10 h-10 rounded-full overflow-hidden border border-emerald-600 bg-emerald-100 flex items-center justify-center shrink-0">
                @if(Auth::user()->profile_photo)
                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                @else
                    <span class="text-xs font-bold text-emerald-800">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</span>
                @endif
            </div>
        </a>
    </div>

    <!-- Bienvenida exclusiva para Escritorio -->
    <div class="hidden md:flex justify-between items-center bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-full overflow-hidden border-2 border-emerald-600 bg-emerald-100 flex items-center justify-center shrink-0">
                @if(Auth::user()->profile_photo)
                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                @else
                    <span class="text-lg font-bold text-emerald-800">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</span>
                @endif
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#1B4D3E]">¡Bienvenido, {{ Auth::user()->name }}!</h1>
                <p class="text-sm text-gray-600 mt-0.5">Conectando directamente el campo nicaragüense con nuevos compradores.</p>
            </div>
        </div>
        <div class="flex items-center gap-3 bg-gray-50 border border-gray-200 px-4 py-2.5 rounded-xl">
            <svg class="w-5 h-5 text-[#1B4D3E]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
            <span class="text-sm font-bold text-gray-800">{{ Auth::user()->department ?? 'Matagalpa' }}, Nicaragua</span>
        </div>
    </div>

    <!-- 2. Barra de Accesos Rápidos -->
    <div class="grid grid-cols-3 gap-3 md:gap-4 max-w-2xl mx-auto">
        <a href="{{ route('products.my-products') }}" class="border border-gray-200 hover:border-[#1B4D3E] rounded-xl p-3 flex flex-col items-center justify-center text-center shadow-sm transition bg-white group">
            <div class="w-10 h-10 md:w-12 md:h-12 border border-gray-200 group-hover:border-[#1B4D3E] flex items-center justify-center text-gray-700 group-hover:text-[#1B4D3E] mb-2 rounded-lg transition">
                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            </div>
            <span class="text-[10px] md:text-xs font-semibold text-gray-700 leading-tight">Mis<br>publicaciones</span>
        </a>
        
        <a href="{{ route('settings.index') }}" class="border border-gray-200 hover:border-[#1B4D3E] rounded-xl p-3 flex flex-col items-center justify-center text-center shadow-sm transition bg-white group">
            <div class="w-10 h-10 md:w-12 md:h-12 border border-gray-200 group-hover:border-[#1B4D3E] flex items-center justify-center text-gray-700 group-hover:text-[#1B4D3E] mb-2 rounded-lg transition">
                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <span class="text-[10px] md:text-xs font-semibold text-gray-700 leading-tight">Configuración</span>
        </a>

        <a href="{{ route('chats.index') }}" class="border border-gray-200 hover:border-[#1B4D3E] rounded-xl p-3 flex flex-col items-center justify-center text-center shadow-sm transition bg-white group">
            <div class="w-10 h-10 md:w-12 md:h-12 border border-gray-200 group-hover:border-[#1B4D3E] flex items-center justify-center text-gray-700 group-hover:text-[#1B4D3E] mb-2 rounded-lg transition">
                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
            </div>
            <span class="text-[10px] md:text-xs font-semibold text-gray-700 leading-tight">Mensajes</span>
        </a>
    </div>

    <!-- 3. Banner Institucional -->
    <div class="relative rounded-xl overflow-hidden bg-[#1B4D3E] text-white flex items-center h-28 md:h-36 shadow-sm">
        <div class="z-10 w-3/5 p-4 md:p-8">
            <h2 class="text-[13px] md:text-xl font-bold leading-tight">Conecta con productores agrícolas de Nicaragua</h2>
        </div>
        <div class="absolute right-0 top-0 bottom-0 w-1/2">
            <img src="https://images.unsplash.com/photo-1595974482597-4b8cb8fc9cc9?w=800&fit=crop" alt="Agricultores" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-[#1B4D3E] to-transparent"></div>
        </div>
    </div>

    <!-- 4. Categorías destacadas -->
    <section>
        <h3 class="font-bold text-xs md:text-base text-gray-900 mb-3 md:mb-4">Categorías destacadas de Agroshare</h3>
        <div class="grid grid-cols-4 md:flex md:justify-center gap-2 md:gap-6">
            <div class="flex flex-col items-center border border-gray-200 rounded-xl p-2 md:p-4 bg-white shadow-sm hover:border-[#1B4D3E] transition md:w-32">
                <img src="https://cdn-icons-png.flaticon.com/512/3137/3137044.png" alt="Frutas" class="w-8 h-8 md:w-12 md:h-12 object-contain mb-1 md:mb-2">
                <span class="text-[9px] md:text-xs font-semibold text-gray-800 text-center">Frutas</span>
            </div>
            <div class="flex flex-col items-center border border-gray-200 rounded-xl p-2 md:p-4 bg-white shadow-sm hover:border-[#1B4D3E] transition md:w-32">
                <img src="https://cdn-icons-png.flaticon.com/512/924/924514.png" alt="Café" class="w-8 h-8 md:w-12 md:h-12 object-contain mb-1 md:mb-2">
                <span class="text-[9px] md:text-xs font-semibold text-gray-800 text-center leading-tight">Café y cacao</span>
            </div>
            <div class="flex flex-col items-center border border-gray-200 rounded-xl p-2 md:p-4 bg-white shadow-sm hover:border-[#1B4D3E] transition md:w-32">
                <img src="https://cdn-icons-png.flaticon.com/512/3137/3137020.png" alt="Granos" class="w-8 h-8 md:w-12 md:h-12 object-contain mb-1 md:mb-2">
                <span class="text-[9px] md:text-xs font-semibold text-gray-800 text-center leading-tight">Granos y semillas</span>
            </div>
            <div class="flex flex-col items-center border border-gray-200 rounded-xl p-2 md:p-4 bg-white shadow-sm hover:border-[#1B4D3E] transition md:w-32">
                <img src="https://cdn-icons-png.flaticon.com/512/1065/1065546.png" alt="Aves" class="w-8 h-8 md:w-12 md:h-12 object-contain mb-1 md:mb-2">
                <span class="text-[9px] md:text-xs font-semibold text-gray-800 text-center leading-tight">Aves de corral</span>
            </div>
        </div>
    </section>

    <!-- 5. Productos destacados -->
    <section>
        <h3 class="font-bold text-xs md:text-base text-gray-900 mb-3 md:mb-4">Productos destacados</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-6">
            @forelse($products as $product)
                <a href="{{ route('products.show', $product) }}" class="bg-white rounded-xl border border-gray-200 overflow-hidden flex flex-col hover:shadow-md transition">
                    <div class="h-28 md:h-40 bg-gray-100 w-full relative">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">Sin imagen</div>
                        @endif
                    </div>
                    <div class="p-2.5 md:p-4">
                        <h4 class="font-bold text-[11px] md:text-sm text-gray-900 truncate">{{ $product->title }}</h4>
                        <p class="text-[9px] md:text-xs text-gray-500 mt-0.5 truncate">{{ $product->category->name ?? 'General' }}</p>
                        <div class="mt-1.5 text-[#1B4D3E] font-bold text-[11px] md:text-sm">
                            C$ {{ number_format($product->price, 2) }}
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full py-6 text-center text-xs md:text-sm text-gray-500 border border-dashed border-gray-300 rounded-xl">
                    No hay productos disponibles.
                </div>
            @endforelse
        </div>
    </section>

    <!-- 6. Llamado a la acción -->
    <div class="border border-[#1B4D3E]/30 rounded-xl p-4 md:p-6 flex justify-between items-center bg-white shadow-sm gap-2">
        <div class="w-2/3 md:w-3/4">
            <h4 class="font-bold text-[11px] md:text-lg text-[#1B4D3E]">¿Eres productor?</h4>
            <p class="text-[9px] md:text-sm text-gray-600 mt-0.5 leading-tight">Publica tus productos y llega a más compradores en todo el país.</p>
        </div>
        <a href="{{ route('products.create') }}" class="bg-[#1B4D3E] text-white text-[10px] md:text-sm font-bold px-3 py-2 md:px-6 md:py-2.5 rounded-lg text-center shrink-0 hover:bg-[#14382c] transition">
            Publica ahora
        </a>
    </div>

    <!-- 7. Zonas productivas -->
    <section>
        <div class="flex justify-between items-center mb-3 md:mb-4">
            <h3 class="font-bold text-xs md:text-base text-gray-900">Zonas productivas de Nicaragua</h3>
            <span class="text-[10px] md:text-xs text-[#1B4D3E] font-bold">Desliza para ver más &rarr;</span>
        </div>
        <div class="flex gap-3 overflow-x-auto pb-3 scrollbar-none snap-x">
            <div class="relative rounded-xl overflow-hidden shrink-0 w-28 h-32 md:w-36 md:h-40 shadow-sm border border-gray-200 snap-start group">
                <img src="https://images.unsplash.com/photo-1516253593875-bd7ba052fbc5?w=400&fit=crop" alt="Matagalpa" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent p-2 text-center">
                    <span class="text-[11px] md:text-xs font-bold text-white drop-shadow">Matagalpa</span>
                </div>
            </div>
            <div class="relative rounded-xl overflow-hidden shrink-0 w-28 h-32 md:w-36 md:h-40 shadow-sm border border-gray-200 snap-start group">
                <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=400&fit=crop" alt="Jinotega" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent p-2 text-center">
                    <span class="text-[11px] md:text-xs font-bold text-white drop-shadow">Jinotega</span>
                </div>
            </div>
            <div class="relative rounded-xl overflow-hidden shrink-0 w-28 h-32 md:w-36 md:h-40 shadow-sm border border-gray-200 snap-start group">
                <img src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?w=400&fit=crop" alt="Estelí" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent p-2 text-center">
                    <span class="text-[11px] md:text-xs font-bold text-white drop-shadow">Estelí</span>
                </div>
            </div>
            <div class="relative rounded-xl overflow-hidden shrink-0 w-28 h-32 md:w-36 md:h-40 shadow-sm border border-gray-200 snap-start group">
                <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=400&fit=crop" alt="Masaya" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent p-2 text-center">
                    <span class="text-[11px] md:text-xs font-bold text-white drop-shadow">Masaya</span>
                </div>
            </div>
            <div class="relative rounded-xl overflow-hidden shrink-0 w-28 h-32 md:w-36 md:h-40 shadow-sm border border-gray-200 snap-start group">
                <img src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=400&fit=crop" alt="Rivas" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent p-2 text-center">
                    <span class="text-[11px] md:text-xs font-bold text-white drop-shadow">Rivas</span>
                </div>
            </div>
            <div class="relative rounded-xl overflow-hidden shrink-0 w-28 h-32 md:w-36 md:h-40 shadow-sm border border-gray-200 snap-start group">
                <img src="https://images.unsplash.com/photo-1513836279014-a89f7a76ae86?w=400&fit=crop" alt="Boaco" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent p-2 text-center">
                    <span class="text-[11px] md:text-xs font-bold text-white drop-shadow">Boaco</span>
                </div>
            </div>
            <div class="relative rounded-xl overflow-hidden shrink-0 w-28 h-32 md:w-36 md:h-40 shadow-sm border border-gray-200 snap-start group">
                <img src="https://images.unsplash.com/photo-1444084316824-dc26d6657664?w=400&fit=crop" alt="Bluefields" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent p-2 text-center">
                    <span class="text-[11px] md:text-xs font-bold text-white drop-shadow">Bluefields</span>
                </div>
            </div>
            <div class="relative rounded-xl overflow-hidden shrink-0 w-28 h-32 md:w-36 md:h-40 shadow-sm border border-gray-200 snap-start group">
                <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=400&fit=crop" alt="León" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent p-2 text-center">
                    <span class="text-[11px] md:text-xs font-bold text-white drop-shadow">León</span>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. Banner Informativo de Idiomas Disponibles (Actualizado con Enlaces Interactivos) -->
    <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-4 md:p-5 flex flex-col md:flex-row items-center justify-between gap-4 shadow-sm">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0 shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
            </div>
            <div>
                <h4 class="text-xs md:text-sm font-bold text-emerald-900">Plataforma Multilingüe Adaptada a tu Región</h4>
                <p class="text-[11px] md:text-xs text-emerald-700 mt-0.5">Haz clic para cambiar el idioma de la plataforma:</p>
            </div>
        </div>
        <div class="flex items-center gap-2 shrink-0 flex-wrap justify-center">
            <a href="{{ route('lang.switch', 'es') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white border {{ session('locale', 'es') == 'es' ? 'border-emerald-600 ring-2 ring-emerald-500/20' : 'border-emerald-200' }} text-emerald-800 text-[11px] font-bold shadow-xs hover:bg-emerald-100 transition">
                🇪🇸 Español
            </a>
            <a href="{{ route('lang.switch', 'mi') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white border {{ session('locale') == 'mi' ? 'border-emerald-600 ring-2 ring-emerald-500/20' : 'border-emerald-200' }} text-emerald-800 text-[11px] font-bold shadow-xs hover:bg-emerald-100 transition">
                🌿 Miskito
            </a>
            <a href="{{ route('lang.switch', 'cr') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white border {{ session('locale') == 'cr' ? 'border-emerald-600 ring-2 ring-emerald-500/20' : 'border-emerald-200' }} text-emerald-800 text-[11px] font-bold shadow-xs hover:bg-emerald-100 transition">
                🌊 Creole
            </a>
        </div>
    </div>

</div>
@endsection