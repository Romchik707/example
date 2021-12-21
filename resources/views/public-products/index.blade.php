@extends('layouts.public')

@section('content')
    <div class="col-12">
        <div class="container">
            <div class="row justify-content-center">
                @forelse($publicProducts as $publicProduct)
                    {{--                            <div class="row pb-2">--}}
                    {{--                                <div class="col-1">--}}
                    {{--                                    {{$articleGuest->getKey()}}--}}
                    {{--                                </div>--}}
                    {{--                                <div class="col-6">--}}
                    {{--                                    {{$articleGuest->getName()}}--}}
                    {{--                                </div>--}}
                    {{--                                <div class="col-5">--}}
                    {{--                                    <a href="{{route('articles.edit', $article)}}" class="btn btn-success">--}}
                    {{--                                        <i class="far fa-edit"></i>--}}
                    {{--                                    </a>--}}
                    {{--                                    <a href="{{route('products.destroy', $product)}}" class="btn btn-danger">--}}
                    {{--                                        <i class="fas fa-trash-alt"></i>--}}
                    {{--                                    </a>--}}
                    {{--                                    {{Form::open(['method'=>'DELETE', 'url'=>route('articles.destroy', $article)])}}--}}

                    {{--                                    <button class="btn btn-danger">--}}
                    {{--                                        <i class="fas fa-trash-alt"></i>--}}
                    {{--                                    </button>--}}
                    {{--                                    {{Form::close()}}--}}
                    {{--                                    <a href="{{route('public-articles.show', $articleGuest )}}" class="btn btn-info">--}}
                    {{--                                        <i class="fas fa-eye"></i>--}}
                    {{--                                    </a>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    <div class="card pt-3 m-3 col-3">
                        <a href="{{route('public-products.show', $publicProduct)}}">
                            <img
                                style="max-height: 250px; width: 100%;"
                                class="card-img-top"
                                src="{{$publicProduct->getImagePicture()}}"
                                alt="Потерял картинку? Иди ищи...">
                            <div class="card-body">
                                <h5 class="card-title">{{$publicProduct->getName()}}</h5>
                                <p class="card-text">Цена: {{$publicProduct->getPrice()}} руб.</p>
                            </div>
                        </a>
                    </div>
{{--                    <div class="pt-3 {{$articleGuest->isSuper() ? 'col-12' : 'col-4'}}">--}}
{{--                        <div style="text-align: center;">--}}
{{--                            <a href="{{route('public-articles.show', $articleGuest )}}">--}}
{{--                                <div class="rounded float-left">--}}
{{--                                    <img--}}
{{--                                        class="img-thumbnail w-75 h-75"--}}
{{--                                        style="max-height: 250px; width: 100%;"--}}
{{--                                        width="420"--}}
{{--                                        height="100"--}}
{{--                                        src="https://st.depositphotos.com/1032577/3572/i/950/depositphotos_35727883-stock-photo-black-background.jpg">--}}
{{--                                </div>--}}
{{--                                <div>--}}
{{--                                    {{$articleGuest->getName()}}--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                @empty
                @endforelse
            </div>
        </div>
    </div>

    {{--    <div class="container">--}}
    {{--        <div class="row justify-content-center">--}}
    {{--            <div class="col-md-8">--}}
    {{--                <div class="row">--}}
    {{--                    {{Form::open(['url'=>route('public-articles.index'), 'method'=>'GET', 'class'=>'col'])}}--}}
    {{--                    <div class="row">--}}
    {{--                        <div class="col">--}}
    {{--                            @include('forms._input', [--}}
    {{--        'name'=>'search',--}}
    {{--        'value'=>$frd['search'] ?? '',--}}
    {{--        'placeholder'=>'Поиск',--}}
    {{--        ])--}}
    {{--                        </div>--}}
    {{--                        <div class="col">--}}
    {{--                            <button class="btn btn-success">--}}
    {{--                                <i class="fas fa-search"></i>--}}
    {{--                            </button>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    {{Form::close()}}--}}
    {{--                    <div class="col">--}}
    {{--                        <a href="{{route('articles.create')}}" class="btn btn-success">--}}
    {{--                            <i class="fas fa-plus"></i>--}}
    {{--                        </a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                @forelse($articleGuests as $articleGuest)--}}
    {{--                    <div class="row pb-2">--}}
    {{--                        <div class="col-1">--}}
    {{--                            {{$articleGuest->getKey()}}--}}
    {{--                        </div>--}}
    {{--                        <div class="col-6">--}}
    {{--                            {{$articleGuest->getName()}}--}}
    {{--                        </div>--}}
    {{--                        <div class="col-5">--}}
    {{--                            <a href="{{route('articles.edit', $article)}}" class="btn btn-success">--}}
    {{--                                <i class="far fa-edit"></i>--}}
    {{--                            </a>--}}
    {{--                            <a href="{{route('products.destroy', $product)}}" class="btn btn-danger">--}}
    {{--                                <i class="fas fa-trash-alt"></i>--}}
    {{--                            </a>--}}
    {{--                            {{Form::open(['method'=>'DELETE', 'url'=>route('articles.destroy', $article)])}}--}}

    {{--                            <button class="btn btn-danger">--}}
    {{--                                <i class="fas fa-trash-alt"></i>--}}
    {{--                            </button>--}}
    {{--                            {{Form::close()}}--}}
    {{--                            <a href="{{route('public-articles.show', $articleGuest )}}" class="btn btn-info">--}}
    {{--                                <i class="fas fa-eye"></i>--}}
    {{--                            </a>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                @empty--}}
    {{--                @endforelse--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
@stop
