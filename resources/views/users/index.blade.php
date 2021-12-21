@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    {{Form::open(['url'=>route('users.index'), 'method'=>'GET', 'class'=>'col'])}}
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
                        <a href="{{route('users.create')}}" class="btn btn-success">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                @forelse($users as $user)
                    <div class="row pb-2">
                        <div class="col-1">
                            {{$user->getKey()}}
                        </div>
                        <div class="col-6">
                            {{$user->getName()}}
                        </div>
                        <div class="col-2 btn-group" role="group" aria-label="Basic example">
                            <a href="{{route('users.edit', $user)}}" class="btn btn-success btn-secondary">
                                <i class="far fa-edit"></i>
                            </a>
                            {{--                            <a href="{{route('users.destroy', $user)}}" class="btn btn-danger">--}}
                            {{--                                <i class="fas fa-trash-alt"></i>--}}
                            {{--                            </a>--}}
                            {{Form::open(['method'=>'DELETE', 'url'=>route('users.destroy', $user)])}}

                            <button class="btn btn-danger btn-secondary">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            {{Form::close()}}
                            <a href="{{route('users.show', $user)}}" class="btn btn-info btn-secondary">
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
