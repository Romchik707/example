@include('forms._input', [
	'label'=>'Имя',
	'name'=>'name',
	'value'=>isset($permission) ? $permission->getName() : '',
])

@include('forms._input', [
	'label'=>'Отображаемое имя',
	'name'=>'display_name',
	'value'=>isset($permission) ? $permission->getDisplayName() : '',
])

@include('forms._input', [
	'label'=>'Описание',
	'name'=>'description',
	'value'=>isset($permission) ? $permission->getDescription() : '',
])
