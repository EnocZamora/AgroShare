@extends('layouts.app')

@section('title', __('messages.chats_title'))

@section('content')
<div class="max-w-md mx-auto space-y-6 pb-20">
    
    <!-- Encabezado Superior -->
    <div class="bg-[#1B4D3E] text-white py-4 px-6 rounded-2xl shadow-sm flex items-center justify-between">
        <a href="{{ route('products.index') }}" class="text-xs font-bold text-white/90 hover:underline flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            {{ __('messages.back') }}
        </a>
        <h2 class="text-base font-bold tracking-wide">{{ __('messages.chats_title') }}</h2>
        <div class="w-10"></div>
    </div>

    <!-- Pestañas de Estado -->
    @php
        $tab = request('tab', 'todos');
    @endphp
    <div class="flex justify-around border-b border-gray-200 pb-2 text-xs font-bold text-gray-500">
        <a href="{{ route('chats.index', ['tab' => 'todos']) }}" 
           class="pb-2 relative {{ $tab == 'todos' ? 'text-[#1B4D3E] border-b-2 border-[#1B4D3E]' : 'hover:text-gray-800' }}">
            {{ __('messages.chats_tab_all') }}
        </a>
        <a href="{{ route('chats.index', ['tab' => 'no_leidos']) }}" 
           class="pb-2 relative {{ $tab == 'no_leidos' ? 'text-[#1B4D3E] border-b-2 border-[#1B4D3E]' : 'hover:text-gray-800' }}">
            {{ __('messages.chats_tab_unread') }}
        </a>
        <a href="{{ route('chats.index', ['tab' => 'archivados']) }}" 
           class="pb-2 relative {{ $tab == 'archivados' ? 'text-[#1B4D3E] border-b-2 border-[#1B4D3E]' : 'hover:text-gray-800' }}">
            {{ __('messages.chats_tab_archived') }}
        </a>
    </div>

    <!-- Mensaje de Éxito -->
    @if(session('success'))
        <div class="p-3 bg-emerald-50 border border-emerald-200 rounded-xl text-[#1B4D3E] text-xs font-medium">
            {{ session('success') }}
        </div>
    @endif

    <!-- Listado de Conversaciones -->
    <div class="space-y-3">
        @forelse($chats as $chat)
            @php
                $authId = Auth::id();
                $otherUser = ($chat->buyer_id === $authId) ? $chat->seller : $chat->buyer;
                $lastMessage = $chat->messages->sortByDesc('created_at')->first();
                $unreadCount = $chat->messages->where('sender_id', '!=', $authId)->where('is_read', false)->count();
            @endphp

            <div class="bg-[#F4F9F6] border border-emerald-700/20 p-4 rounded-2xl shadow-sm flex items-center justify-between gap-3">
                
                <!-- Enlace al Chat -->
                <a href="{{ route('chats.show', $chat->id) }}" class="flex items-center gap-3.5 min-w-0 flex-1">
                    @if(!empty($otherUser->avatar))
                        <img src="{{ asset('storage/' . $otherUser->avatar) }}" alt="{{ $otherUser->name }}" class="w-12 h-12 object-cover rounded-full border border-emerald-700/30 shrink-0">
                    @else
                        <div class="w-12 h-12 bg-[#1B4D3E] text-white rounded-full flex items-center justify-center font-bold text-sm shrink-0">
                            {{ strtoupper(substr($otherUser->name ?? 'U', 0, 1)) }}
                        </div>
                    @endif

                    <div class="space-y-0.5 min-w-0">
                        <h4 class="text-sm font-bold text-gray-900 truncate">{{ $otherUser->name ?? 'Usuario' }}</h4>
                        <p class="text-[11px] text-gray-600 truncate">
                            {{ __('messages.chats_product_interested', ['product' => $chat->product->title ?? 'Producto']) }}
                        </p>
                        <p class="text-xs text-gray-500 truncate font-medium">
                            {{ $lastMessage ? $lastMessage->content : __('messages.chats_start_conversation') }}
                        </p>
                    </div>
                </a>

                <!-- Hora, Contador y Botón de Archivar -->
                <div class="flex flex-col items-end justify-between h-full min-h-[50px] shrink-0 gap-2">
                    <div class="flex items-center gap-2">
                        @if($lastMessage)
                            <span class="text-[10px] text-gray-400 font-medium">{{ $lastMessage->created_at->format('h:i a') }}</span>
                        @endif
                    </div>

                    <div class="flex items-center gap-2">
                        @if($unreadCount > 0)
                            <span class="w-5 h-5 bg-[#1B4D3E] text-white text-[10px] font-bold rounded-full flex items-center justify-center shadow-sm">
                                {{ $unreadCount }}
                            </span>
                        @endif

                        <!-- Botón Rápido de Archivar / Desarchivar -->
                        <form action="{{ route('chats.archive', $chat->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-[10px] bg-emerald-100 hover:bg-emerald-200 text-[#1B4D3E] px-2.5 py-1 rounded-lg font-bold transition" title="{{ $chat->is_archived ? __('messages.chats_restore') : __('messages.chats_archive') }}">
                                {{ $chat->is_archived ? __('messages.chats_restore') : __('messages.chats_archive') }}
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        @empty
            <div class="p-12 text-center bg-white rounded-2xl border border-gray-200 shadow-sm space-y-2">
                <div class="w-12 h-12 bg-emerald-100 text-[#1B4D3E] rounded-full flex items-center justify-center mx-auto font-bold text-lg">💬</div>
                <p class="text-gray-500 text-xs">
                    @if($tab === 'archivados')
                        {{ __('messages.chats_no_chats_archived') }}
                    @else
                        {{ __('messages.chats_no_chats_active') }}
                    @endif
                </p>
            </div>
        @endforelse
    </div>

</div>
@endsection