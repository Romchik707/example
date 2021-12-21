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
                        Альт
                    </div>
                    <div class="col">
                        Название
                    </div>
                    <div class="col">
                        URL
                    </div>
                    <div class="col">
                        Описание
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        {{$traitImage->getKey()}}
                    </div>
                    <div class="col">
                        {{$traitImage->getAlt()}}
                    </div>
                    <div class="col">
                        {{$traitImage->getTitle()}}
                    </div>
                    <div class="col">
                        <a href="{{ $traitImage->getUrl() }}">{{$traitImage->getUrl()}}</a>
                    </div>
                    <div class="col">
                        {{$traitImage->getDescription()}}
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        Размер
                    </div>
                    <div class="col">
                        ID объекта
                    </div>
                    <div class="col">
                        Тип объекта
                    </div>
                    <div class="col">
                        ID пользователя
                    </div>
                    <div class="col">
                        Дата создания
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        {{$traitImage->getSize()}}
                    </div>
                    <div class="col">
                        {{$traitImage->getImageableId()}}
                    </div>
                    <div class="col">
                        {{$traitImage->getImageableType()}}
                    </div>
                    <div class="col">
                        {{$traitImage->getUserId()}}
                    </div>
                    <div class="col">
                        {{$traitImage->getCreatedAt()}}
                    </div>
                </div>
                <a href="{{route('images.index')}}}"></a>
            </div>
        </div>
    </div>
@endsection
