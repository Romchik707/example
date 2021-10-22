@include('forms._input', [
	'label'=>'Имя',
	'name'=>'name',
	'value'=>isset($user) ? $user->getName() : '',
])

@include('forms._input', [
	'label'=>'Email',
	'name'=>'email',
	'type'=>'email',
	'value'=>isset($user) ? $user->getEmail() : '',
	'placeholder'=>'test@test.test',
])

@include('forms._input', [
	'label'=>'Пароль',
	'name'=>'password',
	'value'=>isset($user) ? $user->getPassword() : '',
])
