<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{

    public function LoadThePreviousMessages(Request $request)
    {
        if ($request->has('chat_id')) {
            // Se o request contém chat_id, carregue as mensagens do chat
            return Chat::where("id", $request->chat_id)->with(["messages" => function($q) use ($request) {
                $q->where("messages.chat_id", $request->chat_id)->orderBy("id", "asc");
            }])->get();
        }

        // Caso contrário, busque as mensagens entre os dois usuários
        return Message::where(function($query) use ($request) {
            $query->where('from_user', auth("sanctum")->user()->id)
                  ->where('to_user', $request->other);
        })->orWhere(function ($query) use ($request) {
            $query->where('from_user', $request->other)
                  ->where('to_user', auth("sanctum")->user()->id);
        })->orderBy('created_at', 'ASC')->limit(10)->get();
    }
}
