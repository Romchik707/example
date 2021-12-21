@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{Form::model($product, ['url'=>route('products.update', $product), 'method'=>'PATCH'])}}

                @include('products._form', $product)
                <div class="form-group">
                    Описание
                    {!!$product->trix('content')!!}
                </div>
                <button class="btn btn-success">Сохранить</button>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
