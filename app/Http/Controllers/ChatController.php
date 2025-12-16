<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Produk;

class ChatController extends Controller
{
    private function getAuthUser()
    {
        return auth('penjual')->check() 
            ? auth('penjual')->user() 
            : auth()->user();
    }

    public function show($produkId)
    {
        $user = $this->getAuthUser();
        $produk = Produk::findOrFail($produkId);

        $chats = Chat::where('produk_id', $produkId)
                     ->where(function($q) use ($user) {
                         $q->where('sender_id', $user->id)
                           ->orWhere('receiver_id', $user->id);
                     })
                     ->orderBy('created_at', 'asc')
                     ->get();

        return view('pembeliView.chat', compact('produk', 'chats'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk,id_produk,id_produk,' . $request->produk_id,
            'message' => 'required|string|max:1000'
        ]);

        $user = $this->getAuthUser();
        $produk = Produk::findOrFail($request->produk_id);

        Chat::create([
            'sender_id' => $user->id,
            'receiver_id' => $produk->user_id,
            'produk_id' => $produk->id_produk,
            'message' => $request->message,
            'is_read' => 0 // **INI YANG DITAMBAHKAN**
        ]);

        return redirect()->back()->with('success', 'Pesan terkirim!');
    }

    
    public function thread($chatId)
    {
        $user = $this->getAuthUser();
        $chat = Chat::findOrFail($chatId);

        $thread = Chat::where(function($q) use ($user, $chat) {
                $q->where(function($q2) use ($user, $chat) {
                    $q2->where('sender_id', $user->id)
                    ->where('receiver_id', $chat->sender_id);
                })->orWhere(function($q2) use ($user, $chat) {
                    $q2->where('sender_id', $chat->sender_id)
                    ->where('receiver_id', $user->id);
                });
            })
            ->where('produk_id', $chat->produk_id)
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($c) use ($user) {
                return [
                    'id' => $c->id,
                    'from' => $c->sender_id == $user->id ? 'you' : 'other',
                    'text' => $c->message,
                    'time' => $c->created_at->format('H:i')
                ];
            });

        return response()->json(['thread' => $thread]);
    }



    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string|max:1000',
        ]);

        $user = $this->getAuthUser();
        $chat = Chat::findOrFail($id);

        // Bedakan siapa penerimanya
        $receiverId = $chat->sender_id == $user->id 
            ? $chat->receiver_id 
            : $chat->sender_id;

        Chat::create([
            'sender_id' => $user->id,
            'receiver_id' => $receiverId,
            'produk_id' => $chat->produk_id,
            'message' => $request->reply,
            'is_read' => 0
        ]);

        return back()->with('success', 'Balasan terkirim!');
    }


    public function edit()
    {
        $user = $this->getAuthUser();

        $messages = Chat::with(['sender', 'receiver'])
                        ->where('sender_id', $user->id)
                        ->orWhere('receiver_id', $user->id)
                        ->orderBy('created_at', 'desc')
                        ->get()
                        ->map(function ($chat) use ($user) {
                            $chat->sender_name = $chat->sender_id == $user->id
                                ? 'Anda'
                                : ($chat->sender->name ?? 'Pengguna');
                            $chat->excerpt = substr($chat->message, 0, 50);
                            $chat->body = $chat->message;
                            $chat->time = $chat->created_at->format('H:i');
                            $chat->avatar_url = null;
                            return $chat;
                        });

        return view('penjualView.editProfilePenjual', compact('messages'));
    }
}
