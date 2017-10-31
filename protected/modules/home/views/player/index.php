<h3>Персонаж</h3>
<div class="row">
	<div class="col-md-6 nopadding">
		<div style="width: 100%; padding-left: 2rem; color: #c00;"><img src="/assets/img/item16.png" title=""> Сила: <span style="position: absolute; right: 4rem;"><b>64</b></span></div>
		<div style="width: 100%; padding-left: 2rem; color: #444;"><img src="/assets/img/item16.png" title=""> Защита: <span style="position: absolute; right: 4rem;"><b>64</b></span></div>
		<div style="width: 100%; padding-left: 2rem; color: #00c;"><img src="/assets/img/item16.png" title=""> Ловкость: <span style="position: absolute; right: 4rem;"><b>64</b></span></div>
		<div style="width: 100%; padding-left: 2rem; color: #0c0;"><img src="/assets/img/item16.png" title=""> Стойкость: <span style="position: absolute; right: 4rem;"><b>64</b></span></div>
		<div style="width: 100%; padding-left: 2rem; color: #404;"><img src="/assets/img/item16.png" title=""> Интуиция: <span style="position: absolute; right: 4rem;"><b>64</b></span></div>
		<hr>
		<div style="width: 100%; padding-left: 2rem;"><img src="/assets/img/item16.png" title=""> Влияние: <span style="position: absolute; right: 4rem;"><b>1234</b></span></div>
		<div style="width: 100%; padding-left: 2rem;"><img src="/assets/img/yinyang16.png" title="карма"> Карма: <span style="position: absolute; right: 4rem;"><b style="color: #070;">+100</b></span></div>
		<div style="width: 100%; padding-left: 2rem;"><img src="/assets/img/item16.png" title=""> Опыт: <span style="position: absolute; right: 4rem;"><b>12 / 1000</b></span></div>
	</div>
	<div class="col-md-6 nopadding">
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
</div>
<h4>Рюкзак</h4>
<div class="player-items">
	<? foreach ($player_items as $player_item): ?>
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