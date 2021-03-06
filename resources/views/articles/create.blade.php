@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Создание продукта') }}</div>

                    <div class="card-body">
                        {{Form::open(['url'=>route('articles.store'), 'method'=>'POST', 'files'=>true])}}

                        @include('articles._form')

                        <div class="form-group">
                            Описание
                            @trix(\App\Article::class, 'content')
                        </div>
                        @include('forms._file', [
    'label'=>'Название картинки',
    'name'=>'new_image_name',
    'image'=>'image',
    'placeholder'=>'Ага...',
    ])

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Создать
                                </button>
                            </div>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
