@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="col-auto">
                    {{Form::open(['url'=>route('products.index'), 'method'=>'GET'])}}
                    @include('forms._input', [
'label'=>'Поиск',
'name'=>'search',
'value'=>$frd['search'] ?? '',
])
                    <button class="btn btn-success">
                        Искать
                    </button>
                    {{Form::close()}}
                </div>
                <div class="row justify-content-end">
                    <div class="col-auto">
                        <a href="{{route('products.create')}}" class="btn btn-success">
                            Создать
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
                                Редактировать
                            </a>
                            {{Form::open(['method'=>'DELETE', 'url'=>route('products.destroy', $product)])}}

                            <button class="btn btn-danger">
                                Удалить
                            </button>
                            {{Form::close()}}
                            <a href="{{route('products.show', $product)}}" class="btn btn-info">
                                Просмотр
                            </a>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
@stop
