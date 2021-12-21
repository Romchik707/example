@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    {{Form::open(['url'=>route('articles.index'), 'method'=>'GET', 'class'=>'col'])}}
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
                        <a href="{{route('articles.create')}}" class="btn btn-success">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                @forelse($articles as $article)
                    <div class="row pb-2">
                        <div class="col-1">
                            {{$article->getKey()}}
                        </div>
                        <div class="col-6">
                            {{$article->getName()}}
                        </div>
                        <div class="col-2 btn-group" role="group" aria-label="Basic example">
                            <a href="{{route('articles.edit', $article)}}" class="btn btn-success btn-secondary">
                                <i class="far fa-edit"></i>
                            </a>
{{--                            <a href="{{route('products.destroy', $product)}}" class="btn btn-danger">--}}
{{--                                <i class="fas fa-trash-alt"></i>--}}
{{--                            </a>--}}
                            {{Form::open(['method'=>'DELETE', 'url'=>route('articles.destroy', $article)])}}

                            <button class="btn btn-danger btn-secondary">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            {{Form::close()}}
                            <a href="{{route('articles.show', $article)}}" class="btn btn-info btn-secondary">
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
