<h3>Персонаж</h3>
<ul class="nav nav-tabs" style="margin-bottom: 16px;">
	<li class="nav-item">
		<a class="nav-link active" href="/player/">Рюкзак</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="/player/skilltree/">Дерево умений</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="/player/achievments/">Достижения</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="/player/stats/">Статистика</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="/player/settings/">Настройки</a>
	</li>
</ul>
<div class="row" style="margin-bottom: 16px;">
	<div class="col-md-6">
		<div class="row nomargin">
			<div class="col-md-2 nopadding">
				<div class="player-items">
					<? $helm_equipped = false ?>
					<? foreach ($this->user->player->player_items as $player_item): ?>
						<? if (($player_item->equipped) && ($player_item->item->type == 'helm')): ?>
							<? $helm_equipped = true ?>
							<? $this->widget('PlayerEquippedItem', ['player_item' => $player_item]) ?>
						<? endif ?>
					<? endforeach ?>
					<? if (!$helm_equipped): ?>
						<span class="border rounded border-secondary av-item" data-toggle="tooltip" data-html="true" title="<b>Шляпа</b><br><i><small>Слот для головных уборов</small></i>"><img src="/assets/img/slot_helm64.png"></span>
					<? endif ?>

					<? $shirt_equipped = false ?>
					<? foreach ($this->user->player->player_items as $player_item): ?>
						<? if (($player_item->equipped) && ($player_item->item->type == 'shirt')): ?>
							<? $shirt_equipped = true ?>
							<? $this->widget('PlayerEquippedItem', ['player_item' => $player_item]) ?>
						<? endif ?>
					<? endforeach ?>
					<? if (!$shirt_equipped): ?>
						<span class="border rounded border-secondary av-item" data-toggle="tooltip" data-html="true" title="<b>Куртка</b><br><i><small>Слот для куртки</small></i>"><img src="/assets/img/slot_shirt64.png"></span>
					<? endif ?>

					<? $pants_equipped = false ?>
					<? foreach ($this->user->player->player_items as $player_item): ?>
						<? if (($player_item->equipped) && ($player_item->item->type == 'pants')): ?>
							<? $pants_equipped = true ?>
							<? $this->widget('PlayerEquippedItem', ['player_item' => $player_item]) ?>
						<? endif ?>
					<? endforeach ?>
					<? if (!$pants_equipped): ?>
						<span class="border rounded border-secondary av-item" data-toggle="tooltip" data-html="true" title="<b>Штаны</b><br><i><small>Слот для штанов</small></i>"><img src="/assets/img/slot_pants64.png"></span>
					<? endif ?>

					<? $weapon_equipped = false ?>
					<? foreach ($this->user->player->player_items as $player_item): ?>
						<? if (($player_item->equipped) && ($player_item->item->type == 'weapon')): ?>
							<? $weapon_equipped = true ?>
							<? $this->widget('PlayerEquippedItem', ['player_item' => $player_item]) ?>
						<? endif ?>
					<? endforeach ?>
					<? if (!$weapon_equipped): ?>
						<span class="border rounded border-secondary av-item" data-toggle="tooltip" data-html="true" title="<b>Правая рука</b><br><i><small>Слот для оружия</small></i>"><img src="/assets/img/slot_weapon64.png"></span>
					<? endif ?>
				</div>
			</div>
			<div class="col-md-8 nopadding">
				<? if ($this->user->player->gender == Player::GENDER_MALE): ?>
					<img src="/assets/img/av-boy01.png" class="text-center">
				<? else: ?>
					<img src="/assets/img/av-girl01.png" class="text-center">
				<? endif ?>
			</div>
			<div class="col-md-2 nopadding">
				<div class="player-items">
					<? $necklace_equipped = false ?>
					<? foreach ($this->user->player->player_items as $player_item): ?>
						<? if (($player_item->equipped) && ($player_item->item->type == 'necklace')): ?>
							<? $necklace_equipped = true ?>
							<? $this->widget('PlayerEquippedItem', ['player_item' => $player_item]) ?>
						<? endif ?>
					<? endforeach ?>
					<? if (!$necklace_equipped): ?>
						<span class="border rounded border-secondary av-item" data-toggle="tooltip" data-html="true" title="<b>Ожерелье</b><br><i><small>Слот для ожерелья</small></i>"><img src="/assets/img/slot_necklace64.png"></span>
					<? endif ?>

					<? $cloak_equipped = false ?>
					<? foreach ($this->user->player->player_items as $player_item): ?>
						<? if (($player_item->equipped) && ($player_item->item->type == 'cloak')): ?>
							<? $cloak_equipped = true ?>
							<? $this->widget('PlayerEquippedItem', ['player_item' => $player_item]) ?>
						<? endif ?>
					<? endforeach ?>
					<? if (!$cloak_equipped): ?>
						<span class="border rounded border-secondary av-item" data-toggle="tooltip" data-html="true" title="<b>Накидка</b><br><i><small>Слот для плаща</small></i>"><img src="/assets/img/slot_cloak64.png"></span>
					<? endif ?>

					<? $trinket_equipped = false ?>
					<? foreach ($this->user->player->player_items as $player_item): ?>
						<? if (($player_item->equipped) && ($player_item->item->type == 'trinket')): ?>
							<? $trinket_equipped = true ?>
							<? $this->widget('PlayerEquippedItem', ['player_item' => $player_item]) ?>
						<? endif ?>
					<? endforeach ?>
					<? if (!$trinket_equipped): ?>
						<span class="border rounded border-secondary av-item" data-toggle="tooltip" data-html="true" title="<b>Талисман</b><br><i><small>Слот для талисмана</small></i>"><img src="/assets/img/slot_trinket64.png"></span>
					<? endif ?>

					<? $shield_equipped = false ?>
					<? foreach ($this->user->player->player_items as $player_item): ?>
						<? if (($player_item->equipped) && ($player_item->item->type == 'shield')): ?>
							<? $shield_equipped = true ?>
							<? $this->widget('PlayerEquippedItem', ['player_item' => $player_item]) ?>
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
		<div style="width: 100%; color: #c00;"><img src="/assets/img/str16.png" title="сила"> Сила: <span style="position: absolute; right: 4rem;"><b><?= $this->user->player->str ?> </b></span></div>
		<div style="width: 100%; color: #444;"><img src="/assets/img/def16.png" title="защита"> Защита: <span style="position: absolute; right: 4rem;"><b><?= $this->user->player->def ?> </b></span></div>
		<div style="width: 100%; color: #00c;"><img src="/assets/img/agi16.png" title="ловкость"> Ловкость: <span style="position: absolute; right: 4rem;"><b><?= $this->user->player->dex ?> </b></span></div>
		<div style="width: 100%; color: #0c0;"><img src="/assets/img/vit16.png" title="стойкость"> Стойкость: <span style="position: absolute; right: 4rem;"><b><?= $this->user->player->sta ?> </b></span></div>
		<div style="width: 100%; color: #404;"><img src="/assets/img/int16.png" title="интуиция"> Интуиция: <span style="position: absolute; right: 4rem;"><b><?= $this->user->player->int ?> </b></span></div>
		<hr>
		<div style="width: 100%;"><img src="/assets/img/top16.png" title="влияние"> <a href="/player/top/might">Влияние</a>: <span style="position: absolute; right: 4rem;"><b><?= $this->user->player->might ?> </b></span></div>
		<div style="width: 100%;"><img src="/assets/img/yinyang16.png" title="карма"> Карма: <span style="position: absolute; right: 4rem;"><b<? if ($this->user->player->carma >= 0): ?> style="color: #070;">+<? else: ?> style="color: #700;">-<? endif ?> <?= abs($this->user->player->carma) ?></b></span></div>
		<div style="width: 100%;"><img src="/assets/img/exp16.png" title="опыт"> Опыт: <span style="position: absolute; right: 4rem;"><b><?= $this->user->player->exp ?> / <?= $this->user->player->expNext() ?></b></span></div>
	</div>
</div>
<h4>Рюкзак</h4>
<div class="player-items">
	<? $used_slots = 0; ?>
	<? foreach ($this->user->player->player_items as $player_item): ?>
		<? if (!$player_item->equipped): ?>
			<? $used_slots++ ?>
			<div class="item-entry">
				<div class="border rounded <?= $player_item->item->class ?>" style="background-color: <?= Item::getQualityColor($player_item->quality) ?>;" data-toggle="tooltip" data-html="true" title="<b><?= $player_item->item->name ?></b><br><i><small><?= str_replace('"',"'",$player_item->item->description) ?></small></i>">
					<img src="/assets/img/<?= $player_item->item->img ?>64.png">
					<? if ($player_item->item->required_lvl > 1): ?>
						<div class="counter rq_lvl <? if (!$this->user->player->canUsePlayerItem($player_item)): ?> err<? endif ?>" title="требует уровень">
							<?= $player_item->item->required_lvl ?>
						</div>
					<? endif ?>
					<? if ($player_item->item->stack !== 1): ?>
						<div class="counter" title="количество">
							<?= $player_item->amount ?>
						</div>
					<? endif ?>
				</div>
				<div class="item-action text-center" style="background-color: #222;">
					<? if ($player_item->item->use_text): ?>
						<? if ($this->user->player->canUsePlayerItem($player_item)): ?>
							<? if ($player_item->item->use_link): ?>
								<a href="<?= $player_item->item->use_link ?>"><?= $player_item->item->use_text ?></a>
							<? else: ?>
								<a href="/player/item/use/id/<?= $player_item->id ?>"><?= $player_item->item->use_text ?></a>
							<? endif ?>
						<? else: ?>
							<a href="#" disabled="disabled" onClick="return false;"><?= $player_item->item->use_text ?></a>
						<? endif ?>
					<? else: ?>
						&nbsp;
					<? endif ?>
				</div>
			</div>
		<? endif ?>
	<? endforeach ?>
	<? for ($i = $this->user->player->bag_slots - $used_slots; $i < $this->user->player->bag_slots; $i++): ?>
		<div class="item-entry">
			<div class="border rounded border-dark" style="background-color: #bbb;">
				<img src="/assets/img/empty64.png">
			</div>
			<div class="item-action text-center">
				&nbsp;
			</div>
		</div>
	<? endfor ?>
</div>