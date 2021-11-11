@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    {{Form::open(['url'=>route('images.index'), 'method'=>'GET', 'class'=>'col'])}}
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
                        <a href="{{route('images.create')}}" class="btn btn-success">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                @forelse($images as $image)
                    <div class="row pb-2">
                        <div class="col-1">
                            {{$image->getKey()}}
                        </div>
                        <div class="col-6">
                            <td class="cs-p-1"><a href="{{ $image->url }}">{{$image->getPicture()}}</a></td>
                        </div>
                        <div class="col-5">
                            <a href="{{route('images.edit', $image)}}" class="btn btn-success">
                                <i class="far fa-edit"></i>
                            </a>
{{--                            <a href="{{route('images.destroy', $image)}}" class="btn btn-danger">--}}
{{--                                <i class="fas fa-trash-alt"></i>--}}
{{--                            </a>--}}
                            {{Form::open(['method'=>'DELETE', 'url'=>route('images.destroy', $image)])}}

                            <button class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            {{Form::close()}}
                            <a href="{{route('images.show', $image)}}" class="btn btn-info">
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
