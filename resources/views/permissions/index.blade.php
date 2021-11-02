@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="col-auto">
                        {{Form::open(['url'=>route('permissions.index'), 'method'=>'GET'])}}
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
                        <a href="{{route('permissions.create')}}" class="btn btn-success">
                            Создать
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
                                Редактировать
                            </a>
                            {{Form::open(['method'=>'DELETE', 'url'=>route('permissions.destroy', $permission)])}}

                            <button class="btn btn-danger">
                                Удалить
                            </button>
                            {{Form::close()}}
                            <a href="{{route('permissions.show', $permission)}}" class="btn btn-info">
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
