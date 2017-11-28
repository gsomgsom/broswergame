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
<? $suffix_stats = str_replace('"',"'",Funcs::applyCodes($suffix_stats)) ?>
<div class="border rounded <?= $player_item->item->class ?>" style="background-color: <?= Item::getQualityColor($player_item->quality) ?>;" data-toggle="tooltip" data-html="true" title="<b style='color: <?= Item::getQualityColor($player_item->quality) ?>;'><?= $player_item->item->name.$suffix_title ?></b><br><?= $suffix_stats ?><i><small><?= $player_item->item->description ?></small></i>">
	<? if (!$look): ?>
		<a href="/player/item/use/id/<?= $player_item->id ?>">
	<? endif ?>
	<img src="/assets/img/<?= $player_item->item->img ?>64.png">
	<? if ($player_item->item->required_lvl > 1): ?>
		<div class="counter rq_lvl <? if (!Yii::app()->getController()->user->player->canUsePlayerItem($player_item)): ?> err<? endif ?>" title="требует уровень">
			<?= $player_item->item->required_lvl ?>
		</div>
	<? endif ?>
	<? if ($player_item->item->stack !== 1): ?>
		<div class="counter" title="количество">
			<?= $player_item->amount ?>
		</div>
	<? endif ?>
	<? if (!$look): ?>
		</a>
	<? endif ?>
</div>
