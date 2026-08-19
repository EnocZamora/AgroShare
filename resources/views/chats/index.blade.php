@extends('layouts.app')

@section('title', 'Agroshare - Mis Conversaciones')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    
    <!-- Encabezado de la Sección -->
    <div class="bg-white p-6 md:p-8 rounded-2xl border border-gray-200 shadow-sm">
        <h2 class="text-lg md:text-xl font-bold text-[#1B4D3E]">Bandeja de Mensajes</h2>
        <p class="text-xs text-gray-500 mt-1">Negociaciones, tratos y consultas directas sobre productos y cosechas agropecuarias.</p>
    </div>

    <!-- Listado de Chats -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden divide-y divide-gray-100">
        @forelse($chats as $chat)
            @php
                // Determinar quién es el "otro" participante para mostrar su nombre e iniciales
                $authId = Auth::id();
                $otherUser = ($chat->buyer_id === $authId) ? $chat->seller : $chat->buyer;
                $lastMessage = $chat->messages->sortByDesc('created_at')->first();
            @endphp

            <a href="{{ route('chats.show', $chat->id) }}" class="flex items-center gap-4 p-4 md:p-5 hover:bg-emerald-50/40 transition">
                <!-- Avatar o Inicial Estilizada -->
                <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center text-[#1B4D3E] font-bold text-sm shrink-0">
                    {{ strtoupper(substr($otherUser->name ?? 'U', 0, 1)) }}
                </div>

                <!-- Contenido del Chat -->
                <div class="flex-1 min-w-0">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-1 gap-1">
                        <h4 class="text-sm font-bold text-gray-900 truncate flex items-center gap-2">
                            <span>{{ $otherUser->name ?? 'Usuario' }}</span>
                            <span class="text-[11px] font-normal text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200/50 truncate max-w-[200px]">
                                🌾 {{ $chat->product->title ?? 'Producto' }}
                            </span>
                        </h4>
                        @if($lastMessage)
                            <span class="text-[10px] text-gray-400 shrink-0">{{ $lastMessage->created_at->diffForHumans() }}</span>
                        @endif
                    </div>
                    <p class="text-xs text-gray-600 truncate font-medium">
                        {{ $lastMessage ? $lastMessage->content : 'Inicia la conversación...' }}
                    </p>
                </div>
            </a>
        @empty
            <div class="p-12 text-center bg-gray-50/50">
                <div class="max-w-xs mx-auto space-y-3">
                    <div class="w-12 h-12 bg-emerald-100 text-[#1B4D3E] rounded-full flex items-center justify-center mx-auto font-bold text-lg">💬</div>
                    <p class="text-gray-600 text-xs font-medium">No tienes conversaciones activas en este momento.</p>
                    <a href="{{ route('products.index') }}" class="inline-block text-xs text-[#1B4D3E] font-bold hover:underline">
                        Explorar catálogo para negociar →
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection