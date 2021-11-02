@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col roma">
                        ID
                    </div>
                    <div class="col">
                        Имя
                    </div>
                    <div class="col">
                        Отображаемое имя
                    </div>
                    <div class="col">
                        Описание
                    </div>
                    <div class="col">
                        Дата создания
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        {{$role->getKey()}}
                    </div>
                    <div class="col">
                        {{$role->getName()}}
                    </div>
                    <div class="col">
                        {{$role->getDisplayName()}}
                    </div>
                    <div class="col">
                        {{$role->getDescription()}}
                    </div>
                    <div class="col">
                        {{$role->getCreatedAt()}}
                    </div>
                </div>
                <a href="{{route('roles.index')}}}"></a>
            </div>
        </div>
    </div>
@endsection
