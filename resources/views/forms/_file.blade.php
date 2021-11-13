{{--<div>--}}
{{--    <label>{{$label}}</label>--}}
{{--</div>--}}
{{--<div class="custom-file">--}}

{{--    <input class="form-control" style="border-radius: 5px 0 0 5px; z-index: 5; width: 1000px"--}}
{{--           placeholder="Сохранить как..." type="text" id="name" value="123" name="name">--}}
{{--    @if(isset($label))--}}
{{--        <label class="custom-file-label" for="inputGroupFile01"></label>--}}
{{--    @endif--}}
{{--        <input name="{{$name}}" value="{{$value??''}}" type="file"--}}
{{--               class="custom-file-input" id="inputGroupFile01"--}}
{{--               aria-describedby="inputGroupFileAddon01" placeholder="{{$placeholder??''}}">--}}
{{--    @if($errors->has($name))--}}
{{--        <div class="text-danger small">{{ $errors->first($name) }}</div>--}}
{{--    @endif--}}
{{--</div>--}}
<label for="exampleInputEmail1">{{$label}}</label>
<div class="custom-file">
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <input class="form-control" style="border-radius: 5px 0 0 5px; z-index: 5"
                   placeholder="{{$placeholder??'Сохранить как...'}}"
                   type="text" name="{{$name}}">
        </div>
        <div style="width: 0" class="custom-file">
            <input name="{{$image??''}}" type="file" class="custom-file-input" id="image"
                   aria-describedby="inputGroupFileAddon01">
            <label style="width: 75px" class="custom-file-label" for="image"></label>
        </div>
    </div>
</div>
