<div class="container">
	<ul class="breadcrumbs">
		<li class="breadcrumbs__item">
			<a href="<?= Funcs::base() ?>/admin" class="breadcrumbs__link">Админ-панель</a>
		</li>
		<li class="breadcrumbs__item">
			<a href="<?= Funcs::base() ?>/admin/items" class="breadcrumbs__link">Шаблоны предметов</a>
		</li>
		<li class="breadcrumbs__item">
			Редактирование шаблона предмета
		</li>
	</ul>
</div>

<h1>Редактирование шаблона предмета ID: <?= $model->id; ?></h1>

<hr>

<? $this->renderPartial('_form', ['model'=>$model]); ?>