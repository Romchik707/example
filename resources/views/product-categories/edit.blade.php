@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{Form::model($productCategory, ['url'=>route('product-categories.update', $productCategory), 'method'=>'PATCH'])}}

                @include('product-categories._form', $productCategory)

                <button class="btn btn-success">Сохранить</button>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
