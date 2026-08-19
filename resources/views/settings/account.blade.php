@extends('layouts.app')

@section('title', 'Agroshare - Acerca de tu cuenta')

@section('content')
<div class="max-w-md mx-auto space-y-5 pb-24 px-4 pt-2 bg-[#EAF5ED] min-h-screen">
    
    <!-- Encabezado superior con botón de retroceso -->
    <div class="flex items-center gap-3 py-2">
        <a href="{{ route('settings.index') }}" class="text-[#1B4D3E] hover:opacity-80">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="text-xl font-bold text-[#1B4D3E] tracking-tight">Acerca de tu cuenta</h1>
    </div>

    <!-- Tarjeta Informativa Superior -->
    <div class="bg-white border border-emerald-900/10 p-3.5 rounded-2xl shadow-sm flex items-center gap-3">
        <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center shrink-0 border border-emerald-700/20 p-1">
            <span class="text-xs font-black text-[#1B4D3E]">🌱</span>
        </div>
        <div>
            <h3 class="text-xs font-bold text-gray-900">Tu cuenta en Agroshare</h3>
            <p class="text-[10px] text-gray-500 leading-tight mt-0.5">
                Esta información es sobre tu cuenta personal y cómo la usamos para brindarte la mejor experiencia en la plataforma.
            </p>
        </div>
    </div>

    <!-- Sección de Información Personal -->
    <div class="bg-white border border-emerald-900/10 rounded-2xl p-4 shadow-sm space-y-3">
        <h2 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Información</h2>
        
        <div class="flex items-center gap-3 py-1 border-b border-gray-100 pb-3">
            <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-200 shrink-0">
                @if(Auth::user()->avatar ?? false)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-[#1B4D3E] text-white flex items-center justify-center font-bold text-sm">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-[11px] text-gray-400 font-medium">Nombre de usuario</p>
                <p class="text-xs font-bold text-gray-900 truncate">{{ Auth::user()->name }}</p>
            </div>
            <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </div>

        <div class="flex items-center justify-between py-1 border-b border-gray-100 pb-2">
            <div>
                <p class="text-[11px] text-gray-400 font-medium">Correo electrónico</p>
                <p class="text-xs font-bold text-gray-900">{{ Auth::user()->email }}</p>
            </div>
            <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </div>

        <div class="flex items-center justify-between py-1 border-b border-gray-100 pb-2">
            <div>
                <p class="text-[11px] text-gray-400 font-medium">Teléfono</p>
                <p class="text-xs font-bold text-gray-900">{{ Auth::user()->phone ?? '+505 88445512' }}</p>
            </div>
            <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </div>

        <div class="flex items-center justify-between py-1 border-b border-gray-100 pb-2">
            <div>
                <p class="text-[11px] text-gray-400 font-medium">Fecha de registro</p>
                <p class="text-xs font-bold text-gray-900">{{ Auth::user()->created_at->format('d/m/Y') }}</p>
            </div>
            <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </div>

        <div class="flex items-center justify-between py-1">
            <div>
                <p class="text-[11px] text-gray-400 font-medium">Tipo de cuenta</p>
                <p class="text-xs font-bold text-gray-900">Productor</p>
            </div>
            <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </div>
    </div>

    <!-- Sección de Información Comercial -->
    <div class="bg-white border border-emerald-900/10 rounded-2xl p-4 shadow-sm space-y-3">
        <h2 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Información comercial</h2>
        
        <div class="flex justify-between items-center py-1 border-b border-gray-100 pb-2 text-xs">
            <span class="text-gray-500">Tipo de cuenta</span>
            <span class="font-bold text-gray-900">Productor</span>
        </div>
        <div class="flex justify-between items-center py-1 border-b border-gray-100 pb-2 text-xs">
            <span class="text-gray-500">Nombre de tu finca o negocio</span>
            <span class="font-bold text-gray-900">Finca las brisas</span>
        </div>
        <div class="flex justify-between items-center py-1 border-b border-gray-100 pb-2 text-xs">
            <span class="text-gray-500">Departamento</span>
            <span class="font-bold text-gray-900">Matagalpa</span>
        </div>
        <div class="flex justify-between items-center py-1 border-b border-gray-100 pb-2 text-xs">
            <span class="text-gray-500">Comunidad</span>
            <span class="font-bold text-gray-900">Ciudad de Matagalpa</span>
        </div>
        <div class="flex justify-between items-center py-1 text-xs">
            <span class="text-gray-500">Productos que ofreces</span>
            <span class="font-bold text-[#1B4D3E]">Café, Frijol, Guabas</span>
        </div>
    </div>

    <!-- Preferencias de la cuenta -->
    <div class="bg-white border border-emerald-900/10 rounded-2xl p-4 shadow-sm space-y-3">
        <h2 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Preferencias de la cuenta</h2>
        
        <div class="flex justify-between items-center py-1 border-b border-gray-100 pb-2 text-xs">
            <span class="text-gray-500">Idioma</span>
            <span class="bg-[#1B4D3E] text-white px-3 py-1 rounded-full font-bold text-[10px]">Español</span>
        </div>
        <div class="flex justify-between items-center py-1 text-xs">
            <span class="text-gray-500">Moneda</span>
            <span class="bg-[#1B4D3E] text-white px-3 py-1 rounded-full font-bold text-[10px]">Córdobas (N$)</span>
        </div>
    </div>

</div>
@endsection