{{--@include('forms._input', [--}}
{{--    'label'=>'Название картинки',--}}
{{--    'name'=>'name',--}}
{{--    'value'=>'',--}}
{{--    ])--}}

@include('forms._file', [
    'label'=>'Название картинки',
    'name'=>'new_image_name',
    'image'=>'image',
    'placeholder'=>'Ага...',
    ])
