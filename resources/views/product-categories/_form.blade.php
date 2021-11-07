@include('forms._input', [
	'label'=>'Имя',
	'name'=>'name',
	'value'=>isset($productCategory) ? $productCategory->getName() : '',
])

@include('forms._select', [
	'label'=>'Родительская категория',
	'name'=>'parent_category_id',
    'value'=>isset($productCategory) ? $productCategory->getParentCategoryName() : '',
	'elements'=>$productCategories,
])
