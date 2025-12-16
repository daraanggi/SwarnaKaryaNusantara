@extends('layouts.app')

@section('title', 'Chat Penjual')

@section('content')
<div class="px-8 pt-24 pb-10 min-h-screen bg-gray-100">
    <h2 class="text-2xl font-bold mb-4">Chat dengan Penjual: {{ $produk->nama }}</h2>

    <div class="bg-white p-4 rounded-lg shadow-md max-h-[500px] overflow-y-auto space-y-2">
        @foreach($chats as $chat)
            <div class="flex {{ $chat->sender_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                <div class="px-4 py-2 rounded-lg {{ $chat->sender_id == auth()->id() ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800' }}">
                    {{ $chat->message }}
                    <div class="text-xs text-gray-500 text-right">{{ $chat->created_at->format('H:i, d M') }}</div>
                </div>
            </div>
        @endforeach
    </div>

    <form action="{{ route('chat.send') }}" method="POST" class="mt-4 flex gap-2">
        @csrf
        <input type="hidden" name="produk_id" value="{{ $produk->id_produk }}">
        <input type="text" name="message" placeholder="Ketik pesan..." class="flex-1 border rounded-lg px-3 py-2">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Kirim</button>
    </form>
</div>
@endsection
