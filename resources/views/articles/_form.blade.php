<?php
/**
 * @var \App\Models\Article $article
 **/
    ?>

@include('forms._input', [
	'label'=>'Имя',
	'name'=>'name',
	'value'=>isset($article) ? $article->getName() : '',
])

@include('forms._check', [
	'label'=>'Супер',
	'name'=>'is_super',
	'checked'=>isset($article) ? $article->isSuper() : '',
])

{{--@include('forms._input', [--}}
{{--	'label'=>'Описание',--}}
{{--	'name'=>'description',--}}
{{--	'value'=>isset($product) ? $product->getDescription() : '',--}}
{{--])--}}

@include('forms._input', [
	'label'=>'Дата выпуска',
    'type'=>'date',
	'name'=>'posted_at',
	'value'=>isset($article) ? $article->getPostedAt() : '',
])
