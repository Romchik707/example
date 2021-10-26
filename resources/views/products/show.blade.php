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
                        {{$product->getName()}}
                    </div>
                    <div class="col">
                        {{$product->getDescription()}}
                    </div>
                    <div class="col">
                        {{$product->getPrice()}}
                    </div>
                    <div class="col">
                        {{$product->getCategoryId()}}
                    </div>
                    <div class="col">
                        {{$product->getImageId()}}
                    </div>
                </div>
                <a href="{{route('products.index')}}}"></a>
            </div>
        </div>
    </div>
@endsection
