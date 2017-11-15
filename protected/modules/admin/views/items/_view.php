<div class="row">
	<div class="col-1">
		<p><?= $data->id ?></p>
	</div>

	<div class="col-2">
		<p><a style="color: <?= $data->getColor() ?>" href="/admin/items/view/id/<?= $data->id ?>"><?= $data->name ?></a></p>
	</div>

	<div class="col-1">
		<p><?= $data->required_lvl ?></p>
	</div>

	<div class="col-1">
		<img src="/assets/img/<?= $data->img; ?>64.png">
	</div>

	<div class="col-3">
		<p><?= $data->description ?><br>
		<i><?= $data->notice;?></i></p>
	</div>

	<div class="col-1">
		<?= $data->use_text; ?>
	</div>

	<div class="col-2">
		<?= $data->php_class; ?>
	</div>

	<div class="col-1">
		<a href="/admin/items/update/id/<?= $data->id ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil" title="Редактировать"></i></a>
		<a href="#" data-link="/admin/items/delete/id/<?= $data->id ?>" class="btn btn-sm btn-danger remove-entry-btn"><i class="fa fa-remove" title="Удалить"></i></a>
	</div>
</div>
<hr>
