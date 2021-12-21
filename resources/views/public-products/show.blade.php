@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class='col-4'>
                        <img
                            style="max-height: 250px; width: 100%;"
                            class="card-img-top"
                            src="{{$publicProduct->getImagePicture()}}"
                            alt="Card image cap">
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <h1>{{$publicProduct->getName()}}</h1>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h5>Описание:</h5>
                            </div>
                            <div class="col">
                                <h5>{{$publicProduct->getDescription()}}</h5>
                            </div>
                        </div>
                        <div class="row mt-0">
                            <div class="col mt-0">
                                <h5>Категория:</h5>
                            </div>
                            <div class="col mt-0">
                                <h5>{{$publicProduct->getCategoryName()}}</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h5>Цена:</h5>
                            </div>
                            <div class="col">
                                <h5>{{$publicProduct->getPrice()}} руб.</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{--                    <a class="col" href="{{$imagePicture??''}}">--}}
                    {{--                        {{$imagePicture??''}}--}}
                    {{--                    </a>--}}
                    <div class="col-12 mt-3">
                        <h5>
                            {{--                        <output>dawd</output>--}}
                            {{--                        Описание--}}
                            {{--                            {!!$articleGuest->trix('content')!!}--}}
                            @trix($publicProduct, 'content', [ 'hideToolbar'=>'true'])
                            {{--                        @trix(\App\Product::class, 'content')--}}
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
