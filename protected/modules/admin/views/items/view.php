<div class="container">
	<ul class="breadcrumbs">
		<li class="breadcrumbs__item">
			<a href="<?= Funcs::base() ?>/admin" class="breadcrumbs__link">Админ-панель</a>
		</li>
		<li class="breadcrumbs__item">
			<a href="<?= Funcs::base() ?>/admin/items" class="breadcrumbs__link">Шаблоны предметов</a>
		</li>
		<li class="breadcrumbs__item">
			Просмотр шаблона предмета
		</li>
	</ul>
</div>

<h1>Шаблон предмета ID: <?= $model->id; ?></h1>

<hr>

<? $this->widget('zii.widgets.CDetailView', [
	'data'=>$model,
	'attributes'=>[
		'id',
		'name',
		'php_class',
		'img',
		'description',
		'notice',
		'use_text',
		'use_link',
		'bag',
		'type',
		'class',
		'required_lvl',
		'stack',
		'use_stack',
		'bag_limit',
		'variant',
		'nosell',
		'quality',
		'price_sell_coins',
		'price_sell_nuts',
		'price_sell_mushrooms',
	],
]); ?>
