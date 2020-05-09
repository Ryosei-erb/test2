@extends("layouts.general")

@section("title", "Sold")

@section("content")
    <div class="main-wapper">
        <section class="main-content">
            <div class="container">
                <div class="row productBox">
                    <div class="col-lg-6">
                        <div class="product-left">
                            <div class="sold-imageBox">
                                <img src="/images/{{$product->image}}" alt="">
                                <p>---SOLD OUT---</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-right">
                            <div class="back-to-the-index">
                                <a href="/products">一覧ページへ戻る</a>
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
                            <div class="row">
                                <div class="soldoutBox">
                                    @if (Auth::user() && $product->user == Auth::user())
                                        <form action="/products/{{$product->id }}/resale" method="post">
                                            @csrf
                                            <button onlick="this.form.submit()" name="button" class="delete-button">再びSOLD</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
