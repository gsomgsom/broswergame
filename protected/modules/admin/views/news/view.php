<div class="container">
	<ul class="breadcrumbs">
		<li class="breadcrumbs__item">
			<a href="<?= Funcs::base() ?>/admin" class="breadcrumbs__link">Админ-панель</a>
		</li>
		<li class="breadcrumbs__item">
			<a href="<?= Funcs::base() ?>/admin/news" class="breadcrumbs__link">Новости</a>
		</li>
		<li class="breadcrumbs__item">
			Просмотр записи новостей
		</li>
	</ul>
</div>

<h1>Новость с ID: <?= $model->id; ?></h1>

<div class="text-right">
	<a href="/admin/news" class="btn btn-info"><i class="fa fa-arrow-left"></i> Вернуться к списку</a>
</div>

<hr>

<? $this->widget('zii.widgets.CDetailView', [
	'data'=>$model,
	'attributes'=>[
		'id',
		'dt',
		'alias',
		'title',
		'content',
	],
]); ?>
