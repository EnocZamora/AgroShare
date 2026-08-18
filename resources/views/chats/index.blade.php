@extends('layouts.app')

@section('title', 'Agroshare - Mis Conversaciones')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    
    <!-- Encabezado de la Sección -->
    <div class="bg-white p-6 rounded-xl border border-emerald-700/30 shadow-sm">
        <h2 class="text-xl font-bold text-[#1B4D3E]">Bandeja de Mensajes</h2>
        <p class="text-xs text-gray-500 mt-1">Negociaciones y consultas sobre productos agropecuarios.</p>
    </div>

    <!-- Listado de Chats -->
    <div class="bg-white rounded-xl border border-emerald-700/30 shadow-sm overflow-hidden divide-y divide-gray-100">
        @forelse($chats as $chat)
            @php
                // Determinar quién es el "otro" participante para mostrar su nombre e iniciales
                $authId = Auth::id();
                $otherUser = ($chat->buyer_id === $authId) ? $chat->seller : $chat->buyer;
                $lastMessage = $chat->messages->sortByDesc('created_at')->first();
            @endphp

            <a href="{{ route('chats.show', $chat->id) }}" class="flex items-center gap-4 p-4 hover:bg-emerald-50/50 transition">
                <!-- Avatar o Inicial -->
                <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-[#1B4D3E] font-bold text-sm shrink-0">
                    {{ strtoupper(substr($otherUser->name ?? 'U', 0, 1)) }}
                </div>

                <!-- Contenido del Chat -->
                <div class="flex-1 min-w-0">
                    <div class="flex justify-between items-center mb-1">
                        <h4 class="text-sm font-bold text-gray-900 truncate">
                            {{ $otherUser->name ?? 'Usuario' }} 
                            <span class="text-xs font-normal text-gray-400 ml-1">({{ $chat->product->title ?? 'Producto' }})</span>
                        </h4>
                        @if($lastMessage)
                            <span class="text-[10px] text-gray-400 shrink-0">{{ $lastMessage->created_at->diffForHumans() }}</span>
                        @endif
                    </div>
                    <p class="text-xs text-gray-600 truncate">
                        {{ $lastMessage ? $lastMessage->content : 'Inicia la conversación...' }}
                    </p>
                </div>
            </a>
        @empty
            <div class="p-12 text-center bg-gray-50">
                <p class="text-gray-500 text-sm">No tienes conversaciones activas en este momento.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection