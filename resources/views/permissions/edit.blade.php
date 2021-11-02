@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{Form::model($permission, ['url'=>route('permissions.update', $permission), 'method'=>'PATCH'])}}

                @include('permissions._form', $permission)

                <button class="btn btn-success">Сохранить</button>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
