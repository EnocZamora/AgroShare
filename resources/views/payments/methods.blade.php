@extends('layouts.app')

@section('title', __('messages.payments_title'))

@section('content')
<div class="max-w-md mx-auto space-y-5 pb-24 px-4 pt-2">
    
    <!-- Encabezado -->
    <div class="flex items-center gap-3 bg-white p-4 rounded-2xl shadow-sm border border-emerald-900/10">
        <div class="w-12 h-12 bg-emerald-100 text-[#1B4D3E] rounded-xl flex items-center justify-center shrink-0">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
            </svg>
        </div>
        <div>
            <h1 class="text-xl font-bold text-gray-900 tracking-tight">{{ __('messages.payments_title') }}</h1>
            <p class="text-xs font-bold text-[#1B4D3E]">Gestiona tus métodos de pago</p>
        </div>
    </div>

    <!-- Lista de métodos de pago -->
    <div class="space-y-3">
        @if(count($paymentMethods) > 0)
            @foreach($paymentMethods as $method)
                <div class="bg-white p-4 rounded-2xl shadow-sm border border-emerald-900/10 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-700 shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-gray-900">{{ $method->type }}</h3>
                            <p class="text-xs text-gray-500">{{ $method->details }}</p>
                        </div>
                    </div>
                    @if($method->is_default)
                        <span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-2 py-1 rounded-full">{{ __('messages.payments_default') }}</span>
                    @endif
                </div>
            @endforeach
        @else
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-emerald-900/10 text-center space-y-3">
                <div class="w-16 h-16 bg-emerald-50 rounded-full flex items-center justify-center mx-auto text-emerald-700">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </div>
                <p class="text-gray-500 text-sm">{{ __('messages.payments_empty') }}</p>
                <a href="#" class="inline-flex items-center gap-2 text-sm font-bold text-[#1B4D3E] hover:underline">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    {{ __('messages.payments_add') }}
                </a>
            </div>
        @endif
    </div>

</div>
@endsection