@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row justify-content-end">
                    <div class="col-auto">
                        <a href="{{route('product-categories.create')}}" class="btn btn-success">
                            Создать
                        </a>
                    </div>
                </div>
                @forelse($productCategories as $productCategory)
                    <div class="row pb-2">
                        <div class="col-1">
                            {{$productCategory->getKey()}}
                        </div>
                        <div class="col-6">
                            {{$productCategory->getName()}}
                        </div>
                        <div class="col-5">
                            <a href="{{route('product-categories.edit', $productCategory)}}" class="btn btn-success">
                                Редактировать
                            </a>
                            {{Form::open(['method'=>'DELETE', 'url'=>route('product-categories.destroy', $productCategory)])}}

                            <button class="btn btn-danger">
                                Удалить
                            </button>
                            {{Form::close()}}
                            <a href="{{route('product-categories.show', $productCategory)}}" class="btn btn-info">
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
