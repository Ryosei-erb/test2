<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function store(Request $request) {
        $this->validate($request, Message::$rules);
        Message::create([
            "user_id" => Auth::user()->id,
            "room_id" => $request->room_id,
            "content" => $request->content
        ]);
        return redirect("/rooms/" . $request->room_id);
    }
}
