@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col">
                        Имя
                    </div>
                    <div class="col">
                        Описание
                    </div>
                    <div class="col">
                        Скок стоит?
                    </div>
                    <div class="col">
                        Категория
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        {{$publicProduct->getName()}}
                    </div>
                    <div class="col">
                        {{$publicProduct->getDescription()}}
                    </div>
                    <div class="col">
                        {{$publicProduct->getPrice()}}
                    </div>
                    <div class="col">
                        {{$publicProduct->category()}}
                    </div>
                    <div class="col">
                        <img src="{{$publicProduct->getImagePicture()}}" width="100" height="100" alt="lorem">
                    </div>
                    <div class="col-12">
                        Описание
{{--                        {!!$articleGuest->trix('content')!!}--}}
{{--                        @trix(\App\Product::class, 'content')--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
