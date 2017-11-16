<h3>Достижения</h3>
<ul class="nav nav-tabs" style="margin-bottom: 16px;">
	<li class="nav-item">
		<a class="nav-link" href="/player/">Рюкзак</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="/player/skilltree/">Дерево умений</a>
	</li>
	<li class="nav-item">
		<a class="nav-link active" href="/player/achievments/">Достижения</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="/player/stats/">Статистика</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="/player/settings/">Настройки</a>
	</li>
</ul>

<div class="row">
	<div class="col-md-12">
		<? if ($this->user->player->player_achievments): ?>
			<table class="table table-striped">
				<thead class="thead-dark">
					<tr>
						<th scope="col">Достижение</th>
						<th scope="col">Ранг</th>
						<th scope="col">Дата</th>
					</tr>
				</thead>
				<tbody>
				<? foreach ($this->user->player->player_achievments as $pa): ?>
					<tr>
						<td>
							<div class="row">
								<div class="col-2">
									<img src="/assets/img/achievment32.png">
								</div>
								<div class="col-10">
									<strong><?= $pa->achievment->title ?></strong><br>
									<small><?= Yii::t(false, $pa->achievment->requirement, ['{val}' => $pa->achievment->val]) ?></small>
								</div>
							</div>
						</td>
						<td style="font-size: 1.5rem;"><?= $pa->achievment->rank ?></td>
						<td><?= date('d.m.Y H:i', strtotime($pa->dt)) ?></td>
					</tr>
				<? endforeach ?>
				</tbody>
			</table>
		<? else: ?>
			<p>Вы пока ещё ничего не достигли.</p>
		<? endif ?>
	</div>
</div>
