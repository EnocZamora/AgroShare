@extends('layouts.app')

@section('title', 'Agroshare - Conversación')

@section('content')
<div class="max-w-4xl mx-auto space-y-4">
    
    @php
        $authId = Auth::id();
        $otherUser = ($chat->buyer_id === $authId) ? $chat->seller : $chat->buyer;
    @endphp

    <!-- Encabezado de la Conversación -->
    <div class="bg-white p-4 rounded-xl border border-emerald-700/30 shadow-sm flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-[#1B4D3E] font-bold text-sm">
                {{ strtoupper(substr($otherUser->name ?? 'U', 0, 1)) }}
            </div>
            <div>
                <h3 class="text-sm font-bold text-gray-900">{{ $otherUser->name ?? 'Usuario' }}</h3>
                <p class="text-xs text-emerald-700 font-medium">Producto: {{ $chat->product->title ?? 'N/D' }}</p>
            </div>
        </div>
        <a href="{{ route('chats.index') }}" class="text-xs text-gray-500 hover:text-[#1B4D3E] font-medium">
            ← Volver a mensajes
        </a>
    </div>

    <!-- Caja de Mensajes -->
    <div class="bg-white rounded-xl border border-emerald-700/30 shadow-sm p-4 h-[400px] flex flex-col justify-between">
        
        <!-- Listado de mensajes -->
        <div class="overflow-y-auto space-y-3 pr-2 flex-1">
            @forelse($chat->messages as $message)
                @php
                    $isMe = $message->sender_id === $authId;
                @endphp
                <div class="flex {{ $isMe ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-[75%] rounded-lg px-4 py-2 text-xs {{ $isMe ? 'bg-[#1B4D3E] text-white' : 'bg-gray-100 text-gray-800' }}">
                        <p>{{ $message->content }}</p>
                        <span class="block text-[9px] mt-1 text-right {{ $isMe ? 'text-emerald-200' : 'text-gray-400' }}">
                            {{ $message->created_at->format('H:i') }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="flex items-center justify-center h-full text-gray-400 text-xs">
                    No hay mensajes en esta conversación todavía. ¡Escribe el primero!
                </div>
            @endforelse
        </div>

        <!-- Formulario para enviar mensaje -->
        <form action="{{ route('chats.store') }}" method="POST" class="mt-4 pt-3 border-t border-gray-100 flex gap-2">
            @csrf
            <input type="hidden" name="product_id" value="{{ $chat->product_id }}">
            <input type="text" name="content" placeholder="Escribe un mensaje..." required
                class="flex-1 text-xs border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-[#1B4D3E]">
            <button type="submit" class="bg-[#1B4D3E] text-white text-xs px-4 py-2 rounded-lg font-medium hover:bg-emerald-800 transition">
                Enviar
            </button>
        </form>
    </div>
</div>
@endsection