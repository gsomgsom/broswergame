<div class="container">
	<ul class="breadcrumbs">
		<li class="breadcrumbs__item">
			<a href="<?= Funcs::base() ?>/admin" class="breadcrumbs__link">Админ-панель</a>
		</li>
		<li class="breadcrumbs__item">
			Шаблоны предметов
		</li>
	</ul>
</div>

<h1>Шаблоны предметов</h1>

<div class="text-right">
	<a href="/admin/items/create" class="btn btn-success"><i class="fa fa-plus"></i> Создать</a>
</div>

<hr>

<div class="row">
	<div class="col-1">
		<b>ID</b>
	</div>

	<div class="col-2">
		<b>Название</b>
	</div>

	<div class="col-1">
		<b>Требует уровень</b>
	</div>

	<div class="col-1">
		<b>Изображение</b>
	</div>

	<div class="col-3">
		<b>Описание</b>
	</div>

	<div class="col-1">
		<b>Текст "use"</b>
	</div>

	<div class="col-2">
		<b>PHP class</b>
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
