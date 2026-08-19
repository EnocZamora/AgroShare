<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Mostrar la lista de conversaciones del usuario con filtrado por pestañas
    public function index(Request $request)
    {
        $userId = Auth::id();
        $tab = $request->get('tab', 'todos');

        $query = Chat::with(['product', 'buyer', 'seller', 'messages'])
            ->where(function($q) use ($userId) {
                $q->where('buyer_id', $userId)
                  ->orWhere('seller_id', $userId);
            });

        // Filtrado por pestañas
        if ($tab === 'archivados') {
            $query->where('is_archived', true);
        } else {
            $query->where('is_archived', false);

            if ($tab === 'no_leidos') {
                $query->whereHas('messages', function($q) use ($userId) {
                    $q->where('sender_id', '!=', $userId)
                      ->where('is_read', false);
                });
            }
        }

        $chats = $query->latest()->get();

        return view('chats.index', compact('chats', 'tab'));
    }

    // Mostrar una conversación específica
    public function show(Chat $chat)
    {
        if (Auth::id() !== $chat->buyer_id && Auth::id() !== $chat->seller_id) {
            abort(403);
        }

        $chat->load(['product', 'buyer', 'seller', 'messages.sender']);

        // Marcar mensajes como leídos al abrir el chat
        $chat->messages()->where('sender_id', '!=', Auth::id())->update(['is_read' => true]);

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

        $chat = Chat::firstOrCreate([
            'product_id' => $product->id,
            'buyer_id' => $buyerId,
            'seller_id' => $product->user_id,
        ]);

        Message::create([
            'chat_id' => $chat->id,
            'sender_id' => $buyerId,
            'content' => $request->content,
            'is_read' => false,
        ]);

        return redirect()->route('chats.show', $chat->id);
    }

    // Archivar o desarchivar un chat
    public function toggleArchive(Chat $chat)
    {
        if (Auth::id() !== $chat->buyer_id && Auth::id() !== $chat->seller_id) {
            abort(403);
        }

        $chat->update([
            'is_archived' => !$chat->is_archived
        ]);

        return back()->with('success', $chat->is_archived ? 'Chat archivado exitosamente.' : 'Chat desarchivado.');
    }
}