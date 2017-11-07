<h3>Персонаж</h3>
<ul class="nav nav-tabs" style="margin-bottom: 16px;">
	<li class="nav-item">
		<a class="nav-link active" href="/home/">Рюкзак</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="/home/skilltree/">Дерево умений</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="/home/achievments/">Достижения</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="/home/stats/">Статистика</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="/home/settings/">Настройки</a>
	</li>
</ul>
<div class="row" style="margin-bottom: 16px;">
	<div class="col-md-6">
		<div class="row nomargin">
			<div class="col-md-2 nopadding">
				<div class="player-items">
					<span class="border rounded border-secondary av-item" data-toggle="tooltip" data-html="true" title="<b>Шляпа</b><br><i><small>Слот для головных уборов</small></i>"><img src="/assets/img/slot_helm64.png"></span>
					<span class="border rounded border-secondary av-item" data-toggle="tooltip" data-html="true" title="<b>Куртка</b><br><i><small>Слот для куртки</small></i>"><img src="/assets/img/slot_shirt64.png"></span>
					<span class="border rounded border-secondary av-item" data-toggle="tooltip" data-html="true" title="<b>Штаны</b><br><i><small>Слот для штанов</small></i>"><img src="/assets/img/slot_pants64.png"></span>
					<span class="border rounded border-secondary av-item" data-toggle="tooltip" data-html="true" title="<b>Правая рука</b><br><i><small>Слот для оружия</small></i>"><img src="/assets/img/slot_weapon64.png"></span>
				</div>
			</div>
			<div class="col-md-8 nopadding">
				<img src="/assets/img/av-boy01.png" class="text-center">
			</div>
			<div class="col-md-2 nopadding">
				<div class="player-items">
					<span class="border rounded border-secondary av-item" data-toggle="tooltip" data-html="true" title="<b>Ожерелье</b><br><i><small>Слот для ожерелья</small></i>"><img src="/assets/img/slot_necklace64.png"></span>
					<span class="border rounded border-secondary av-item" data-toggle="tooltip" data-html="true" title="<b>Накидка</b><br><i><small>Слот для плаща</small></i>"><img src="/assets/img/slot_cloak64.png"></span>
					<span class="border rounded border-secondary av-item" data-toggle="tooltip" data-html="true" title="<b>Талисман</b><br><i><small>Слот для талисмана</small></i>"><img src="/assets/img/slot_trinket64.png"></span>
					<span class="border rounded border-secondary av-item" data-toggle="tooltip" data-html="true" title="<b>Левая рука</b><br><i><small>Слот для оружия или щита</small></i>"><img src="/assets/img/slot_shield64.png"></span>
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
		<div style="width: 100%;"><img src="/assets/img/top16.png" title="влияние"> Влияние: <span style="position: absolute; right: 4rem;"><b><?= $this->user->player->might ?> </b></span></div>
		<div style="width: 100%;"><img src="/assets/img/yinyang16.png" title="карма"> Карма: <span style="position: absolute; right: 4rem;"><b<? if ($this->user->player->carma >= 0): ?> style="color: #070;">+<? else: ?> style="color: #700;">-<? endif ?> <?= abs($this->user->player->carma) ?></b></span></div>
		<div style="width: 100%;"><img src="/assets/img/exp16.png" title="опыт"> Опыт: <span style="position: absolute; right: 4rem;"><b><?= $this->user->player->exp ?> / <?= Formulas::n_lvl_exp($this->user->player->exp) ?></b></span></div>
	</div>
</div>
<h4>Рюкзак</h4>
<div class="player-items">
	<? foreach ($this->user->player->player_items as $player_item): ?>
		<div class="item-entry">
			<div class="border rounded <?= $player_item->item->class ?>" style="background-color: #6b6;" data-toggle="tooltip" data-html="true" title="<b><?= $player_item->item->name ?></b><br><i><small><?= $player_item->item->description ?></small></i>">
				<img src="/assets/img/<?= $player_item->item->img ?>64.png">
				<div class="counter">
					<?= $player_item->amount ?>
				</div>
			</div>
			<div class="item-action text-center" style="background-color: #222;">
				<? if ($player_item->item->use_text): ?>
					<? if ($player_item->item->use_link): ?>
						<a href="<?= $player_item->item->use_link ?>"><?= $player_item->item->use_text ?></a>
					<? else: ?>
						<a href="/home/item/use/id/<?= $player_item->id ?>"><?= $player_item->item->use_text ?></a>
					<? endif ?>
				<? else: ?>
					&nbsp;
				<? endif ?>
			</div>
		</div>
	<? endforeach ?>
	<div class="item-entry">
		<div class="border rounded border-dark" style="background-color: #bbb;">
			<img src="/assets/img/empty64.png">
		</div>
		<div class="item-action text-center">
			&nbsp;
		</div>
	</div>
</div>