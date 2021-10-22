<div class="form-group">
    <label for="exampleInputEmail1">{{$label}}</label>
    <input name="{{$name}}" value="{{$value??''}}" type="{{$type??'string'}}"
           class="form-control" id="exampleInputEmail1"
           aria-describedby="emailHelp" placeholder="{{$placeholder??''}}">
    @error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
