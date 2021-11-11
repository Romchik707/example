@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{Form::model($user, ['url'=>route('users.update', $user), 'method'=>'PATCH'])}}

                @include('users._form', $user)
                @include('forms._select', [
                    'label'=>'Роль',
                    'name'=>'role',
                    'elements'=>$roles,
                    'value'=>'',
                ])
Имеющиеся роли
                <div class="col-sm-9">

                    <select multiple id="chroles"  name="chroles[]">
                        @foreach($roles as $role)
{{--                            @if ($user->hasRole($role->getName()) === true)--}}
                                <option value={{$role->getKey()}}>{{$role->getName()}}</option>
{{--                            @endif--}}
{{--                        <option value="nl">Nederland</option>--}}
{{--                        <option value="de">Duitsland</option>--}}
{{--                        <option value="de1">Duitsland1</option>--}}
{{--                        <option value="de2">Duitsland2</option>--}}
                        @endforeach
                    </select>
                    <script>
                        $('#chroles').selectize({
                            maxItems: null,
                            delimiter: ',',
                            persist: true,
                            create: function(input) {
                                return {
                                    value: input,
                                    text: input
                                }
                            }
                        });
                    </script>
                </div>
                <button class="btn btn-success">Сохранить</button>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
