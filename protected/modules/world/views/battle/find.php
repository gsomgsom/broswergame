<h3>Поиск соперника</h3>
<div class="row">
	<div class="col-5 text-center">
		<p><small><strong><?= $player->nickname ?></strong></small></p>
	</div>
	<div class="col-2 text-center">
	<? if ($player->gender == Player::GENDER_MALE): ?>
		<img src="/assets/img/avsm-boy01.png" class="border rounded-circle" style="margin-top: -6px; background-color: #ccc;">
	<? else: ?>
		<img src="/assets/img/avsm-girl01.png" class="border rounded-circle" style="margin-top: -6px; background-color: #ccc;">
	<? endif ?>
	</div>
	<div class="col-5 text-center">
		<p>
			<small>
				Не состоит в гильдии
			</small>
		</p>
	</div>
</div>
<div class="row">
	<div class="col-5 text-center">
		<div class="progress">
			<div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%; height: 22px;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
				&nbsp;
			</div>
		</div>
		<div class="progress-text">
			<img src="/assets/img/hp16.png" title="здоровье"> <strong>100%</strong>
		</div>
	</div>
	<div class="col-2 text-center" style="margin-top: -3px;">
		<span class="badge badge-dark" style="width: 100%;"><img src="/assets/img/lvl16.png" title="уровень"> <strong><?= $player->lvl ?></strong></span>
	</div>
	<div class="col-5 text-center">
		<div class="progress">
			<div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: <?= ceil(($player->expAtLevel() / $player->expToLevelMax()) * 100) ?>%; height: 22px;" aria-valuenow="<?= $player->expAtLevel() ?>" aria-valuemin="0" aria-valuemax="<?= $player->expToLevelMax() ?>">
				&nbsp;
			</div>
		</div>
		<div class="progress-text">
			<img src="/assets/img/exp16.png" title="опыт"> <strong><?= $player->expAtLevel() ?> / <?= $player->expToLevelMax() ?></strong>
		</div>
	</div>
</div>

<hr>

<div class="row" style="margin-bottom: 16px;">
	<div class="col-md-6">
		<div class="row nomargin">
			<div class="col-md-2 nopadding">
				<div class="player-items">
					<? $helm_equipped = false ?>
					<? foreach ($player->player_items as $player_item): ?>
						<? if (($player_item->equipped) && ($player_item->item->type == 'helm')): ?>
							<? $helm_equipped = true ?>
							<? $this->widget('PlayerEquippedItem', ['player_item' => $player_item, 'look' => true]) ?>
						<? endif ?>
					<? endforeach ?>
					<? if (!$helm_equipped): ?>
						<span class="border rounded border-secondary av-item" data-toggle="tooltip" data-html="true" title="<b>Шляпа</b><br><i><small>Слот для головных уборов</small></i>"><img src="/assets/img/slot_helm64.png"></span>
					<? endif ?>

					<? $shirt_equipped = false ?>
					<? foreach ($player->player_items as $player_item): ?>
						<? if (($player_item->equipped) && ($player_item->item->type == 'shirt')): ?>
							<? $shirt_equipped = true ?>
							<? $this->widget('PlayerEquippedItem', ['player_item' => $player_item, 'look' => true]) ?>
						<? endif ?>
					<? endforeach ?>
					<? if (!$shirt_equipped): ?>
						<span class="border rounded border-secondary av-item" data-toggle="tooltip" data-html="true" title="<b>Куртка</b><br><i><small>Слот для куртки</small></i>"><img src="/assets/img/slot_shirt64.png"></span>
					<? endif ?>

					<? $pants_equipped = false ?>
					<? foreach ($player->player_items as $player_item): ?>
						<? if (($player_item->equipped) && ($player_item->item->type == 'pants')): ?>
							<? $pants_equipped = true ?>
							<? $this->widget('PlayerEquippedItem', ['player_item' => $player_item, 'look' => true]) ?>
						<? endif ?>
					<? endforeach ?>
					<? if (!$pants_equipped): ?>
						<span class="border rounded border-secondary av-item" data-toggle="tooltip" data-html="true" title="<b>Штаны</b><br><i><small>Слот для штанов</small></i>"><img src="/assets/img/slot_pants64.png"></span>
					<? endif ?>

					<? $weapon_equipped = false ?>
					<? foreach ($player->player_items as $player_item): ?>
						<? if (($player_item->equipped) && ($player_item->item->type == 'weapon')): ?>
							<? $weapon_equipped = true ?>
							<? $this->widget('PlayerEquippedItem', ['player_item' => $player_item, 'look' => true]) ?>
						<? endif ?>
					<? endforeach ?>
					<? if (!$weapon_equipped): ?>
						<span class="border rounded border-secondary av-item" data-toggle="tooltip" data-html="true" title="<b>Правая рука</b><br><i><small>Слот для оружия</small></i>"><img src="/assets/img/slot_weapon64.png"></span>
					<? endif ?>
				</div>
			</div>
			<div class="col-md-8 nopadding">
				<? if ($player->gender == Player::GENDER_MALE): ?>
					<img src="/assets/img/av-boy01.png" class="text-center">
				<? else: ?>
					<img src="/assets/img/av-girl01.png" class="text-center">
				<? endif ?>
			</div>
			<div class="col-md-2 nopadding">
				<div class="player-items">
					<? $necklace_equipped = false ?>
					<? foreach ($player->player_items as $player_item): ?>
						<? if (($player_item->equipped) && ($player_item->item->type == 'necklace')): ?>
							<? $necklace_equipped = true ?>
							<? $this->widget('PlayerEquippedItem', ['player_item' => $player_item, 'look' => true]) ?>
						<? endif ?>
					<? endforeach ?>
					<? if (!$necklace_equipped): ?>
						<span class="border rounded border-secondary av-item" data-toggle="tooltip" data-html="true" title="<b>Ожерелье</b><br><i><small>Слот для ожерелья</small></i>"><img src="/assets/img/slot_necklace64.png"></span>
					<? endif ?>

					<? $cloak_equipped = false ?>
					<? foreach ($player->player_items as $player_item): ?>
						<? if (($player_item->equipped) && ($player_item->item->type == 'cloak')): ?>
							<? $cloak_equipped = true ?>
							<? $this->widget('PlayerEquippedItem', ['player_item' => $player_item, 'look' => true]) ?>
						<? endif ?>
					<? endforeach ?>
					<? if (!$cloak_equipped): ?>
						<span class="border rounded border-secondary av-item" data-toggle="tooltip" data-html="true" title="<b>Накидка</b><br><i><small>Слот для плаща</small></i>"><img src="/assets/img/slot_cloak64.png"></span>
					<? endif ?>

					<? $trinket_equipped = false ?>
					<? foreach ($player->player_items as $player_item): ?>
						<? if (($player_item->equipped) && ($player_item->item->type == 'trinket')): ?>
							<? $trinket_equipped = true ?>
							<? $this->widget('PlayerEquippedItem', ['player_item' => $player_item, 'look' => true]) ?>
						<? endif ?>
					<? endforeach ?>
					<? if (!$trinket_equipped): ?>
						<span class="border rounded border-secondary av-item" data-toggle="tooltip" data-html="true" title="<b>Талисман</b><br><i><small>Слот для талисмана</small></i>"><img src="/assets/img/slot_trinket64.png"></span>
					<? endif ?>

					<? $shield_equipped = false ?>
					<? foreach ($player->player_items as $player_item): ?>
						<? if (($player_item->equipped) && ($player_item->item->type == 'shield')): ?>
							<? $shield_equipped = true ?>
							<? $this->widget('PlayerEquippedItem', ['player_item' => $player_item, 'look' => true]) ?>
						<? endif ?>
					<? endforeach ?>
					<? if (!$shield_equipped): ?>
						<span class="border rounded border-secondary av-item" data-toggle="tooltip" data-html="true" title="<b>Левая рука</b><br><i><small>Слот для оружия или щита</small></i>"><img src="/assets/img/slot_shield64.png"></span>
					<? endif ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div style="width: 100%; color: #c00;"><img src="/assets/img/str16.png" title="сила"> Сила: <span style="position: absolute; right: 4rem;"><b><?= $player->countStr() ?> </b></span></div>
		<div style="width: 100%; color: #444;"><img src="/assets/img/def16.png" title="защита"> Защита: <span style="position: absolute; right: 4rem;"><b><?= $player->countDef() ?> </b></span></div>
		<div style="width: 100%; color: #00c;"><img src="/assets/img/agi16.png" title="ловкость"> Ловкость: <span style="position: absolute; right: 4rem;"><b><?= $player->countDex() ?> </b></span></div>
		<div style="width: 100%; color: #0c0;"><img src="/assets/img/vit16.png" title="стойкость"> Стойкость: <span style="position: absolute; right: 4rem;"><b><?= $player->countSta() ?> </b></span></div>
		<div style="width: 100%; color: #404;"><img src="/assets/img/int16.png" title="интеллект"> Интеллект: <span style="position: absolute; right: 4rem;"><b><?= $player->countInt() ?> </b></span></div>
		<hr>
		<div style="width: 100%;"><img src="/assets/img/top16.png" title="влияние"> Влияние: <span style="position: absolute; right: 4rem;"><b><?= $player->might ?> </b></span></div>
		<div style="width: 100%;"><img src="/assets/img/yinyang16.png" title="карма"> Карма: <span style="position: absolute; right: 4rem;"><b<? if ($player->carma >= 0): ?> style="color: #070;">+<? else: ?> style="color: #700;">-<? endif ?> <?= abs($player->carma) ?></b></span></div>
		<div style="width: 100%;"><img src="/assets/img/exp16.png" title="опыт"> Опыт: <span style="position: absolute; right: 4rem;"><b><?= $player->exp ?> / <?= $player->expNext() ?></b></span></div>
	</div>
</div>
<hr>
<a href="/world/battle/attack/id/<?= $player->id ?>" class="btn btn-small btn-warning">В бой!</a>