@extends('layouts.app')

@section('title', 'Agroshare - Conversación con ' . ($otherUser->name ?? 'Usuario'))

@section('content')
<div class="max-w-4xl mx-auto space-y-4">
    
    @php
        $authId = Auth::id();
        $otherUser = ($chat->buyer_id === $authId) ? $chat->seller : $chat->buyer;
    @endphp

    <!-- Encabezado de la Conversación -->
    <div class="bg-white p-4 md:p-5 rounded-2xl border border-gray-200 shadow-sm flex items-center justify-between gap-4">
        <div class="flex items-center gap-3.5 min-w-0">
            <div class="w-11 h-11 rounded-xl bg-emerald-100 flex items-center justify-center text-[#1B4D3E] font-bold text-sm shrink-0">
                {{ strtoupper(substr($otherUser->name ?? 'U', 0, 1)) }}
            </div>
            <div class="min-w-0">
                <h3 class="text-sm font-bold text-gray-900 truncate">{{ $otherUser->name ?? 'Usuario' }}</h3>
                <p class="text-xs text-emerald-700 font-medium truncate">
                    <span class="font-normal text-gray-500">Producto:</span> {{ $chat->product->title ?? 'N/D' }}
                </p>
            </div>
        </div>
        <a href="{{ route('chats.index') }}" class="inline-flex items-center gap-1 text-xs text-gray-500 hover:text-[#1B4D3E] font-bold shrink-0 transition">
            ← Volver
        </a>
    </div>

    <!-- Caja Principal del Chat -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4 md:p-6 h-[450px] flex flex-col justify-between">
        
        <!-- Listado de mensajes con scroll automático o fluido -->
        <div class="overflow-y-auto space-y-3 pr-2 flex-1">
            @forelse($chat->messages as $message)
                @php
                    $isMe = $message->sender_id === $authId;
                @endphp
                <div class="flex {{ $isMe ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-[75%] md:max-w-[65%] rounded-2xl px-4 py-2.5 text-xs shadow-sm {{ $isMe ? 'bg-[#1B4D3E] text-white rounded-br-none' : 'bg-gray-100 text-gray-800 rounded-bl-none' }}">
                        <p class="leading-relaxed">{{ $message->content }}</p>
                        <span class="block text-[9px] mt-1 text-right {{ $isMe ? 'text-emerald-200' : 'text-gray-400' }}">
                            {{ $message->created_at->format('H:i') }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center h-full text-center space-y-2">
                    <div class="w-10 h-10 bg-emerald-100 text-[#1B4D3E] rounded-full flex items-center justify-center font-bold text-sm">💬</div>
                    <p class="text-gray-400 text-xs">No hay mensajes en esta conversación todavía. ¡Escribe el primero!</p>
                </div>
            @endforelse
        </div>

        <!-- Formulario para enviar mensaje -->
        <form action="{{ route('chats.store') }}" method="POST" class="mt-4 pt-3 border-t border-gray-100 flex gap-2.5 items-center">
            @csrf
            <input type="hidden" name="product_id" value="{{ $chat->product_id }}">
            <!-- Si tu lógica usa chat_id directamente, asegúrate de pasarlo aquí si es necesario -->
            <input type="text" name="content" placeholder="Escribe un mensaje..." required autocomplete="off"
                class="flex-1 text-xs border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-[#1B4D3E] text-gray-800 bg-white">
            <button type="submit" class="px-5 py-3 bg-[#1B4D3E] hover:bg-[#14382c] text-white text-xs font-bold rounded-xl transition shadow-sm tracking-wide shrink-0">
                Enviar
            </button>
        </form>
    </div>
</div>
@endsection