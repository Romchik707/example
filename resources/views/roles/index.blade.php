@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="col-auto">
                        {{Form::open(['url'=>route('roles.index'), 'method'=>'GET'])}}
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
                        <a href="{{route('roles.create')}}" class="btn btn-success">
                            Создать
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
                                Редактировать
                            </a>
                            {{Form::open(['method'=>'DELETE', 'url'=>route('roles.destroy', $role)])}}

                            <button class="btn btn-danger">
                                Удалить
                            </button>
                            {{Form::close()}}
                            <a href="{{route('roles.show', $role)}}" class="btn btn-info">
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
