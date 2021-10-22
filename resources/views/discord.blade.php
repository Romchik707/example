@extends('layouts.app')

@section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><h1>Discord here!</h1></div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-2 roma">
                                    Шухер
                                </div>
                                <div class="col-2">
                                    Кто
                                </div>
                                <div class="col-2">
                                    Где
                                </div>
                                <div class="col-4">
                                    Когда
                                </div>
                                <div class="col-2">
                                    Как
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    {{$whowhere}}
                                </div>
                                <div class="col-2">
                                    {{$who}}
                                </div>
                                <div class="col-2">
                                    {{$where}}
                                </div>
                                <div class="col-4">
                                    {{$when}}
                                </div>
                                <div class="col-2">
                                    {{$how}}
                                </div>
                            </div>
                        </div>
                        Привет, человек!
                        Вот таблица
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
