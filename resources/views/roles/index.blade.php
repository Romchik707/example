@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    {{Form::open(['url'=>route('roles.index'), 'method'=>'GET', 'class'=>'col'])}}
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
                        <a href="{{route('roles.create')}}" class="btn btn-success">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                @forelse($roles as $role)
                    <div class="row pb-2">
                        <div class="col-1">
                            {{$role->getKey()}}
                        </div>
                        <div class="col-6">
                            {{$role->getName()}}
                        </div>
                        <div class="col-5">
                            <a href="{{route('roles.edit', $role)}}" class="btn btn-success">
                                <i class="far fa-edit"></i>
                            </a>
                            <a href="{{route('roles.destroy', $role)}}" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </a>
{{--                            {{Form::open(['method'=>'DELETE', 'url'=>route('roles.destroy', $role)])}}--}}

{{--                            <button class="btn btn-danger">--}}
{{--                                <i class="fas fa-trash-alt"></i>--}}
{{--                            </button>--}}
{{--                            {{Form::close()}}--}}
                            <a href="{{route('roles.show', $role)}}" class="btn btn-info">
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
