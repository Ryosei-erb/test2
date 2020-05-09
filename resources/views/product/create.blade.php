@extends("layouts.general")

@section("title", "出品ページ")

@section("content")
    <div class="main-wrapper">
        <div class="py-3">
            <div class="container formBox">
                <div class="row">
                    <div class="col form-title">
                        <strong>出品</strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form class="" action="/products" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">商品名</label>
                                <input type="text" name="name" value="" class="form-control form-control-lg">
                            </div>
                            <div class="form-group">
                                <label for="description">説明</label>
                                <textarea name="description" class="form-control form-control-lg"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="pickup_times">受け取り日時</label>
                                <input type="text" name="pickup_times" class="form-control form-control-lg">
                            </div>
                            <div class="form-group">
                                <label for="price">価格</label>
                                <input type="number" name="price" class="form-control form-control-lg">
                            </div>
                            <div class="form-group">
                                <label for="image-file">
                                    <i class="fas fa-camera image-icon"></i>
                                    <input type="file" name="image" id="image-file" class="form-control form-control-lg image-file">
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="address">希望する合流場所</label>
                                <input type="text" name="address" class="form-control form-control-lg">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="出品する" class="create-button form-control">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
