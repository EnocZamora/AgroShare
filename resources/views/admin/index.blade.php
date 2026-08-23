@extends('layouts.app')

@section('title', __('messages.admin_title'))

@section('content')
<div class="max-w-6xl mx-auto space-y-6 pb-24 px-4 pt-2">
    
    <!-- Encabezado -->
    <div class="bg-[#1B4D3E] text-white p-6 rounded-2xl shadow-sm flex items-center justify-between flex-wrap gap-4">
        <div>
            <h1 class="text-xl font-bold">{{ __('messages.admin_title') }}</h1>
            <p class="text-xs text-white/80">{{ __('messages.admin_current_role', ['role' => Auth::user()->rol_sistema]) }}</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="bg-white/10 px-3 py-1.5 rounded-xl text-xs font-bold">
                {{ __('messages.admin_audit_active') }}
            </div>
            <a href="{{ route('admin.audit') }}" class="bg-white/20 hover:bg-white/30 px-3 py-1.5 rounded-xl text-xs font-bold transition">
                {{ __('messages.admin_audit_link') }}
            </a>
        </div>
    </div>

    <!-- Tarjetas de Estadísticas -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded-2xl border border-emerald-900/10 shadow-sm text-center">
            <p class="text-[11px] text-gray-500 font-medium">{{ __('messages.admin_stats_users') }}</p>
            <h3 class="text-2xl font-black text-[#1B4D3E] mt-1">{{ $totalUsers }}</h3>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-emerald-900/10 shadow-sm text-center">
            <p class="text-[11px] text-gray-500 font-medium">{{ __('messages.admin_stats_products') }}</p>
            <h3 class="text-2xl font-black text-[#1B4D3E] mt-1">{{ $totalProducts }}</h3>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-emerald-900/10 shadow-sm text-center">
            <p class="text-[11px] text-gray-500 font-medium">{{ __('messages.admin_stats_active_products') }}</p>
            <h3 class="text-2xl font-black text-emerald-600 mt-1">{{ $activeProducts }}</h3>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-emerald-900/10 shadow-sm text-center">
            <p class="text-[11px] text-gray-500 font-medium">{{ __('messages.admin_stats_pending_products') }}</p>
            <h3 class="text-2xl font-black text-amber-600 mt-1">{{ $pendingProducts }}</h3>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-emerald-900/10 shadow-sm text-center md:col-span-2">
            <p class="text-[11px] text-gray-500 font-medium">{{ __('messages.admin_stats_chats') }}</p>
            <h3 class="text-2xl font-black text-[#1B4D3E] mt-1">{{ $totalChats }}</h3>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-emerald-900/10 shadow-sm text-center md:col-span-2">
            <p class="text-[11px] text-gray-500 font-medium">{{ __('messages.admin_stats_messages') }}</p>
            <h3 class="text-2xl font-black text-[#1B4D3E] mt-1">{{ $totalMessages }}</h3>
        </div>
    </div>

    <!-- Acciones Rápidas -->
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('products.create') }}" class="px-4 py-2 bg-emerald-100 text-emerald-800 rounded-xl text-sm font-medium hover:bg-emerald-200 transition">
            {{ __('messages.nav_publish') }}
        </a>
        <a href="{{ route('chats.index') }}" class="px-4 py-2 bg-blue-100 text-blue-800 rounded-xl text-sm font-medium hover:bg-blue-200 transition">
            {{ __('messages.messages') }}
        </a>
        <a href="{{ route('admin.audit') }}" class="px-4 py-2 bg-purple-100 text-purple-800 rounded-xl text-sm font-medium hover:bg-purple-200 transition">
            {{ __('messages.admin_audit_link') }}
        </a>
    </div>

    <!-- Últimos Usuarios Registrados -->
    <div class="bg-white border border-emerald-900/10 rounded-2xl p-4 shadow-sm space-y-3">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('messages.admin_recent_users') }}</h2>
            <a href="{{ route('admin.audit') }}" class="text-xs text-emerald-700 font-medium hover:underline">{{ __('messages.view_all') }}</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-gray-200 text-gray-400">
                        <th class="pb-2 font-medium">{{ __('messages.admin_user_name') }}</th>
                        <th class="pb-2 font-medium">{{ __('messages.admin_user_email') }}</th>
                        <th class="pb-2 font-medium">{{ __('messages.admin_user_role') }}</th>
                        <th class="pb-2 font-medium text-center">{{ __('messages.admin_user_products') }}</th>
                        <th class="pb-2 font-medium text-right">{{ __('messages.admin_user_registered') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($recentUsers as $user)
                        <tr class="py-2 hover:bg-gray-50">
                            <td class="py-2.5 font-bold text-gray-900">{{ $user->name }}</td>
                            <td class="py-2.5 text-gray-500">{{ $user->email }}</td>
                            <td class="py-2.5">
                                <span class="px-2 py-0.5 rounded-md font-bold text-[10px] 
                                    {{ $user->rol_sistema === 'ADMINISTRADOR' ? 'bg-purple-100 text-purple-700' : ($user->rol_sistema === 'AUDITOR' ? 'bg-blue-100 text-blue-700' : 'bg-emerald-50 text-[#1B4D3E]') }}">
                                    {{ $user->rol_sistema }}
                                </span>
                            </td>
                            <td class="py-2.5 text-center font-bold text-gray-700">{{ $user->products_count }}</td>
                            <td class="py-2.5 text-right text-gray-400">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Productos Recientes -->
    <div class="bg-white border border-emerald-900/10 rounded-2xl p-4 shadow-sm space-y-3">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('messages.admin_recent_products') }}</h2>
            <a href="{{ route('admin.audit', ['tab' => 'products']) }}" class="text-xs text-emerald-700 font-medium hover:underline">{{ __('messages.view_all') }}</a>
        </div>
        <div class="space-y-2">
            @foreach($recentProducts as $product)
                <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0 text-xs">
                    <div class="flex items-center gap-3 min-w-0 flex-1">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="w-10 h-10 object-cover rounded-lg shrink-0">
                        @else
                            <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center text-emerald-700 font-bold text-xs shrink-0">
                                {{ strtoupper(substr($product->title, 0, 1)) }}
                            </div>
                        @endif
                        <div class="min-w-0">
                            <p class="font-bold text-gray-900 truncate">{{ $product->title }}</p>
                            <p class="text-[11px] text-gray-400 truncate">{{ $product->user->name ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="text-right shrink-0">
                        <span class="font-bold text-[#1B4D3E]">C$ {{ number_format($product->price, 2) }}</span>
                        <p class="text-[10px] uppercase font-bold 
                            {{ $product->status === 'activo' ? 'text-emerald-600' : ($product->status === 'finalizado' ? 'text-red-600' : 'text-amber-600') }}">
                            {{ $product->status }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
