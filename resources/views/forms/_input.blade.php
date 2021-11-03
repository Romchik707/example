<div class="form-group">
    @if(isset($label))
        <label for="exampleInputEmail1">{{$label}}</label>
    @endif
    <input name="{{$name}}" value="{{$value??''}}" type="{{$type??'string'}}"
           class="form-control" id="exampleInputEmail1"
           aria-describedby="emailHelp" placeholder="{{$placeholder??''}}">
    @if($errors->has($name))
        <div class="text-danger small">{{ $errors->first($name) }}</div>
    @endif
</div>
