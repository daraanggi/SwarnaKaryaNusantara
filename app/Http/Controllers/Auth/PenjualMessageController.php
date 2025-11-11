<?php

namespace App\Http\Controllers\Penjual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Message;

class MessageController extends Controller
{
    /**
     * Return thread percakapan untuk message {id}
     * JSON: { thread: [ { from: 'buyer'|'seller', text, time }, ... ] }
     */
    public function thread($id)
    {
        $user = auth()->user();
        // contoh: ambil pesan yang ditujukan ke seller ini
        $messages = Message::where('seller_id', $user->id)
                            ->orderBy('created_at','desc')
                            ->get();
        // kirim ke view
        return view('penjual.profile.edit', compact('messages', 'monthly_income', 'yearly_income', 'products_sold_count', 'out_of_stock_count', 'active_orders_count'));

        // Jika Anda punya model Message & Reply, silakan sesuaikan. 
        // Kita coba ambil dari table messages & message_replies secara generik.
        try {
            // cek table messages ada
            if (\Schema::hasTable('messages')) {
                // ambil pesan utama
                $msg = DB::table('messages')->where('id', $id)->first();

                if (!$msg) {
                    return response()->json(['thread' => []]);
                }

                // ambil replies (jika ada)
                $replies = [];
                if (\Schema::hasTable('message_replies')) {
                    $rows = DB::table('message_replies')->where('message_id', $id)->orderBy('created_at')->get();
                    foreach ($rows as $r) {
                        $replies[] = [
                            'from' => ($r->sender_type ?? '') === 'seller' ? 'seller' : 'buyer',
                            'text' => $r->message,
                            'time' => optional($r->created_at)->toDateTimeString() ?? (string) $r->created_at,
                        ];
                    }
                }

                // gabungkan: pertama buyer original, lalu replies
                $thread = [];

                $thread[] = [
                    'from' => 'buyer',
                    'text' => $msg->body ?? $msg->excerpt ?? '',
                    'time' => $msg->created_at ?? null,
                ];

                foreach ($replies as $r) $thread[] = $r;

                return response()->json(['thread' => $thread]);
            }
        } catch (\Exception $e) {
            // fallback ke dummy
            return response()->json(['thread' => []]);
        }

        // fallback default
        return response()->json(['thread' => []]);
    }

    /**
     * Terima balasan dari penjual untuk message {id}
     * Request JSON: { reply: '...' }
     * Response: { message: 'Terkirim', time: '...' }
     */
    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string|max:2000',
        ]);

        $user = Auth::user();

        // Simpan reply ke table message_replies jika ada.
        try {
            if (\Schema::hasTable('message_replies')) {
                $now = Carbon::now();

                $insertedId = DB::table('message_replies')->insertGetId([
                    'message_id'  => $id,
                    'sender_id'   => $user->id,
                    'sender_type' => 'seller',
                    'message'     => $request->input('reply'),
                    'created_at'  => $now,
                    'updated_at'  => $now,
                ]);

                return response()->json([
                    'message' => 'Berhasil dikirim.',
                    'time'    => $now->toDateTimeString(),
                    'reply_id' => $insertedId,
                ]);
            } else {
                // jika tabel tidak ada, kembalikan sukses palsu (developer mode)
                return response()->json([
                    'message' => 'Terkirim (simulasi).',
                    'time'    => Carbon::now()->toDateTimeString(),
                ]);
            }
        } catch (\Exception $e) {
            \Log::error('Reply message error: '.$e->getMessage());
            return response()->json(['message' => 'Gagal menyimpan balasan.'], 500);
        }
    }
}
