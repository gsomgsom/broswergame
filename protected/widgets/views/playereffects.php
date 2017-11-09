<? if (sizeof($effects)): ?>
	<ul>
	<? foreach ($effects as $effect): ?>
		<? if ($effect['type'] == 'aura'): ?>
			<li style="list-style-type: none; list-style-image: url(/assets/img/<?=$effect['icon'] ?>16.png);"><span style="font-weight: bold; text-decoration: underline;"><?= $effect['title'] ?></span> <?= $effect['description'] ?></li>
		<? elseif ($effect['type'] == 'spell'): ?>
			<li style="list-style-type: none; list-style-image: url(/assets/img/<?=$effect['icon'] ?>16.png);"><span style="font-weight: bold; text-decoration: underline;"><?= $effect['title'] ?></span> <?= $effect['description'] ?>
				<img class="i-clock" src="/assets/img/clock16.png" title="таймер"> <span id="b-timer-<?= $effect['name'] ?>">00:00</span>
				<script>
					bTimer('#b-timer-<?= $effect['name'] ?>',<?= $effect['cooldown'] ?>,'hm', 'none', false, 'Не активно', function(){});
				</script>
			</li>
		<? endif ?>
	<? endforeach ?>
	</ul>
<? else: ?>
	<p>Нет активных эффектов</p>
<? endif ?>
