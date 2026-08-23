@extends('layouts.app')

@section('title', 'Panel de Auditor - AgroShare')

@section('content')
<div class="max-w-6xl mx-auto space-y-6 pb-24 px-4 pt-2">
    
    <!-- Encabezado -->
    <div class="bg-[#1B4D3E] text-white p-6 rounded-2xl shadow-sm flex items-center justify-between flex-wrap gap-4">
        <div>
            <h1 class="text-xl font-bold">Panel de Auditor</h1>
            <p class="text-xs text-white/80">Revisión y trazabilidad del sistema - {{ Auth::user()->rol_sistema }}</p>
        </div>
        <div class="bg-white/10 px-3 py-1.5 rounded-xl text-xs font-bold">
            Auditoría Activa
        </div>
    </div>

    <!-- Tarjetas de Estadísticas -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded-2xl border border-emerald-900/10 shadow-sm text-center">
            <p class="text-[11px] text-gray-500 font-medium">Usuarios</p>
            <h3 class="text-2xl font-black text-[#1B4D3E] mt-1">{{ $totalUsers }}</h3>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-emerald-900/10 shadow-sm text-center">
            <p class="text-[11px] text-gray-500 font-medium">Productos</p>
            <h3 class="text-2xl font-black text-[#1B4D3E] mt-1">{{ $totalProducts }}</h3>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-emerald-900/10 shadow-sm text-center">
            <p class="text-[11px] text-gray-500 font-medium">Chats</p>
            <h3 class="text-2xl font-black text-[#1B4D3E] mt-1">{{ $totalChats }}</h3>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-emerald-900/10 shadow-sm text-center">
            <p class="text-[11px] text-gray-500 font-medium">Mensajes</p>
            <h3 class="text-2xl font-black text-[#1B4D3E] mt-1">{{ $totalMessages }}</h3>
        </div>
    </div>

    <!-- Acciones Rápidas -->
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('products.index') }}" class="px-4 py-2 bg-emerald-100 text-emerald-800 rounded-xl text-sm font-medium hover:bg-emerald-200 transition">
            Catálogo Público
        </a>
        <a href="{{ route('chats.index') }}" class="px-4 py-2 bg-blue-100 text-blue-800 rounded-xl text-sm font-medium hover:bg-blue-200 transition">
            Mensajes
        </a>
    </div>

    <!-- Últimos Usuarios Registrados -->
    <div class="bg-white border border-emerald-900/10 rounded-2xl p-5 shadow-sm space-y-4">
        <h2 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Auditoría de Cuentas y Roles</h2>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-gray-200 text-gray-400">
                        <th class="pb-2 font-medium">Usuario</th>
                        <th class="pb-2 font-medium">Correo</th>
                        <th class="pb-2 font-medium">Rol</th>
                        <th class="pb-2 font-medium text-center">Productos</th>
                        <th class="pb-2 font-medium text-right">Registro</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($recentUsers as $u)
                        <tr class="py-2 hover:bg-gray-50">
                            <td class="py-2.5 font-bold text-gray-900">{{ $u->name }}</td>
                            <td class="py-2.5 text-gray-500">{{ $u->email }}</td>
                            <td class="py-2.5">
                                <span class="px-2 py-0.5 rounded-md font-bold text-[10px] 
                                    {{ $u->rol_sistema === 'ADMINISTRADOR' ? 'bg-purple-100 text-purple-700' : ($u->rol_sistema === 'AUDITOR' ? 'bg-blue-100 text-blue-700' : 'bg-emerald-50 text-[#1B4D3E]') }}">
                                    {{ $u->rol_sistema }}
                                </span>
                            </td>
                            <td class="py-2.5 text-center font-bold text-gray-700">{{ $u->products_count }}</td>
                            <td class="py-2.5 text-right text-gray-400">{{ $u->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Productos Recientes para Auditoría -->
    <div class="bg-white border border-emerald-900/10 rounded-2xl p-5 shadow-sm space-y-4">
        <h2 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Auditoría de Publicaciones (Productos)</h2>
        
        <div class="space-y-2">
            @foreach($recentProducts as $p)
                <div class="flex items-center justify-between py-2.5 border-b border-gray-100 last:border-0 text-xs">
                    <div>
                        <p class="font-bold text-gray-900">{{ $p->title }}</p>
                        <p class="text-[11px] text-gray-400">Publicado por: <span class="font-medium text-gray-600">{{ $p->user->name ?? 'Desconocido' }}</span></p>
                    </div>
                    <div class="text-right">
                        <span class="font-bold text-[#1B4D3E]">C$ {{ number_format($p->price, 2) }}</span>
                        <p class="text-[10px] uppercase font-bold 
                            {{ $p->status === 'activo' ? 'text-emerald-600' : ($p->status === 'finalizado' ? 'text-red-600' : 'text-amber-600') }}">
                            {{ $p->status }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection