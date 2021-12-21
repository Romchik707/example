@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{Form::model($article, ['url'=>route('articles.update', $article), 'method'=>'PATCH'])}}

                @include('articles._form', $article)
                <div class="form-group">
                    Описание
                    {!!$article->trix('content')!!}
                </div>
                <button class="btn btn-success">Сохранить</button>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
