@extends('layouts.app')

@section('title', 'Agroshare - Panel de Auditoría y Administración')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    
    <!-- Encabezado -->
    <div class="bg-white p-6 rounded-xl border border-emerald-700/30 shadow-sm flex justify-between items-center">
        <div>
            <h2 class="text-xl font-bold text-[#1B4D3E]">Panel de Control y Auditoría</h2>
            <p class="text-xs text-gray-500 mt-1">Monitoreo general de la actividad en Agroshare (Rol: {{ ucfirst(Auth::user()->role) }}).</p>
        </div>
    </div>

    <!-- Tarjetas de Estadísticas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white p-5 rounded-xl border border-emerald-700/30 shadow-sm">
            <p class="text-xs text-gray-500 font-medium">Usuarios Registrados</p>
            <h3 class="text-2xl font-extrabold text-[#1B4D3E] mt-1">{{ $totalUsers }}</h3>
        </div>
        <div class="bg-white p-5 rounded-xl border border-emerald-700/30 shadow-sm">
            <p class="text-xs text-gray-500 font-medium">Productos Publicados</p>
            <h3 class="text-2xl font-extrabold text-[#1B4D3E] mt-1">{{ $totalProducts }}</h3>
        </div>
        <div class="bg-white p-5 rounded-xl border border-emerald-700/30 shadow-sm">
            <p class="text-xs text-gray-500 font-medium">Conversaciones / Chats</p>
            <h3 class="text-2xl font-extrabold text-[#1B4D3E] mt-1">{{ $totalChats }}</h3>
        </div>
    </div>

    <!-- Tablas de Actividad Reciente -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <!-- Últimos Usuarios -->
        <div class="bg-white rounded-xl border border-emerald-700/30 shadow-sm overflow-hidden">
            <div class="p-4 border-b border-gray-100 bg-emerald-50/50">
                <h4 class="text-xs font-bold text-[#1B4D3E] uppercase tracking-wider">Últimos Registros de Usuarios</h4>
            </div>
            <div class="divide-y divide-gray-100">
                @foreach($recentUsers as $user)
                    <div class="p-4 flex justify-between items-center text-xs">
                        <div>
                            <p class="font-bold text-gray-900">{{ $user->name }}</p>
                            <p class="text-gray-400">{{ $user->email }}</p>
                        </div>
                        <span class="px-2 py-1 bg-emerald-100 text-[#1B4D3E] rounded-full font-semibold">
                            {{ $user->role }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Últimos Productos -->
        <div class="bg-white rounded-xl border border-emerald-700/30 shadow-sm overflow-hidden">
            <div class="p-4 border-b border-gray-100 bg-emerald-50/50">
                <h4 class="text-xs font-bold text-[#1B4D3E] uppercase tracking-wider">Últimos Productos en Auditoría</h4>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($recentProducts as $product)
                    <div class="p-4 flex justify-between items-center text-xs">
                        <div>
                            <p class="font-bold text-gray-900">{{ $product->title }}</p>
                            <p class="text-gray-400">Por: {{ $product->user->name ?? 'N/D' }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-[#1B4D3E]">${{ number_format($product->price, 2) }}</p>
                            <p class="text-[10px] text-gray-400">{{ $product->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-gray-400">No hay productos recientes.</div>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection