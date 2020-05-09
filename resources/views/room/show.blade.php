@extends("layouts.general")

@section("title", "Chat room")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="chat-room-title">
                    <div class="chat-product-name">
                        <div class="chat-product-name-tag">About:</div>
                        <div class="chat-product-name-content">
                            {{$room->product->name}}
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
        <div class="row">
            @foreach ($messages as $message)
                <div class="col-md-8 offset-md-2">
                    <div class="message-area">
                        <div class="message-one">
                            <div class="user-icon-{{(Auth::user() == $message->user) ? "right" : "left"}}">
                                {{ $message->user->name}}
                            </div>
                            <div class="balloon-{{(Auth::user() == $message->user) ? "right" : "left"}}">
                                <div class="balloon-content">
                                    {{ $message->content}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <form class="message-form" action="/messages" method="post">
                    @csrf
                    <textarea name="content" rows="8" cols="80" class="content"></textarea>
                    <input type="hidden" name="room_id" value="{{$room->id}}">
                    <input type="submit" value="+" class="chat-button">
                </form>
            </div>
        </div>
    </div>
@endsection
