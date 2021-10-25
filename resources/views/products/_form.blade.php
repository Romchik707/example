@include('forms._input', [
	'label'=>'Название',
	'name'=>'name',
	'value'=>/*isset($user) ? $user->getName() : */'',
])

@include('forms._input', [
	'label'=>'Описание',
	'name'=>'email',
	'type'=>'email',
	'value'=>'',
	'placeholder'=>'test@test.test',
])

@include('forms._input', [
	'label'=>'Цена',
	'name'=>'password',
	'value'=>'',
])

@include('forms._input', [
	'label'=>'Категория',
	'name'=>'password',
	'value'=>'',
])

@include('forms._input', [
	'label'=>'Фото',
	'name'=>'password',
	'value'=>'',
])
