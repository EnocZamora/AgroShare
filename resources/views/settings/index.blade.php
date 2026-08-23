@extends('layouts.app')

@section('title', __('messages.settings_title'))

@section('content')
<div class="max-w-md mx-auto space-y-5 pb-24 px-4 pt-2">
    
    <!-- Encabezado -->
    <div class="flex items-center gap-3 bg-white p-4 rounded-2xl shadow-sm border border-emerald-900/10">
        <div class="w-12 h-12 bg-emerald-100 text-[#1B4D3E] rounded-xl flex items-center justify-center shrink-0">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>
        <div>
            <h1 class="text-xl font-bold text-gray-900 tracking-tight">{{ __('messages.settings_title') }}</h1>
            <p class="text-xs font-bold text-[#1B4D3E]">{{ __('messages.settings_subtitle') }}</p>
        </div>
    </div>

    <!-- Opciones del Menú -->
    <div class="space-y-3">
        
        <!-- Acerca de tu cuenta -->
        <a href="{{ route('settings.account') }}" class="flex items-center justify-between bg-white p-4 rounded-2xl shadow-sm border border-emerald-900/10 hover:border-emerald-700/40 transition">
            <div class="flex items-center gap-3.5">
                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-700 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-gray-900">{{ __('messages.settings_account') }}</h3>
                    <p class="text-[11px] text-gray-500 font-medium">{{ __('messages.settings_account_desc') }}</p>
                </div>
            </div>
            <svg class="w-5 h-5 text-emerald-700 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </a>

        <!-- Idiomas habilitados -->
        <div class="flex items-center justify-between bg-white p-4 rounded-2xl shadow-sm border border-emerald-900/10">
            <div class="flex items-center gap-3.5">
                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-700 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-gray-900">{{ __('messages.settings_languages') }}</h3>
                    <p class="text-[11px] text-gray-500 font-medium">{{ __('messages.settings_languages_desc') }}</p>
                </div>
            </div>
            <svg class="w-5 h-5 text-emerald-700 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </div>

        <!-- Métodos de pago -->
        <div class="flex items-center justify-between bg-white p-4 rounded-2xl shadow-sm border border-emerald-900/10">
            <div class="flex items-center gap-3.5">
                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-700 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-gray-900">{{ __('messages.settings_payments') }}</h3>
                    <p class="text-[11px] text-gray-500 font-medium">{{ __('messages.settings_payments_desc') }}</p>
                </div>
            </div>
            <svg class="w-5 h-5 text-emerald-700 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </div>

        <!-- Centro de ayuda -->
        <div class="flex items-center justify-between bg-white p-4 rounded-2xl shadow-sm border border-emerald-900/10">
            <div class="flex items-center gap-3.5">
                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-700 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-gray-900">{{ __('messages.settings_help') }}</h3>
                    <p class="text-[11px] text-gray-500 font-medium">{{ __('messages.settings_help_desc') }}</p>
                </div>
            </div>
            <svg class="w-5 h-5 text-emerald-700 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </div>

        <!-- Estadísticas -->
        <div class="flex items-center justify-between bg-white p-4 rounded-2xl shadow-sm border border-emerald-900/10">
            <div class="flex items-center gap-3.5">
                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-700 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-gray-900">{{ __('messages.settings_stats') }}</h3>
                    <p class="text-[11px] text-gray-500 font-medium">{{ __('messages.settings_stats_desc') }}</p>
                </div>
            </div>
            <svg class="w-5 h-5 text-emerald-700 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </div>

        <!-- Acerca de Agroshare -->
        <div class="flex items-center justify-between bg-white p-4 rounded-2xl shadow-sm border border-emerald-900/10">
            <div class="flex items-center gap-3.5">
                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-700 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-gray-900">{{ __('messages.settings_about') }}</h3>
                    <p class="text-[11px] text-gray-500 font-medium">{{ __('messages.settings_about_desc') }}</p>
                </div>
            </div>
            <svg class="w-5 h-5 text-emerald-700 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </div>

        <!-- Guía de uso -->
        <div class="flex items-center justify-between bg-white p-4 rounded-2xl shadow-sm border border-emerald-900/10">
            <div class="flex items-center gap-3.5">
                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-700 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-gray-900">{{ __('messages.settings_guide') }}</h3>
                    <p class="text-[11px] text-gray-500 font-medium">{{ __('messages.settings_guide_desc') }}</p>
                </div>
            </div>
            <svg class="w-5 h-5 text-emerald-700 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </div>

        <!-- Botón de Cerrar Sesión -->
        <form action="{{ route('logout') }}" method="POST" class="pt-4">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 bg-red-50 border border-red-200 p-4 rounded-2xl text-red-600 hover:bg-red-100 transition shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                <span class="text-sm font-bold">{{ __('messages.settings_logout') }}</span>
            </button>
        </form>

    </div>
</div>
@endsection