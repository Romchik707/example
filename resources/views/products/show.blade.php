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
{{--                    <div class="col">--}}
{{--                        Пароль--}}
{{--                    </div>--}}
                    <div class="col">
                        Почта
                    </div>
                    <div class="col">
                        Дата создания
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        {{$user->getKey()}}
                    </div>
                    <div class="col">
                        {{$user->getName()}}
                    </div>
{{--                    <div class="col">--}}
{{--                        {{$user->password}}--}}
{{--                    </div>--}}
                    <div class="col">
                        {{$user->getEmail()}}
                    </div>
                    <div class="col">
                        {{$user->getCreatedAt()}}
                    </div>
                </div>
                <a href="{{route('users.index')}}}"></a>
{{--                {{Form::model($user, ['url'=>route('users.index', $user), 'method'=>'GET'])}}--}}
{{--                --}}
{{--                <button class="btn btn-success">Закрыть</button>--}}
{{--                {{Form::close()}}--}}
            </div>
        </div>
    </div>
@endsection
