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
                        Дата создания
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        {{$image->getKey()}}
                    </div>
                    <div class="col">
                        <a href="{{ $image->picture }}">{{$image->getPicture()}}</a>
                    </div>
                    <div class="col">
                        {{$image->getCreatedAt()}}
                    </div>
                </div>
                <a href="{{route('images.index')}}}"></a>
            </div>
        </div>
    </div>
@endsection
