<?php

namespace App\Http\Controllers;

use App\Room;
use App\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomsController extends Controller
{
    public function store(Request $request) {
        $room = Room::create(["product_id" => $request->product_id]);
        Membership::create(["user_id" => $request->user_id, "room_id" => $room->id]);
        Membership::create(["user_id" => Auth::user()->id, "room_id" => $room->id]);
        return redirect("/rooms/" . $room->id);
    }

    public function show($id) {
        $room = Room::find($id);
        $messages = $room->messages;
        return view("room.show", ["room" => $room, "messages" => $messages]);
    }
}
