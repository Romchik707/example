@include('forms._input', [
	'label'=>'Имя',
	'name'=>'name',
	'value'=>isset($role) ? $role->getName() : '',
])

@include('forms._input', [
	'label'=>'Отображаемое имя',
	'name'=>'display_name',
	'value'=>isset($role) ? $role->getDisplayName() : '',
])

@include('forms._input', [
	'label'=>'Описание',
	'name'=>'description',
	'value'=>isset($role) ? $role->getDescription() : '',
])
