@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col roma">
                        ID
                    </div>
                    <div class="col">
                        Имя
                    </div>
                    <div class="col">
                        Цена
                    </div>
                    <div class="col">
                        Категория
                    </div>
                    <div class="col">
                        Фото
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        {{$product->getKey()}}
                    </div>
                    <div class="col">
                        {{$product->getName()}}
                    </div>
                    <div class="col">
                        {{$product->getPrice()}}
                    </div>
                    <div class="col">
                        {{$product->getCategoryName()}}
                    </div>
                    <div class="col">
                        <img src="{{$product->getImagePicture()}}" width="100" height="100" alt="lorem">
                    </div>
{{--                    <a class="col" href="{{$imagePicture??''}}">--}}
{{--                        {{$imagePicture??''}}--}}
{{--                    </a>--}}
                    <div class="col-12">
                        {!!$product->trix('content')!!}
{{--                        @trix(\App\Product::class, 'content')--}}

                    </div>
                </div>
                <a href="{{route('products.index')}}}"></a>
            </div>
        </div>
    </div>
@endsection
