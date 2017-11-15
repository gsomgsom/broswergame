<div class="container">
	<ul class="breadcrumbs">
		<li class="breadcrumbs__item">
			<a href="<?= Funcs::base() ?>/admin" class="breadcrumbs__link">Админ-панель</a>
		</li>
		<li class="breadcrumbs__item">
			Список новостей
		</li>
	</ul>
</div>

<h1>Список новостей</h1>

<div class="text-right">
	<a href="/admin/news/create" class="btn btn-success"><i class="fa fa-plus"></i> Создать</a>
</div>

<hr>

<div class="row">
	<div class="col-1">
		<b>ID</b>
	</div>

	<div class="col-2">
		<b>Дата</b>
	</div>

	<div class="col-8">
		<b>Название</b>
	</div>

	<div class="col-1">
		<b>Операции</b>
	</div>

</div>
<hr>

<? $this->widget('zii.widgets.CListView', [
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
]); ?>
