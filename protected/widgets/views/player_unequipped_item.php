<? $suffix_title = '' ?>
<? $suffix_stats = '' ?>
<? $bonus_str = $player_item->item->str ?>
<? $bonus_def = $player_item->item->def ?>
<? $bonus_dex = $player_item->item->dex ?>
<? $bonus_sta = $player_item->item->sta ?>
<? $bonus_int = $player_item->item->int ?>
<? $variant = null ?>
<? if ($player_item->variant): ?>
	<? $variant = ItemVariant::model()->findByPk($player_item->variant) ?>
	<? if (!empty($variant)): ?>
		<? $suffix_title = ' '.$variant->title ?>
		<? if ($variant->str): $bonus_str += $variant->str; endif ?>
		<? if ($variant->def): $bonus_def += $variant->def; endif ?>
		<? if ($variant->dex): $bonus_dex += $variant->dex; endif ?>
		<? if ($variant->sta): $bonus_sta += $variant->sta; endif ?>
		<? if ($variant->int): $bonus_int += $variant->int; endif ?>
	<? endif ?>
<? endif ?>
<? if ($bonus_str): $suffix_stats.='{str} сила: +'.$bonus_str.'<br>'; endif ?>
<? if ($bonus_def): $suffix_stats.='{def} защита: +'.$bonus_def.'<br>'; endif ?>
<? if ($bonus_dex): $suffix_stats.='{dex} ловкость: +'.$bonus_dex.'<br>'; endif ?>
<? if ($bonus_sta): $suffix_stats.='{sta} стойкость: +'.$bonus_sta.'<br>'; endif ?>
<? if ($bonus_int): $suffix_stats.='{int} интеллект: +'.$bonus_int.'<br>'; endif ?>
<? if ((!empty($variant)) && ($variant->effect)): $suffix_stats.='<div style="font-size: 10px; color: lime;">'.$variant->effect.'</div>'.'<br>'; endif ?>

<? if ($player_item->item->price_sell_coins || $player_item->item->price_sell_nuts || $player_item->item->price_sell_mushrooms): ?>
	<? $prices_array =[] ?>
	<? if ($player_item->item->price_sell_coins): $prices_array[]='{coins} <b>'.$player_item->item->price_sell_coins.'</b>'; endif ?>
	<? if ($player_item->item->price_sell_nuts): $prices_array[]='{nuts} <b>'.$player_item->item->price_sell_nuts.'</b>'; endif ?>
	<? if ($player_item->item->price_sell_mushrooms): $prices_array[]='{mushrooms} <b>'.$player_item->item->price_sell_mushrooms.'</b>'; endif ?>
	<? $suffix_stats.='Цена продажи: <nobr>'.implode(' / ', $prices_array).'</nobr><br>' ?>
<? endif ?>

<? $suffix_stats = str_replace('"',"'",Funcs::applyCodes($suffix_stats)) ?>
<div class="item-entry">
	<div class="border rounded <?= $player_item->item->class ?>" style="background-color: <?= Item::getQualityColor($player_item->quality) ?>;" data-toggle="tooltip" data-html="true" title="<b style='color: <?= Item::getQualityColor($player_item->quality) ?>;'><?= $player_item->item->name.$suffix_title ?></b><br><?= $suffix_stats ?><i><small><?= str_replace('"',"'",Funcs::applyCodes($player_item->item->description)) ?></small></i>">
		<img src="/assets/img/<?= $player_item->item->img ?>64.png">
		<? if ($player_item->item->required_lvl > 1): ?>
			<div class="counter rq_lvl <? if (!$player_item->player->canUsePlayerItem($player_item)): ?> err<? endif ?>" title="требует уровень">
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
			<? if ($player_item->player->canUsePlayerItem($player_item)): ?>
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
