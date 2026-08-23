@extends('layouts.app')

@section('title', __('messages.admin_audit_title'))

@section('content')
<div class="max-w-4xl mx-auto space-y-6 pb-24 px-4 pt-2">
    
    <!-- Encabezado de Auditoría -->
    <div class="bg-[#1B4D3E] text-white p-6 rounded-2xl shadow-sm flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold">{{ __('messages.admin_audit_title') }}</h1>
            <p class="text-xs text-white/80">{{ __('messages.admin_audit_subtitle') }}</p>
        </div>
        <a href="{{ route('admin.index') }}" class="bg-white/10 hover:bg-white/20 px-3 py-1.5 rounded-xl text-xs font-bold transition">
            {{ __('messages.admin_back_to_dashboard') }}
        </a>
    </div>

    <!-- Sección de Revisión de Usuarios -->
    <div class="bg-white border border-emerald-900/10 rounded-2xl p-5 shadow-sm space-y-4">
        <h2 class="text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('messages.admin_audit_accounts') }}</h2>
        
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
                    @foreach($users as $u)
                        <tr class="py-2">
                            <td class="py-2.5 font-bold text-gray-900">{{ $u->name }}</td>
                            <td class="py-2.5 text-gray-500">{{ $u->email }}</td>
                            <td class="py-2.5">
                                <span class="px-2 py-0.5 rounded-md font-bold text-[10px] 
                                    {{ $u->role === 'admin' ? 'bg-purple-100 text-purple-700' : ($u->role === 'auditor' ? 'bg-blue-100 text-blue-700' : 'bg-emerald-50 text-[#1B4D3E]') }}">
                                    {{ strtoupper($u->role) }}
                                </span>
                            </td>
                            <td class="py-2.5 text-center font-bold text-gray-700">{{ $u->products_count }}</td>
                            <td class="py-2.5 text-right text-gray-400">{{ $u->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Sección de Revisión de Inventario / Productos -->
    <div class="bg-white border border-emerald-900/10 rounded-2xl p-5 shadow-sm space-y-4">
        <h2 class="text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('messages.admin_audit_products') }}</h2>
        
        <div class="space-y-2">
            @foreach($products as $p)
                <div class="flex items-center justify-between py-2.5 border-b border-gray-100 last:border-0 text-xs">
                    <div>
                        <p class="font-bold text-gray-900">{{ $p->title }}</p>
                        <p class="text-[11px] text-gray-400">{{ __('messages.admin_product_published_by', ['name' => $p->user->name ?? 'Desconocido']) }}</p>
                    </div>
                    <div class="text-right">
                        <span class="font-bold text-[#1B4D3E]">{{ __('messages.admin_product_price', ['price' => number_format($p->price, 2)]) }}</span>
                        <p class="text-[10px] uppercase font-bold text-gray-400">{{ $p->status }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection