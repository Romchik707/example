@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    {{Form::open(['url'=>route('products.index'), 'method'=>'GET', 'class'=>'col'])}}
                    <div class="row">
                        <div class="col">
                            @include('forms._input', [
        'name'=>'search',
        'value'=>$frd['search'] ?? '',
        'placeholder'=>'Поиск',
        ])
                        </div>
                        <div class="col">
                            <button class="btn btn-success">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    {{Form::close()}}
                    <div class="col">
                        <a href="{{route('products.index')}}" class="btn btn-success">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                @forelse($products as $product)
                    <div class="row pb-2">
                        <div class="col-1">
                            {{$product->getKey()}}
                        </div>
                        <div class="col-6">
                            {{$product->getName()}}
                        </div>
                        <div class="col-5">
                            <a href="{{route('products.edit', $product)}}" class="btn btn-success">
                                <i class="far fa-edit"></i>
                            </a>
                            {{Form::open(['method'=>'DELETE', 'url'=>route('products.destroy', $product)])}}

                            <button class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            {{Form::close()}}
                            <a href="{{route('products.show', $product)}}" class="btn btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
@stop
