@extends("layouts.general")

@section("title", "Show")

@section("content")
    <div class="main-wapper">
        <section class="main-content">
            <div class="container">
              <div class="row productBox">
                    <div class="col-lg-6">
                        <div class="product-left">
                            <div class="imageBox">
                                <img src="/images/{{$product->image}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-right">
                            <div class="back-to-the-index">
                                <a href="/products">
                                    <i class="fas fa-reply"></i>
                                    一覧ページへ戻る
                                </a>
                            </div>
                            <div class="single-nameBox pb-2">{{$product->name}}</div>
                            <div class="single-priceBox">
                                <div class="price-label">価格：</div>
                                <div class="single-price">¥{{$product->price}}</div>
                            </div>
                            <div class="single-description pb-3">{{$product->description}}</div>
                            <div class="single-pickup_timesBox">
                                <div class="pickup_times-label">希望受け取り日時：</div>
                                <div class="single-pickup_times">{{$product->pickup_times}}</div>
                            </div>
                            <div class="favoriteBox">
                                @if (Auth::check() && $product->user->name != Auth::user()->name)
                                    @if (!empty($favorite))
                                        <form class="like-you" action="/favorites/{{$favorite->id}}" method="post">
                                            @csrf
                                            <div class="disattach-star"><i class="fas fa-star"></i></div>
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <input type="submit" class="like-button" name="お気に入り済み" value="「お気に入り済み」: {{$product->favorites->count()}}">
                                        </form>
                                    @else
                                        <form class="like-you" action="/favorites" method="post">
                                            @csrf
                                            <div class="attach-star"><i class="fas fa-star"></i></div>
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <input type="submit" class="like-button" name="お気に入り登録" value="お気に入り登録する: {{$product->favorites->count()}}">
                                        </form>
                                    @endif
                                @else
                                    <div class="like-button">お気に入り数：</div>
                                    <div class="like-count">{{$product->favorites->count()}}</div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="chat-space">
                                    <div class="chatBox">
                                        @if (Auth::user())
                                            @if ($room_id != [])
                                                <div class="already-has-chatting">
                                                    <button type="button" class="restart-chat-button" onclick="location.href='/rooms/{{$room_id}}'">チャットを再開する</button>
                                                </div>
                                            @else
                                                <form class="start-chat" action="/rooms" method="post">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                                    <input type="submit" class="start-chat-button" value="チャットを始める">
                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="soldoutBox">
                                    @if (Auth::user() && $product->user == Auth::user())
                                        <form class="" action="/products/{{$product->id }}/sold" method="get">
                                            @csrf
                                            <button onlick="this.form.submit()" name="button" class="delete-button">SOLDとする</button>
                                        </form>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="single-product-locationBox">
                    <div class="row map-tab">出品者の希望する合流場所</div>
                    <div class="row single-product-location">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

<script type="text/javascript">
let map
let geocoder

function initMap() {
    geocoder = new google.maps.Geocoder()
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: {{ $lat }}, lng:  {{ $lng }} },
        zoom: 15,
        styles: [{
            stylers: [
                { hue: "#FF8C00" }, { saturation: -50 },
                { lightness: 20 }, {gamma: 0.5 }
            ]
        }],
    });
    marker = new google.maps.Marker({
        position: { lat: {{ $lat }}, lng:  {{ $lng }} },
        map: map
    });
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7PJmpBtMY1NOempGY-01SpjCnmzNVwKI&callback=initMap" async defer></script>
