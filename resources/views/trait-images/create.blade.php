@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Загрузка изображения') }}</div>

                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            {{-- enctype attribute is important if your form contains file upload --}}
                            {{-- Please check https://www.w3schools.com/tags/att_form_enctype.asp for further info --}}
                            {{Form::open(['url'=>route('images.store'), 'method'=>'POST', 'files'=>true])}}
                            @include('images._form')
{{--                                <div class="form-group">--}}
{{--                                    <input type="text" class="form-control" id="name" placeholder="Сохранить как..." name="name">--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <input id="image" type="file" name="image">--}}
{{--                                </div>--}}
                                <button type="submit" class="btn btn-primary d-block mx-auto">Загрузить</button>
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--@endsection--}}
{{--<button type="submit" class="btn btn-dark d-block w-75 mx-auto">Upload</button>--}}
{{--<input id="image" type="file" name="image">--}}
{{--    @extends('images.master')--}}
{{--    @include('images.nav')--}}
{{--    @include('images.upload_form')--}}

{{--    @component('images.success')--}}

{{--    @endcomponent--}}
@stop

