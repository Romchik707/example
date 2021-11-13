@include('forms._input', [
	'label'=>'Имя',
	'name'=>'name',
	'value'=>isset($product) ? $product->getName() : '',
])

@include('forms._input', [
	'label'=>'Описание',
	'name'=>'description',
	'value'=>isset($product) ? $product->getDescription() : '',
])

@include('forms._input', [
	'label'=>'Цена',
	'name'=>'price',
	'value'=>isset($product) ? $product->getPrice() : '',
])

@include('forms._select', [
	'label'=>'Категория',
	'name'=>'category_id',
	'elements'=>$productCategories,
])

{{--@include('forms._input', [--}}
{{--	'label'=>'Фото',--}}
{{--	'name'=>'image_id',--}}
{{--	'value'=>isset($product) ? $product->getImageId() : '',--}}
{{--])--}}

@include('forms._file', [
    'label'=>'Название картинки',
    'name'=>'new_image_name',
    'image'=>'image',
    'placeholder'=>'Ага...',
    ])
