<h3>Статистика</h3>
<ul class="nav nav-tabs" style="margin-bottom: 16px;">
	<li class="nav-item">
		<a class="nav-link" href="/player/">Рюкзак</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="/player/skilltree/">Дерево умений</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="/player/achievments/">Достижения</a>
	</li>
	<li class="nav-item">
		<a class="nav-link active" href="/player/stats/">Статистика</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="/player/settings/">Настройки</a>
	</li>
</ul>
<div class="row">
	<div class="col-md-12">
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th scope="col">Параметр</th>
					<th scope="col">Значение</th>
					<th scope="col">Позиция в рейтинге</th>
				</tr>
			</thead>
			<tbody>
			<tr>
				<th>Проведено боёв:</th>
				<td><?= $this->user->player->getStateIntVal('world_battle_count') ?></td>
				<td>&mdash;</td>
			</tr>
			<tr>
				<th>Побед в боях:</th>
				<td><?= $this->user->player->getStateIntVal('world_battle_win_count') ?></td>
				<td>&mdash;</td>
			</tr>
			<tr>
				<th>Поражений в боях:</th>
				<td><?= $this->user->player->getStateIntVal('world_battle_lose_count') ?></td>
				<td>&mdash;</td>
			</tr>
			<tr>
				<th>Кручений колеса:</th>
				<td><?= $this->user->player->getStateIntVal('location_wheel_roll_count') ?></td>
				<td>&mdash;</td>
			</tr>
			</tbody>
		</table>
	</div>
</div>