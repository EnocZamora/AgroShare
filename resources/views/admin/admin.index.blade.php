@extends('layouts.app')

@section('title', 'Agroshare - Panel de Administración y Auditoría')

@section('content')
<div class="max-w-4xl mx-auto space-y-6 pb-24 px-4 pt-2">
    
    <!-- Encabezado -->
    <div class="bg-[#1B4D3E] text-white p-6 rounded-2xl shadow-sm flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold">Panel de Control</h1>
            <p class="text-xs text-white/80">Rol actual: <span class="uppercase font-bold tracking-wider">{{ Auth::user()->role }}</span></p>
        </div>
        <div class="bg-white/10 px-3 py-1.5 rounded-xl text-xs font-bold">
            Auditoría Activa 🛡️
        </div>
    </div>

    <!-- Tarjetas de Estadísticas -->
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded-2xl border border-emerald-900/10 shadow-sm text-center">
            <p class="text-[11px] text-gray-500 font-medium">Usuarios</p>
            <h3 class="text-xl font-black text-[#1B4D3E] mt-1">{{ $totalUsers }}</h3>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-emerald-900/10 shadow-sm text-center">
            <p class="text-[11px] text-gray-500 font-medium">Productos</p>
            <h3 class="text-xl font-black text-[#1B4D3E] mt-1">{{ $totalProducts }}</h3>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-emerald-900/10 shadow-sm text-center">
            <p class="text-[11px] text-gray-500 font-medium">Chats</p>
            <h3 class="text-xl font-black text-[#1B4D3E] mt-1">{{ $totalChats }}</h3>
        </div>
    </div>

    <!-- Últimos Registros (Auditoría) -->
    <div class="bg-white border border-emerald-900/10 rounded-2xl p-4 shadow-sm space-y-3">
        <h2 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Últimos usuarios registrados</h2>
        <div class="space-y-2">
            @foreach($recentUsers as $user)
                <div class="flex justify-between items-center text-xs py-2 border-b border-gray-100 last:border-0">
                    <span class="font-bold text-gray-900">{{ $user->name }}</span>
                    <span class="text-gray-400">{{ $user->email }}</span>
                    <span class="bg-emerald-50 text-[#1B4D3E] px-2 py-0.5 rounded-md font-bold text-[10px]">{{ $user->role }}</span>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection