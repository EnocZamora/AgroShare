<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Mostrar la lista de conversaciones del usuario (comprador o vendedor)
    public function index()
    {
        $userId = Auth::id();

        $chats = Chat::with(['product', 'buyer', 'seller', 'messages'])
            ->where('buyer_id', $userId)
            ->orWhere('seller_id', $userId)
            ->latest()
            ->get();

        return view('chats.index', compact('chats'));
    }

    // Mostrar una conversación específica
    public function show(Chat $chat)
    {
        // Validar que el usuario autenticado forme parte de la conversación
        if (Auth::id() !== $chat->buyer_id && Auth::id() !== $chat->seller_id) {
            abort(403);
        }

        $chat->load(['product', 'buyer', 'seller', 'messages.sender']);

        return view('chats.show', compact('chat'));
    }

    // Iniciar conversación o enviar un nuevo mensaje
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'content' => 'required|string',
        ]);

        $product = Product::findOrFail($request->product_id);
        $buyerId = Auth::id();

        // Buscar si ya existe el chat o crearlo
        $chat = Chat::firstOrCreate([
            'product_id' => $product->id,
            'buyer_id' => $buyerId,
            'seller_id' => $product->user_id,
        ]);

        // Registrar el mensaje
        Message::create([
            'chat_id' => $chat->id,
            'sender_id' => $buyerId,
            'content' => $request->content,
        ]);

        return redirect()->route('chats.show', $chat->id);
    }
}