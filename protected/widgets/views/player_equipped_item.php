<div class="border rounded <?= $player_item->item->class ?>" style="background-color: <?= Item::getQualityColor($player_item->quality) ?>;" data-toggle="tooltip" data-html="true" title="<b><?= $player_item->item->name ?></b><br><i><small><?= $player_item->item->description ?></small></i>">
	<? if (!$look): ?>
		<a href="/player/item/use/id/<?= $player_item->id ?>">
	<? endif ?>
	<img src="/assets/img/<?= $player_item->item->img ?>64.png">
	<? if ($player_item->item->required_lvl > 1): ?>
		<div class="counter rq_lvl <? if (!$this->getOwner()->user->player->canUsePlayerItem($player_item)): ?> err<? endif ?>" title="требует уровень">
			<?= $player_item->item->required_lvl ?>
		</div>
	<? endif ?>
	<? if (!$look): ?>
		</a>
	<? endif ?>
</div>
