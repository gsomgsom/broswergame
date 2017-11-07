<h3><img src="/assets/img/top256.png" title="влияние" style="height: 1.75rem;"> Рейтинг влияния игроков</h3>
<div class="row">
	<div class="col-md-12">
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Влияние</th>
					<th scope="col">Персонаж</th>
				</tr>
			</thead>
			<tbody>
			<? foreach ($players as $n => $player): ?>
				<tr <? if ($player->id == $this->user->player->id): ?>class="table-success"<? endif ?>>
					<th scope="row"><?= $n+1 ?></th>
					<td><?= $player->might ?></td>
					<td><a href="/player/look/player/id/<?= $player->id ?>"><?= $player->nickname ?> [<?= $player->lvl ?>]</a></td>
				</tr>
			<? endforeach ?>
			</tbody>
		</table>
	</div>
</div>