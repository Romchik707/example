@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{Form::model($role, ['url'=>route('roles.update', $role), 'method'=>'PATCH'])}}

                @include('roles._form', $role)

                <button class="btn btn-success">Сохранить</button>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
