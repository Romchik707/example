@include('forms._input', [
	'label'=>'Имя',
	'name'=>'name',
	'value'=>isset($productCategory) ? $productCategory->getName() : '',
])

@include('forms._input', [
	'label'=>'Описание',
	'name'=>'slug',
	'value'=>isset($productCategory) ? $productCategory->getSlug() : '',
])

@include('forms._select', [
	'label'=>'Родительская категория',
	'name'=>'parent_category_id',
	'elements'=>$productCategories,
])
