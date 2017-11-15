<div class="row">
	<div class="col-1">
		<p><?= $data->id ?></p>
	</div>

	<div class="col-2">
		<p><?= $data->dt ?></a></p>
	</div>

	<div class="col-8">
		<p><?= $data->title ?><br>
	</div>

	<div class="col-1">
		<a href="/admin/news/update/id/<?= $data->id ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil" title="Редактировать"></i></a>
		<a href="#" data-link="/admin/news/delete/id/<?= $data->id ?>" class="btn btn-sm btn-danger remove-entry-btn"><i class="fa fa-remove" title="Удалить"></i></a>
	</div>
</div>
<hr>
