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
                        Супер
                    </div>
                    <div class="col">
                        Дата выпуска
                    </div>
                    <div class="col">
                        Картинка
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        {{$article->getKey()}}
                    </div>
                    <div class="col">
                        {{$article->getName()}}
                    </div>
                    <div class="col">
                        {{$article->getIsSuper()}}
                    </div>
                    <div class="col">
                        {{$article->getPostedAt()}}
                    </div>
                    <div class="col">
                        <img src="{{$imageUrl}}" width="100" height="100" alt="lorem">
                    </div>
{{--                    <a class="col" href="{{$imagePicture??''}}">--}}
{{--                        {{$imagePicture??''}}--}}
{{--                    </a>--}}
                    <div class="col-12">
                        Описание
                        {!!$article->trix('content')!!}
{{--                        @trix(\App\Product::class, 'content')--}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
