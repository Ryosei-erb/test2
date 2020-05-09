@extends("layouts.general")

@section("title", "Index")

@section("content")
    <div class="main-wrapper">
        <div class="container">
            <div class="row product-lists">
                <div class="products-tab">出品リスト</div>
            </div>
            <div class="row product-lists">
                @foreach ($products as $product)
                    <div class="col-md-3 product-space">
                        <a href="products/{{$product->id}}">
                            @if ($product->image != null)
                                <div class="image-space">
                                    @if ($product->state == "sold")
                                        <div class="sold-index-imageBox">
                                            <img src="/images/{{$product->image}}" alt="Non">
                                            <p>---SOLD OUT---</p>
                                        </div>
                                    @else
                                        <img src="/images/{{$product->image}}" alt="Non">
                                    @endif
                                </div>
                            @endif
                            <div class="product-name-price-space">
                                <div class="product-name-space">{{$product->name}}</div>
                                <div class="product-price-space">¥{{$product->price}}</div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
