@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    {{Form::open(['url'=>route('permissions.index'), 'method'=>'GET', 'class'=>'col'])}}
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
                        <a href="{{route('permissions.create')}}" class="btn btn-success">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                @forelse($permissions as $permission)
                    <div class="row pb-2">
                        <div class="col-1">
                            {{$permission->getKey()}}
                        </div>
                        <div class="col-6">
                            {{$permission->getName()}}
                        </div>
                        <div class="col-5">
                            <a href="{{route('permissions.edit', $permission)}}" class="btn btn-success">
                                <i class="far fa-edit"></i>
                            </a>
                            <a href="{{route('permissions.destroy', $permission)}}" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </a>
{{--                            {{Form::open(['method'=>'DELETE', 'url'=>route('permissions.destroy', $permission)])}}--}}

{{--                            <button class="btn btn-danger">--}}
{{--                                <i class="fas fa-trash-alt"></i>--}}
{{--                            </button>--}}
{{--                            {{Form::close()}}--}}
                            <a href="{{route('permissions.show', $permission)}}" class="btn btn-info">
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
