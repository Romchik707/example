<div class="form-group">
    {{--    <label for="exampleInputEmail1">{{$label}}</label>--}}
    <input name="{{$name}}" value="{{$value??''}}" type="{{$type??'string'}}"
           class="form-control" id="exampleInputEmail1"
           aria-describedby="emailHelp" placeholder="{{$placeholder??''}}">
    @if($errors->has($name) === true)
        <div class="text-danger small">{{ $errors->first($name) }}</div>
    @endif
</div>
