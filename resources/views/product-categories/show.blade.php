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
                        Описание
                    </div>
                    <div class="col">
                        Родительская категория
                    </div>
{{--                    <div class="col">--}}
{{--                        Лист--}}
{{--                    </div>--}}
                </div>
                <div class="row">
                    <div class="col">
                        {{$productCategory->getKey()}}
                    </div>
                    <div class="col">
                        {{$productCategory->getName()}}
                    </div>
{{--                    <div class="col">--}}
{{--                        {{$user->password}}--}}
{{--                    </div>--}}
                    <div class="col">
                        {{$productCategory->getSlug()}}
                    </div>
                    <div class="col">
                        {{$productCategory->getParentCategoryId()}}
                    </div>
{{--                    <div class="col">--}}
{{--                        {{$productCategory->getList()}}--}}
{{--                    </div>--}}
                </div>
                <a href="{{route('product-categories.index')}}}"></a>
{{--                {{Form::model($user, ['url'=>route('users.index', $user), 'method'=>'GET'])}}--}}
{{--                --}}
{{--                <button class="btn btn-success">Закрыть</button>--}}
{{--                {{Form::close()}}--}}
            </div>
        </div>
    </div>
@endsection
