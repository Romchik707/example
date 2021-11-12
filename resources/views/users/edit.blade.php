@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{Form::model($user, ['url'=>route('users.update', $user), 'method'=>'PATCH'])}}

                @include('users._form', $user)
{{--                @include('forms._select', [--}}
{{--                    'label'=>'Роль',--}}
{{--                    'name'=>'role',--}}
{{--                    'elements'=>$roles,--}}
{{--                    'value'=>'',--}}
{{--                ])--}}
                Имеющиеся роли
                @include('forms._multiselect', [
    'label'=>'Ad',
    'name'=>'list[]',
    'elements'=>$roles,
    'value'=>$choosedRoles,
])
{{--                <div class="col-sm-9">--}}

{{--                    <select multiple class="selectize" id="chroles" name="chroles[]">--}}
{{--                        @foreach($roles as $role)--}}
{{--                            --}}{{--                            @if ($user->hasRole($role->getName()) === true)--}}
{{--                            <option class="selectize-dropdown-content" value={{$role->getKey()}}>{{$role->getName()}}</option>--}}
{{--                            --}}{{--                            @endif--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}
                <button class="btn btn-success">Сохранить</button>
                {{Form::close()}}
            </div>
        </div>
    </div>
{{--    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>--}}
{{--    <script>--}}
{{--        // document.getElementById('btn-alert').onclick = function (){--}}
{{--        //     document.getElementById('btn-alert').style.width = Math.floor(Math.random() * 898) + 'px';--}}
{{--        // };--}}
{{--        $('#btn-alert').onclick = function (){--}}
{{--            alert('adwdasd');--}}
{{--        };--}}
{{--        $('#chroles').selectize();--}}
{{--    </script>--}}
@endsection
